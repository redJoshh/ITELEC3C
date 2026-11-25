import { useEffect, useState } from "react";
import AOS from "aos";
import "aos/dist/aos.css";
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
  const [view, setView] = useState("active");
  const [reloadKey, setReloadKey] = useState(0);
  const [page, setPage] = useState(1);
  const [meta, setMeta] = useState(null);

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
  const goToPage = (targetPage) => {
    if (
      !meta ||
      targetPage < 1 ||
      targetPage > meta.last_page ||
      targetPage === page
    )
      return;
    setLoading(true);
    setPage(targetPage);
    window.scrollTo({ top: 0, behavior: "smooth" });
  };
  const canManage = (event) =>
    isAdmin ||
    (role === "organizer" && Number(event.user_id) === Number(user.id));

  useEffect(() => {
    const timer = setTimeout(() => {
      setDebouncedSearch(filters.search);
      setPage(1);
    }, 500);
    return () => clearTimeout(timer);
  }, [filters.search]);

  useEffect(() => {
    const controller = new AbortController();

    const params = {};
    if (view === "active") {
      params.page = page;
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
        setMeta(res.data.meta || null);
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

  const triggerReload = (message = "") => {
    setLoading(true);
    setFeedback(message);
    setReloadKey((k) => k + 1);
  };

  const handleFilterChange = (field, value) => {
    setLoading(true);
    if (field !== "search") setPage(1);
    setFilters((prev) => ({ ...prev, [field]: value }));
  };

  const handleReset = () => {
    setLoading(true);
    setFilters(DEFAULT_FILTERS);
    setDebouncedSearch("");
    setPage(1);
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

  useEffect(() => {
    AOS.init({
      duration: 550,
      easing: "ease-out-cubic",
      once: true,
      offset: 40,
    });
  }, []);

  useEffect(() => {
    AOS.refresh();
  }, [events, view]);

  return (
    <div className="min-h-screen">
      {/* Top Navbar */}
      <header className="bg-white border-b border-slate-100 sticky top-0 z-30">
        <div className="max-w-6xl mx-auto px-4 sm:px-6 py-4 flex flex-wrap items-center justify-between gap-3">
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
                <span className="font-semibold text-navy">{user.name}</span> (
                <span className="text-coral font-semibold">{user.role}</span>)
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

      <main className="max-w-6xl mx-auto px-4 sm:px-6 py-6">
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
                className="rounded-xl bg-slate-100 hover:bg-slate-200 disabled:opacity-40 disabled:pointer-events-none text-navy text-lg font-semibold px-3 py-2 transition cursor-pointer"
              >
                <i class="bi bi-arrow-left-short"></i>
              </button>

              {Array.from({ length: meta.last_page }, (_, i) => i + 1).map(
                (num) => (
                  <button
                    key={num}
                    type="button"
                    onClick={() => goToPage(num)}
                    className={`h-8 w-8 rounded-xl text-md font-semibold transition cursor-pointer ${
                      num === page
                        ? "bg-coral text-white"
                        : "bg-slate-100 hover:bg-slate-200 text-navy"
                    }`}
                  >
                    {num}
                  </button>
                ),
              )}

              <button
                type="button"
                onClick={() => goToPage(page + 1)}
                disabled={page >= meta.last_page}
                className="rounded-xl bg-slate-100 hover:bg-slate-200 disabled:opacity-40 disabled:pointer-events-none text-navy text-lg font-semibold px-3 py-2 transition cursor-pointer"
              >
                <i class="bi bi-arrow-right-short"></i>
              </button>
            </div>
          </div>
        )}
      </main>

      {formOpen && (
        <EventForm
          initialEvent={editingEvent}
          onSubmit={handleSave}
          onClose={() => setFormOpen(false)}
          serverErrors={serverErrors}
        />
      )}

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
