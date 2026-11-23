import { useEffect, useState } from "react";
import api from "../api";
import EventCard from "../components/EventCard";
import EventForm from "../components/EventForm";
import FilterBar from "../components/FilterBar";
import { CATEGORY_STYLES, STATUS_STYLES } from "../constants";
import { useAuth } from "../useAuth";

const DEFAULT_FILTERS = {
  search: "",
  category: "",
  status: "",
  date_from: "",
  date_to: "",
  sort_by: "event_date_time",
  sort_order: "asc",
};

export default function Events() {
  const { user, logout } = useAuth();

  const [events, setEvents] = useState([]);
  const [filters, setFilters] = useState(DEFAULT_FILTERS);
  const [debouncedSearch, setDebouncedSearch] = useState("");
  const [view, setView] = useState("active"); // 'active' | 'archived'
  const [reloadKey, setReloadKey] = useState(0);

  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");
  const [feedback, setFeedback] = useState("");

  const [formOpen, setFormOpen] = useState(false);
  const [editingEvent, setEditingEvent] = useState(null);
  const [viewingEvent, setViewingEvent] = useState(null);
  const [serverErrors, setServerErrors] = useState({});

  const role = user.role?.toLowerCase();
  const isAdmin = role === "admin";
  const canCreate = isAdmin || role === "organizer";
  const canManage = (event) =>
    isAdmin ||
    (role === "organizer" && Number(event.user_id) === Number(user.id));

  // Debounce search input by 300ms
  useEffect(() => {
    const timer = setTimeout(() => setDebouncedSearch(filters.search), 300);
    return () => clearTimeout(timer);
  }, [filters.search]);

  // Fetch events whenever filters, tab, or reloadKey change
  useEffect(() => {
    const controller = new AbortController();

    const params = {};
    if (view === "active") {
      if (debouncedSearch.trim()) params.search = debouncedSearch.trim();
      if (filters.category) params.category = filters.category;
      if (filters.status) params.status = filters.status;
      if (filters.date_from) params.date_from = filters.date_from;
      if (filters.date_to) params.date_to = filters.date_to;
      params.sort_by = filters.sort_by;
      params.sort_order = filters.sort_order;
    }

    const endpoint = view === "archived" ? "/events/archived" : "/events";

    api
      .get(endpoint, { params, signal: controller.signal })
      .then((res) => {
        setEvents(res.data.data);
        setError("");
      })
      .catch((err) => {
        if (err.name === "CanceledError" || err.code === "ERR_CANCELED") return;
        setError(err.response?.data?.message || "Failed to load events.");
      })
      .finally(() => {
        if (!controller.signal.aborted) setLoading(false);
      });

    return () => controller.abort();
  }, [
    view,
    debouncedSearch,
    filters.category,
    filters.status,
    filters.date_from,
    filters.date_to,
    filters.sort_by,
    filters.sort_order,
    reloadKey,
  ]);

  const triggerReload = (message = "") => {
    setLoading(true);
    setFeedback(message);
    setReloadKey((k) => k + 1);
  };

  const handleFilterChange = (field, value) => {
    setLoading(true);
    setFilters((prev) => ({ ...prev, [field]: value }));
  };

  const handleReset = () => {
    setLoading(true);
    setFilters(DEFAULT_FILTERS);
    setDebouncedSearch("");
  };

  const openCreate = () => {
    setEditingEvent(null);
    setServerErrors({});
    setFormOpen(true);
  };

  const openEdit = (event) => {
    setEditingEvent(event);
    setServerErrors({});
    setFormOpen(true);
  };

  const handleSave = async (payload) => {
    setServerErrors({});
    try {
      if (editingEvent) {
        await api.put(`/events/${editingEvent.id}`, payload);
        setFormOpen(false);
        triggerReload("Event updated successfully.");
      } else {
        await api.post("/events", payload);
        setFormOpen(false);
        triggerReload("Event created successfully.");
      }
    } catch (err) {
      if (err.response?.status === 422 && err.response.data?.errors) {
        setServerErrors(err.response.data.errors);
      } else {
        setError(err.response?.data?.message || "Could not save event.");
      }
    }
  };

  const handleDelete = async (event) => {
    if (!window.confirm(`Archive "${event.title}"?`)) return;
    try {
      await api.delete(`/events/${event.id}`);
      triggerReload("Event archived.");
    } catch (err) {
      setError(err.response?.data?.message || "Could not delete event.");
    }
  };

  const handleRestore = async (event) => {
    try {
      await api.post(`/events/${event.id}/restore`);
      triggerReload("Event restored.");
    } catch (err) {
      setError(err.response?.data?.message || "Could not restore event.");
    }
  };

  const handleForceDelete = async (event) => {
    if (
      !window.confirm(
        `Permanently delete "${event.title}"? This cannot be undone.`,
      )
    )
      return;
    try {
      await api.delete(`/events/${event.id}/forcedelete`);
      triggerReload("Event permanently deleted.");
    } catch (err) {
      setError(
        err.response?.data?.message || "Could not permanently delete event.",
      );
    }
  };

  return (
    <div className="min-h-screen">
      {/* Top Navbar */}
      <header className="bg-white border-b border-slate-100 sticky top-0 z-30">
        <div className="max-w-6xl mx-auto px-4 sm:px-6 py-4 flex flex-wrap items-center justify-between gap-3">
          <div>
            <h1 className="text-xl font-bold text-navy">
              Campus Event Manager
            </h1>
            <p className="text-xs text-slate-500">
              Signed in as{" "}
              <span className="font-semibold text-navy">{user.name}</span> (
              <span className="text-coral font-semibold">{user.role}</span>)
            </p>
          </div>

          <div className="flex items-center gap-2">
            {canCreate && (
              <button
                type="button"
                onClick={openCreate}
                className="rounded-xl bg-coral hover:bg-coral-hover text-white text-sm font-semibold px-4 py-2 transition cursor-pointer"
              >
                + New Event
              </button>
            )}
            <button
              type="button"
              onClick={logout}
              className="rounded-xl bg-slate-100 hover:bg-slate-200 text-navy text-sm font-medium px-4 py-2 transition cursor-pointer"
            >
              Log Out
            </button>
          </div>
        </div>
      </header>

      <main className="max-w-6xl mx-auto px-4 sm:px-6 py-6">
        {/* Active / Archived Tabs (Organizers & Admins only) */}
        {canCreate && (
          <div className="flex gap-2 mb-4">
            <button
              type="button"
              onClick={() => {
                setLoading(true);
                setView("active");
              }}
              className={`rounded-xl px-4 py-2 text-sm font-semibold transition cursor-pointer ${
                view === "active"
                  ? "bg-navy text-white"
                  : "bg-white text-slate-600 border border-slate-200 hover:bg-slate-50"
              }`}
            >
              Active Events
            </button>
            <button
              type="button"
              onClick={() => {
                setLoading(true);
                setView("archived");
              }}
              className={`rounded-xl px-4 py-2 text-sm font-semibold transition cursor-pointer ${
                view === "archived"
                  ? "bg-navy text-white"
                  : "bg-white text-slate-600 border border-slate-200 hover:bg-slate-50"
              }`}
            >
              Archived
            </button>
          </div>
        )}

        {view === "active" && (
          <FilterBar
            filters={filters}
            onChange={handleFilterChange}
            onReset={handleReset}
          />
        )}

        {feedback && (
          <div className="mb-4 rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-3 text-sm text-emerald-800 flex justify-between">
            <span>{feedback}</span>
            <button
              type="button"
              onClick={() => setFeedback("")}
              className="font-bold cursor-pointer"
            >
              &times;
            </button>
          </div>
        )}

        {error && (
          <div className="mb-4 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700 flex justify-between">
            <span>{error}</span>
            <button
              type="button"
              onClick={() => setError("")}
              className="font-bold cursor-pointer"
            >
              &times;
            </button>
          </div>
        )}

        {loading ? (
          <p className="text-center text-sm text-slate-500 py-12">
            Loading events...
          </p>
        ) : events.length === 0 ? (
          <div className="bg-white rounded-2xl border border-slate-100 p-12 text-center">
            <p className="text-sm text-slate-500">
              {view === "archived" ? "No archived events." : "No events found."}
            </p>
          </div>
        ) : (
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            {events.map((event) => (
              <EventCard
                key={event.id}
                event={event}
                isArchived={view === "archived"}
                canManage={canManage(event)}
                canForceDelete={isAdmin}
                onView={setViewingEvent}
                onEdit={openEdit}
                onDelete={handleDelete}
                onRestore={handleRestore}
                onForceDelete={handleForceDelete}
              />
            ))}
          </div>
        )}
      </main>

      {/* Create / Edit Modal */}
      {formOpen && (
        <EventForm
          initialEvent={editingEvent}
          onSubmit={handleSave}
          onClose={() => setFormOpen(false)}
          serverErrors={serverErrors}
        />
      )}

      {/* View Event Details Modal */}
      {viewingEvent && (
        <div
          onClick={() => setViewingEvent(null)}
          className="fixed inset-0 z-50 flex items-center justify-center bg-navy/40 p-4"
        >
          <div
            onClick={(e) => e.stopPropagation()}
            className="w-full max-w-lg bg-white rounded-2xl shadow-xl p-6"
          >
            <div className="flex items-center justify-between gap-2 mb-3">
              <div className="flex items-center gap-2">
                <span
                  className={`px-2.5 py-1 rounded-full text-xs font-semibold border ${
                    CATEGORY_STYLES[viewingEvent.category] ||
                    "bg-slate-50 border-slate-200 text-slate-800"
                  }`}
                >
                  {viewingEvent.category}
                </span>
                <span
                  className={`px-2.5 py-1 rounded-full text-xs font-medium ${
                    STATUS_STYLES[viewingEvent.status] ||
                    "bg-slate-100 text-slate-700"
                  }`}
                >
                  {viewingEvent.status}
                </span>
              </div>
              <button
                type="button"
                onClick={() => setViewingEvent(null)}
                className="text-slate-400 hover:text-navy text-xl leading-none cursor-pointer"
              >
                &times;
              </button>
            </div>

            <h2 className="text-lg font-bold text-navy mb-2">
              {viewingEvent.title}
            </h2>
            <p className="text-sm text-slate-600 mb-5 whitespace-pre-line">
              {viewingEvent.description}
            </p>

            <dl className="space-y-2 text-sm border-t border-slate-100 pt-4">
              <div className="flex justify-between gap-4">
                <dt className="font-semibold text-navy">Date &amp; Time</dt>
                <dd className="text-right text-slate-600">
                  {new Date(viewingEvent.event_date_time).toLocaleString()}
                </dd>
              </div>
              <div className="flex justify-between gap-4">
                <dt className="font-semibold text-navy">Location</dt>
                <dd className="text-right text-slate-600">
                  {viewingEvent.location}
                </dd>
              </div>
              <div className="flex justify-between gap-4">
                <dt className="font-semibold text-navy">Capacity</dt>
                <dd className="text-slate-600">{viewingEvent.capacity}</dd>
              </div>
              <div className="flex justify-between gap-4">
                <dt className="font-semibold text-navy">Organizer</dt>
                <dd className="text-slate-600">
                  {viewingEvent.organizer?.name || "Unknown"}
                </dd>
              </div>
            </dl>

            <div className="mt-6 flex justify-end">
              <button
                type="button"
                onClick={() => setViewingEvent(null)}
                className="rounded-xl bg-navy text-white text-sm font-semibold px-4 py-2 cursor-pointer"
              >
                Close
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
}
