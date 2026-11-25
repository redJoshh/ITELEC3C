# Campus Event Manager

A full-stack campus event management application built with a **Laravel RESTful API** (MySQL + Sanctum) and a **React + Vite** frontend styled with **Tailwind CSS v4**. It supports full CRUD operations, keyword searching, multi-criteria filtering, dynamic sorting, soft deletes with archiving and restoration, and role-based access control (RBAC).

---

## Features

### Backend (Laravel RESTful API)
* **Sanctum Token Authentication:** Stateless Bearer token auth (`/api/login`, `/api/logout`, `/api/currentUser`) with rate limiting on login.
* **Role-Based Access Control (RBAC):** Enforced server-side via `EventPolicy`, Form Request `authorize()` (authorize-before-validate), and query scoping in `EventController::index()` so Organizers only view and manage events they created, Students have read-only access to all active events, and Admins have full access.
* **Full CRUD & Soft Deletes:** Create, read, update, archive (soft delete), view archived records, restore soft-deleted events, and permanently delete (`forceDelete`, Admin-only).
* **Search, Filter & Sort:** Keyword search across `title` and `location`, filtering by `category`, `status`, and date range (`date_from`, `date_to`), plus whitelisted dynamic sorting (`event_date_time`, `capacity`, `title`, `created_at`) with an `id` tiebreaker.
* **Validation & Resource Formatting:** Dedicated `StoreEventRequest` and `UpdateEventRequest` classes, consistent JSON formatting via `EventResource`, and standard HTTP status codes (`200`, `201`, `204`, `401`, `403`, `404`, `422`).

### Frontend (React + Vite)
* **Protected Routes & Session Persistence:** Split `AuthContext` / `useAuth` architecture with automatic `/currentUser` hydration on load, Axios Bearer token interceptors, and automatic `401` session cleanup/redirect..
* **Role-Aware Dashboard & Modals:** Conditionally displays **+ New Event**, **Edit**, **Delete**, **Archived** tab, **Restore**, and **Delete Forever** controls based on user role and ownership, alongside a **View** detail modal available to all roles.
* **Dual Validation:** Client-side form validation paired with inline Laravel `422` field error rendering and `datetime-local` ISO formatting.
* **UI & Visual Polish:** Warm off-white beige canvas (`#f3efe6`) with a fixed low-opacity custom monogram watermark (`/kj-logo.png`), branded login and navbar headers, pastel category/status badges, Google Fonts typography, and staggered **AOS (Animate On Scroll)** card animations.

---

## Tech Stack

| Layer | Technologies |
| :--- | :--- |
| **Backend** | PHP, Laravel, Laravel Sanctum, MySQL |
| **Frontend** | React, Vite, React Router, Axios, Tailwind CSS v4, AOS (Animate On Scroll), Google Fonts, Bootstrap Icons |
| **Testing & Tools** | Postman, Composer, npm |

---

## Project Structure

```text
campus-event-manager/
├── event-manager-api/             # Laravel RESTful API
│   ├── app/Http/Controllers/      # AuthController, EventController
│   ├── app/Http/Requests/         # StoreEventRequest, UpdateEventRequest
│   ├── app/Http/Resources/        # EventResource
│   ├── app/Models/                # User, Event
│   ├── app/Policies/              # EventPolicy for Role Designation and Permissions
│   ├── config/cors.php            # CORS config for http://localhost:5173
│   └── routes/api.php             # API routes & Sanctum middleware
├── event-manager-frontend/        # React + Vite SPA
│   ├── public/
│   │   └── kj-logo.png            # Custom brand logo & background watermark
│   ├── index.html                 # Google Fonts stylesheet links
│   └── src/
│       ├── api.js                 # Axios instance & request/response interceptors
│       ├── constants.js           # Categories, statuses, sort fields & badge styles
│       ├── index.css              # Tailwind v4 theme, fonts & watermark CSS
│       ├── AuthContext.jsx        # AuthProvider component
│       ├── useAuth.js             # AuthContext & useAuth hook
│       ├── pages/
│       │   ├── Login.jsx          # Sign-in page with 401/422 handling
│       │   └── Events.jsx         # Main dashboard, AOS grid, Active/Archived views & View modal
│       └── components/
│           ├── FilterBar.jsx      # Search, category, status, date range & sort controls
│           ├── EventCard.jsx      # Pastel-badged event card with role-aware actions
│           └── EventForm.jsx      # Reusable Create/Edit modal with client & server validation
└── README.md
```

---

## Setup Instructions

### Prerequisites
* PHP 8.2+ & Composer
* MySQL
* Node.js 18+ & npm

### 1. Backend Setup (`event-manager-api`)
```bash
cd event-manager-api
composer install
cp .env.example .env
php artisan key:generate
```

Configure your MySQL connection in `event-manager-api/.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=campus_event_manager
DB_USERNAME=root
DB_PASSWORD=
```

Run migrations and seed the database (creates test users and 22 sample events):
```bash
php artisan migrate:fresh --seed
```

Start the API server:
```bash
php artisan serve
```
The API runs at `http://localhost:8000` with CORS enabled for `http://localhost:5173`.

### 2. Frontend Setup (`event-manager-frontend`)
```bash
cd event-manager-frontend
npm install
cp .env.example .env
```

Confirm `event-manager-frontend/.env` contains:
```env
VITE_API_URL=http://localhost:8000/api
```

Start the Vite development server:
```bash
npm run dev
```
Open `http://localhost:5173` in your browser.

---

## Seeded Test Accounts

All seeded accounts use the password **`password`**:

| Role | Name | Email | Password | Access Summary |
| :--- | :--- | :--- | :--- | :--- |
| **Admin** | Admin | `admin@gmail.com` | `password` | Full access to all active & archived events, including permanent delete |
| **Organizer** | Organizer 1 | `organizer1@gmail.com` | `password` | View, create, edit, archive, and restore own events only |
| **Organizer** | Organizer 2 | `organizer2@gmail.com` | `password` | View, create, edit, archive, and restore own events only |
| **Student** | Student User | `student@gmail.com` | `password` | Read-only access to all active events |

---

## API Endpoints

All endpoints except `POST /api/login` require `Authorization: Bearer <token>` and `Accept: application/json` headers. This is best done for Postman.

### Authentication
| Method | Endpoint | Description | Access |
| :--- | :--- | :--- | :--- |
| `POST` | `/api/login` | Authenticate and receive a Sanctum Bearer token | Public (rate-limited) |
| `POST` | `/api/logout` | Revoke the current access token | Authenticated |
| `GET` | `/api/currentUser` | Return the authenticated user's profile and role | Authenticated |

### Events
| Method | Endpoint | Description | Access |
| :--- | :--- | :--- | :--- |
| `GET` | `/api/events` | List active events (supports search, filter, sort) | All roles (Organizers see own) |
| `POST` | `/api/events` | Create a new event (`201 Created`) | Organizer, Admin |
| `GET` | `/api/events/{event}` | View a single event | All roles (Organizers see own) |
| `PUT` / `PATCH` | `/api/events/{event}` | Update an existing event | Owner Organizer, Admin |
| `DELETE` | `/api/events/{event}` | Soft-delete (archive) an event (`204 No Content`) | Owner Organizer, Admin |
| `GET` | `/api/events/archived` | List soft-deleted events | Organizer (own), Admin (all) |
| `POST` | `/api/events/{event}/restore` | Restore a soft-deleted event | Owner Organizer, Admin |
| `DELETE` | `/api/events/{event}/forcedelete` | Permanently delete an event (`204 No Content`) | Admin only |

### Query Parameters (`GET /api/events`)
| Parameter | Allowed Values / Format | Description |
| :--- | :--- | :--- |
| `search` | string | Case-insensitive match on `title` or `location` |
| `category` | `Academic`, `Arts & Culture`, `Career & Professional`, `Community Service`, `Social`, `Sports` | Filter by exact category |
| `status` | `Upcoming`, `Ongoing`, `Completed`, `Cancelled` | Filter by exact status |
| `date_from` | `YYYY-MM-DD` | Events on or after this date |
| `date_to` | `YYYY-MM-DD` | Events on or before this date (`>= date_from`) |
| `sort_by` | `event_date_time`, `capacity`, `title`, `created_at` | Whitelisted sort field (default: `event_date_time`) |
| `sort_order` | `asc`, `desc` | Sort direction (default: `asc`, with `id` tiebreaker) |

---

## Role-Based Access Control (RBAC) Matrix

| Action | Student | Organizer | Admin |
| :--- | :---: | :---: | :---: |
| View active events | All | Own events only | All |
| View single event details | All | Own events only | All |
| Create event | ❌ (`403`) | ✅ | ✅ |
| Edit / Archive event | ❌ (`403`) | Own events only | All |
| View archived events | ❌ (`403`) | Own events only | All |
| Restore archived event | ❌ (`403`) | Own events only | All |
| Permanently delete event | ❌ (`403`) | ❌ (`403`) | ✅ |

---

## Key Security & Architecture Decisions

* **Server-Assigned Ownership:** `user_id` is excluded from Form Request validation rules and assigned exclusively from `$request->user()->id` on the server so clients cannot spoof event ownership.
* **Authorize Before Validate:** Policy checks execute inside `StoreEventRequest::authorize()` and `UpdateEventRequest::authorize()`, ensuring unauthorized users receive `403 Forbidden` immediately rather than `422` validation details.
* **Backend as Source of Truth:** React hides unauthorized actions for a cleaner UX, while `EventPolicy` and Sanctum middleware enforce actual security boundaries on every API request.
* **Token Storage Trade-Off:** The Bearer token is stored in `localStorage` to keep sessions active across page refreshes. In production, pairing short-lived tokens with `HttpOnly` cookies would reduce XSS exposure.

---

## Screenshots
Can be found in the PDF file
## References


Laravel. (n.d.-a). *Authorization*. https://laravel.com/docs/authorization

Laravel. (n.d.-b). *Eloquent: Getting started*. https://laravel.com/docs/eloquent

Laravel. (n.d.-c). *Laravel Sanctum*. https://laravel.com/docs/sanctum

Laravel. (n.d.-d). *Validation*. https://laravel.com/docs/validation

