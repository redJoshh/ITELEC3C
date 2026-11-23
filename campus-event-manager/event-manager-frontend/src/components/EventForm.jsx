import { useState } from "react";
import { CATEGORIES, STATUSES } from "../constants";

function toDateTimeLocal(isoString) {
  if (!isoString) return "";
  // "2026-12-04T19:00:00+08:00" -> "2026-12-04T19:00"
  return isoString.slice(0, 16);
}

export default function EventForm({
  initialEvent,
  onSubmit,
  onClose,
  serverErrors,
}) {
  const isEditing = Boolean(initialEvent);

  const [form, setForm] = useState({
    title: initialEvent?.title || "",
    description: initialEvent?.description || "",
    event_date_time: toDateTimeLocal(initialEvent?.event_date_time),
    location: initialEvent?.location || "",
    category: initialEvent?.category || CATEGORIES[0],
    status: initialEvent?.status || STATUSES[0],
    capacity: initialEvent?.capacity ?? 50,
  });

  const [clientErrors, setClientErrors] = useState({});
  const [submitting, setSubmitting] = useState(false);

  const errors = { ...serverErrors, ...clientErrors };

  const handleChange = (field) => (e) => {
    setForm((prev) => ({ ...prev, [field]: e.target.value }));
    setClientErrors((prev) => ({ ...prev, [field]: undefined }));
  };

  const validate = () => {
    const next = {};
    if (!form.title.trim()) next.title = ["Title is required."];
    if (!form.description.trim())
      next.description = ["Description is required."];
    else if (form.description.length > 500)
      next.description = ["Description must be 500 characters or fewer."];
    if (!form.event_date_time)
      next.event_date_time = ["Date and time is required."];
    if (!form.location.trim()) next.location = ["Location is required."];
    if (Number(form.capacity) < 1)
      next.capacity = ["Capacity must be at least 1."];
    return next;
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    const nextErrors = validate();
    if (Object.keys(nextErrors).length > 0) {
      setClientErrors(nextErrors);
      return;
    }

    setSubmitting(true);
    try {
      await onSubmit({
        ...form,
        capacity: Number(form.capacity),
      });
    } finally {
      setSubmitting(false);
    }
  };

  return (
    <div className="fixed inset-0 z-50 flex items-center justify-center bg-navy/40 p-4">
      <div className="w-full max-w-lg bg-white rounded-2xl shadow-xl p-6 max-h-[90vh] overflow-y-auto">
        <div className="flex items-center justify-between mb-4">
          <h2 className="text-lg font-bold text-navy">
            {isEditing ? "Edit Event" : "Create New Event"}
          </h2>
          <button
            type="button"
            onClick={onClose}
            className="text-slate-400 hover:text-navy text-xl leading-none cursor-pointer"
          >
            &times;
          </button>
        </div>

        <form onSubmit={handleSubmit} className="space-y-4">
          <div>
            <label className="block text-xs font-semibold text-navy mb-1">
              Title
            </label>
            <input
              type="text"
              value={form.title}
              onChange={handleChange("title")}
              className="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-coral/30 focus:border-coral"
            />
            {errors.title && (
              <p className="mt-1 text-xs text-red-600">{errors.title[0]}</p>
            )}
          </div>

          <div>
            <label className="block text-xs font-semibold text-navy mb-1">
              Description ({form.description.length}/500)
            </label>
            <textarea
              rows={3}
              value={form.description}
              onChange={handleChange("description")}
              className="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-coral/30 focus:border-coral"
            />
            {errors.description && (
              <p className="mt-1 text-xs text-red-600">
                {errors.description[0]}
              </p>
            )}
          </div>

          <div className="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div>
              <label className="block text-xs font-semibold text-navy mb-1">
                Date &amp; Time
              </label>
              <input
                type="datetime-local"
                value={form.event_date_time}
                onChange={handleChange("event_date_time")}
                className="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-coral/30 focus:border-coral"
              />
              {errors.event_date_time && (
                <p className="mt-1 text-xs text-red-600">
                  {errors.event_date_time[0]}
                </p>
              )}
            </div>

            <div>
              <label className="block text-xs font-semibold text-navy mb-1">
                Capacity
              </label>
              <input
                type="number"
                min={1}
                value={form.capacity}
                onChange={handleChange("capacity")}
                className="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-coral/30 focus:border-coral"
              />
              {errors.capacity && (
                <p className="mt-1 text-xs text-red-600">
                  {errors.capacity[0]}
                </p>
              )}
            </div>
          </div>

          <div>
            <label className="block text-xs font-semibold text-navy mb-1">
              Location
            </label>
            <input
              type="text"
              value={form.location}
              onChange={handleChange("location")}
              className="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-coral/30 focus:border-coral"
            />
            {errors.location && (
              <p className="mt-1 text-xs text-red-600">{errors.location[0]}</p>
            )}
          </div>

          <div className="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div>
              <label className="block text-xs font-semibold text-navy mb-1">
                Category
              </label>
              <select
                value={form.category}
                onChange={handleChange("category")}
                className="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm bg-white"
              >
                {CATEGORIES.map((c) => (
                  <option key={c} value={c}>
                    {c}
                  </option>
                ))}
              </select>
              {errors.category && (
                <p className="mt-1 text-xs text-red-600">
                  {errors.category[0]}
                </p>
              )}
            </div>

            <div>
              <label className="block text-xs font-semibold text-navy mb-1">
                Status
              </label>
              <select
                value={form.status}
                onChange={handleChange("status")}
                className="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm bg-white"
              >
                {STATUSES.map((s) => (
                  <option key={s} value={s}>
                    {s}
                  </option>
                ))}
              </select>
              {errors.status && (
                <p className="mt-1 text-xs text-red-600">{errors.status[0]}</p>
              )}
            </div>
          </div>

          <div className="flex justify-end gap-2 pt-3 border-t border-slate-100">
            <button
              type="button"
              onClick={onClose}
              className="rounded-xl bg-slate-100 hover:bg-slate-200 text-navy text-sm font-medium px-4 py-2 transition cursor-pointer"
            >
              Cancel
            </button>
            <button
              type="submit"
              disabled={submitting}
              className="rounded-xl bg-coral hover:bg-coral-hover text-white text-sm font-semibold px-5 py-2 transition cursor-pointer disabled:opacity-60"
            >
              {submitting
                ? "Saving..."
                : isEditing
                  ? "Save Changes"
                  : "Create Event"}
            </button>
          </div>
        </form>
      </div>
    </div>
  );
}
