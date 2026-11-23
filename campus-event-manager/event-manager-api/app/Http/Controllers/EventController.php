<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\User;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        Gate::authorize('viewAny', Event::class);
        $validatedSearch = $request->validate([
            'search' => ['nullable', 'string'],
            'category' => ['nullable', Rule::in(Event::categories)],
            'status' => ['nullable', Rule::in(Event::statuses)],
            'date_from' => ['nullable', 'date'],
            'date_to' => ['nullable', 'date', 'after_or_equal:date_from'],
            'sort_by' => ['nullable', Rule::in(['event_date_time', 'capacity', 'title', 'created_at'])],
            'sort_order' => ['nullable', Rule::in(['asc', 'desc'])],
        ]);

        $query = Event::with('user:id,name');

        if ($request->user()->role === User::ROLE_ORGANIZER) {
            $query->where('user_id', $request->user()->id);
        }

        if ($request->filled('search')) {
            $search = $request->string('search')->trim();

            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('location', 'LIKE', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $validatedSearch['category']);
        }
        if ($request->filled('status')) {
            $query->where('status', $validatedSearch['status']);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('event_date_time', '>=', $validatedSearch['date_from']);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('event_date_time', '<=', $validatedSearch['date_to']);
        }

        $sortBy = $validatedSearch['sort_by'] ?? 'event_date_time';
        $sortOrder = $validatedSearch['sort_order'] ?? 'asc';
        $query->orderBy($sortBy, $sortOrder)->orderBy('id', 'asc');


        return EventResource::collection($query->get());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request): JsonResponse
    {

        $eventData = $request->validated();
        $eventData['user_id'] = $request->user()->id;

        $event = Event::create($eventData);
        $event->load('user:id,name');

        return (new EventResource($event))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event): EventResource
    {
        Gate::authorize('view', $event);
        $event->load('user:id,name');

        return new EventResource($event);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event): EventResource
    {

        $event->update($request->validated());
        $event->load('user:id,name');

        return new EventResource($event);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event): Response
    {
        Gate::authorize('delete', $event);
        $event->delete();

        return response()->noContent();
    }

    public function forceDelete(Request $request, Event $event): Response
    {
        Gate::authorize('forceDelete', $event);
        $user = $request->user();


        if ($user->role !== 'admin') {
            abort(403, 'Only admins can permanently delete events.');
        }

        $event->forceDelete();

        return response()->noContent();
    }
    public function archivedEvents(Request $request): AnonymousResourceCollection
    {
        Gate::authorize('viewTrashed', Event::class);

        $query = Event::onlyTrashed()->with('user:id,name');


        if ($request->user()->role === User::ROLE_ORGANIZER) {
            $query->where('user_id', $request->user()->id);
        }

        return EventResource::collection($query->orderBy('deleted_at', 'desc')->get());
    }

    public function restore(Event $event): EventResource
    {
        Gate::authorize('restore', $event);

        $event->restore();
        $event->load('user:id,name');

        return new EventResource($event);
    }
}
