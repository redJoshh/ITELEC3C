import { useEffect, useState } from "react";
import AOS from "aos";
import "aos/dist/aos.css";
import api from "../api";
import { useAuth } from "../useAuth";
import FilterBar from "../components/FilterBar";
import EventCard from "../components/EventCard";
import EventForm from "../components/EventForm";

const DEFAULT_FILTERS = {
  search: "",
  category: "",
  status: "",
  date_from: "",
  date_to: "",
  sort_by: "event_date_time",
  sort_order: "asc",
};

function formatDate(dateString) {
  if (!dateString) return "N/A";
  return new Date(dateString).toLocaleString();
}

export default function Events() {
  const { user, logout } = useAuth();

  const [view, setView] = useState("active");
  const [events, setEvents] = useState([]);
  const [meta, setMeta] = useState(null);
  const [page, setPage] = useState(1);

  const [filters, setFilters] = useState(DEFAULT_FILTERS);
  const [debouncedSearch, setDebouncedSearch] = useState("");

  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");
  const [success, setSuccess] = useState("");
  const [reloadKey, setReloadKey] = useState(0);

  const [formOpen, setFormOpen] = useState(false);
  const [editingEvent, setEditingEvent] = useState(null);
  const [formErrors, setFormErrors] = useState({});
  const [formError, setFormError] = useState("");
  const [viewingEvent, setViewingEvent] = useState(null);

  const isAdmin = user?.role === "admin";
  const isOrganizer = user?.role === "organizer";
  const canCreate = isAdmin || isOrganizer;

  const canManage = (event) => {
    if (isAdmin) return true;
    if (
      isOrganizer &&
      (event.user_id === user.id || event.user?.id === user.id)
    ) {
      return true;
    }
    return false;
  };

  useEffect(() => {
    AOS.init({ duration: 500, once: true });
  }, []);

  useEffect(() => {
    const timer = setTimeout(() => {
      setDebouncedSearch(filters.search);
    }, 300);

    return () => clearTimeout(timer);
  }, [filters.search]);

  useEffect(() => {
    const params = { page };

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
      .get(endpoint, { params })
      .then((res) => {
        setEvents(res.data.data);
        setMeta(res.data.meta || null);
        setError("");
      })
      .catch((err) => {
        setError(err.response?.data?.message || "Failed to load events.");
      })
      .finally(() => {
        setLoading(false);
      });
  }, [
    view,
    page,
    debouncedSearch,
    filters.category,
    filters.status,
    filters.date_from,
    filters.date_to,
    filters.sort_by,
    filters.sort_order,
    reloadKey,
  ]);

  useEffect(() => {
    AOS.refresh();
  }, [events]);

  const handleFilterChange = (field, value) => {
    setLoading(true);
    setPage(1);
    setFilters((prev) => ({ ...prev, [field]: value }));
  };

  const handleReset = () => {
    setLoading(true);
    setPage(1);
    setFilters(DEFAULT_FILTERS);
    setDebouncedSearch("");
  };

  const handleTabChange = (nextView) => {
    if (nextView === view) return;
    setLoading(true);
    setPage(1);
    setSuccess("");
    setError("");
    setView(nextView);
  };

  const goToPage = (nextPage) => {
    setLoading(true);
    setPage(nextPage);
    window.scrollTo({ top: 0, behavior: "smooth" });
  };

  const openCreate = () => {
    setEditingEvent(null);
    setFormErrors({});
    setFormError("");
    setFormOpen(true);
  };

  const openEdit = (event) => {
    setEditingEvent(event);
    setFormErrors({});
    setFormError("");
    setFormOpen(true);
  };

  const closeForm = () => {
    setFormOpen(false);
    setEditingEvent(null);
    setFormErrors({});
    setFormError("");
  };

  const handleFormSubmit = async (payload) => {
    setFormErrors({});
    setFormError("");

    try {
      if (editingEvent) {
        await api.patch(`/events/${editingEvent.id}`, payload);
        setSuccess("Event updated successfully.");
      } else {
        await api.post("/events", payload);
        setSuccess("Event created successfully.");
      }

      closeForm();
      setLoading(true);
      setReloadKey((k) => k + 1);
    } catch (err) {
      const status = err.response?.status;
      const data = err.response?.data;

      if (status === 422 && data?.errors) {
        setFormErrors(data.errors);
      } else if (status === 403) {
        setFormError(data?.message || "You do not have permission to do that.");
      } else {
        setFormError(
          data?.message || "Something went wrong. Please try again.",
        );
      }
    }
  };

  const handleDelete = async (event) => {
    if (!window.confirm(`Archive "${event.title}"?`)) return;

    try {
      await api.delete(`/events/${event.id}`);
      setSuccess("Event archived successfully.");
      setLoading(true);
      setReloadKey((k) => k + 1);
    } catch (err) {
      setError(err.response?.data?.message || "Failed to archive event.");
    }
  };

  const handleRestore = async (event) => {
    try {
      await api.post(`/events/${event.id}/restore`);
      setSuccess("Event restored successfully.");
      setLoading(true);
      setReloadKey((k) => k + 1);
    } catch (err) {
      setError(err.response?.data?.message || "Failed to restore event.");
    }
  };

  const handleForceDelete = async (event) => {
    if (
      !window.confirm(
        `Permanently delete "${event.title}"? This cannot be undone.`,
      )
    ) {
      return;
    }

    try {
      await api.delete(`/events/${event.id}/forcedelete`);
      setSuccess("Event permanently deleted.");
      setLoading(true);
      setReloadKey((k) => k + 1);
    } catch (err) {
      setError(
        err.response?.data?.message || "Failed to permanently delete event.",
      );
    }
  };

  const pageNumbers = [];
  if (meta?.last_page) {
    for (let i = 1; i <= meta.last_page; i++) {
      pageNumbers.push(i);
    }
  }

  return (
    <div className="min-h-screen pb-12">
      <header className="bg-white/95 border-b border-slate-100 sticky top-0 z-30 backdrop-blur-sm">
        <div className="max-w-6xl mx-auto px-4 py-4 flex flex-wrap items-center justify-between gap-4">
          <div className="flex items-center gap-3">
            <img
              src="/kj-logo.png"
              alt="Campus Event Manager logo"
              className="h-9 w-9 object-contain shrink-0"
            />
            <div>
              <h1 className="text-xl font-bold text-navy">
                Campus Event Manager
              </h1>
              <p className="text-xs text-slate-500">
                Signed in as{" "}
                <span className="font-semibold text-navy">{user?.name}</span> (
                <span className="text-coral font-semibold">{user?.role}</span>)
              </p>
            </div>
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

      <main className="max-w-6xl mx-auto px-4 mt-6">
        {canCreate && (
          <div className="flex items-center gap-2 mb-5">
            <button
              type="button"
              onClick={() => handleTabChange("active")}
              className={`rounded-xl px-4 py-2 text-sm font-semibold transition cursor-pointer ${
                view === "active"
                  ? "bg-navy text-white"
                  : "bg-white text-navy border border-slate-200 hover:bg-slate-50"
              }`}
            >
              Active Events
            </button>
            <button
              type="button"
              onClick={() => handleTabChange("archived")}
              className={`rounded-xl px-4 py-2 text-sm font-semibold transition cursor-pointer ${
                view === "archived"
                  ? "bg-navy text-white"
                  : "bg-white text-navy border border-slate-200 hover:bg-slate-50"
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

        {success && (
          <div className="mb-4 flex items-center justify-between rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-3 text-sm text-emerald-700">
            <span>{success}</span>
            <button
              type="button"
              onClick={() => setSuccess("")}
              className="font-bold text-emerald-700 hover:text-emerald-900 cursor-pointer"
            >
              &times;
            </button>
          </div>
        )}

        {error && (
          <div className="mb-4 flex items-center justify-between rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
            <span>{error}</span>
            <button
              type="button"
              onClick={() => setError("")}
              className="font-bold text-red-700 hover:text-red-900 cursor-pointer"
            >
              &times;
            </button>
          </div>
        )}

        {loading ? (
          <div className="text-center py-20 text-sm text-slate-500">
            Loading events...
          </div>
        ) : events.length === 0 ? (
          <div className="bg-white/95 rounded-2xl border border-slate-100 p-12 text-center shadow-sm">
            <p className="text-navy font-semibold">
              {view === "archived"
                ? "No archived events found."
                : "No events matched your filters."}
            </p>
            <p className="text-xs text-slate-500 mt-1">
              {view === "archived"
                ? "Archived events will appear here."
                : "Try adjusting your search or resetting your filters."}
            </p>
          </div>
        ) : (
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            {events.map((event, index) => (
              <div
                key={`${view}-${event.id}`}
                data-aos="fade-up"
                data-aos-delay={(index % 3) * 80}
                className="flex"
              >
                <EventCard
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
              </div>
            ))}
          </div>
        )}

        {!loading && meta && meta.last_page > 1 && (
          <div className="mt-8 flex flex-wrap items-center justify-between gap-4 bg-white/95 rounded-2xl border border-slate-100 px-5 py-3.5 shadow-sm">
            <p className="text-xs text-slate-500">
              Showing{" "}
              <span className="font-semibold text-navy">{meta.from}</span>–
              <span className="font-semibold text-navy">{meta.to}</span> of{" "}
              <span className="font-semibold text-navy">{meta.total}</span>{" "}
              events
            </p>

            <div className="flex items-center gap-1.5">
              <button
                type="button"
                onClick={() => goToPage(page - 1)}
                disabled={page <= 1}
                className="rounded-xl bg-slate-100 hover:bg-slate-200 disabled:opacity-40 disabled:pointer-events-none text-navy text-xs font-semibold px-3 py-2 transition cursor-pointer"
              >
                Prev
              </button>

              {pageNumbers.map((num) => (
                <button
                  key={num}
                  type="button"
                  onClick={() => goToPage(num)}
                  className={`h-8 w-8 rounded-xl text-xs font-semibold transition cursor-pointer ${
                    num === page
                      ? "bg-coral text-white"
                      : "bg-slate-100 hover:bg-slate-200 text-navy"
                  }`}
                >
                  {num}
                </button>
              ))}

              <button
                type="button"
                onClick={() => goToPage(page + 1)}
                disabled={page >= meta.last_page}
                className="rounded-xl bg-slate-100 hover:bg-slate-200 disabled:opacity-40 disabled:pointer-events-none text-navy text-xs font-semibold px-3 py-2 transition cursor-pointer"
              >
                Next
              </button>
            </div>
          </div>
        )}
      </main>

      {formOpen && (
        <EventForm
          initialEvent={editingEvent}
          onSubmit={handleFormSubmit}
          onClose={closeForm}
          serverErrors={formErrors}
          serverError={formError}
        />
      )}

      {viewingEvent && (
        <div className="fixed inset-0 z-50 flex items-center justify-center bg-navy/40 p-4">
          <div className="w-full max-w-lg bg-white rounded-2xl shadow-xl p-6">
            <div className="flex items-start justify-between gap-4 mb-4">
              <div>
                <div className="flex items-center gap-2 mb-2">
                  <span className="px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-navy">
                    {viewingEvent.category}
                  </span>
                  <span className="px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-600">
                    {viewingEvent.status}
                  </span>
                </div>
                <h2 className="text-lg font-bold text-navy">
                  {viewingEvent.title}
                </h2>
              </div>

              <button
                type="button"
                onClick={() => setViewingEvent(null)}
                className="text-slate-400 hover:text-navy text-xl leading-none cursor-pointer"
              >
                &times;
              </button>
            </div>

            <p className="text-sm text-slate-600 mb-5 leading-relaxed">
              {viewingEvent.description}
            </p>

            <div className="space-y-2 text-sm border-t border-slate-100 pt-4">
              <div className="flex justify-between gap-4">
                <span className="font-semibold text-navy">Date &amp; Time</span>
                <span className="text-slate-600 text-right">
                  {formatDate(viewingEvent.event_date_time)}
                </span>
              </div>
              <div className="flex justify-between gap-4">
                <span className="font-semibold text-navy">Location</span>
                <span className="text-slate-600 text-right">
                  {viewingEvent.location}
                </span>
              </div>
              <div className="flex justify-between gap-4">
                <span className="font-semibold text-navy">Capacity</span>
                <span className="text-slate-600">{viewingEvent.capacity}</span>
              </div>
              <div className="flex justify-between gap-4">
                <span className="font-semibold text-navy">Organizer</span>
                <span className="text-slate-600">
                  {viewingEvent.user?.name ||
                    viewingEvent.organizer?.name ||
                    viewingEvent.organizer ||
                    "N/A"}
                </span>
              </div>
            </div>

            <div className="flex justify-end mt-6 pt-3 border-t border-slate-100">
              <button
                type="button"
                onClick={() => setViewingEvent(null)}
                className="rounded-xl bg-slate-100 hover:bg-slate-200 text-navy text-sm font-medium px-4 py-2 transition cursor-pointer"
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
