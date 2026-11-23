import { CATEGORY_STYLES, STATUS_STYLES } from "../constants";

export default function EventCard({
  event,
  isArchived,
  canManage,
  canForceDelete,
  onView,
  onEdit,
  onDelete,
  onRestore,
  onForceDelete,
}) {
  const categoryStyle =
    CATEGORY_STYLES[event.category] ||
    "bg-slate-50 border-slate-200 text-slate-800";
  const statusStyle =
    STATUS_STYLES[event.status] || "bg-slate-100 text-slate-700";

  return (
    <div className="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex flex-col justify-between hover:shadow-md transition">
      <div>
        <div className="flex items-center justify-between gap-2 mb-3">
          <span
            className={`px-2.5 py-1 rounded-full text-xs font-semibold border ${categoryStyle}`}
          >
            {event.category}
          </span>
          <span
            className={`px-2.5 py-1 rounded-full text-xs font-medium ${statusStyle}`}
          >
            {event.status}
          </span>
        </div>

        <h3 className="text-base font-bold text-navy mb-1.5">{event.title}</h3>
        <p className="text-sm text-slate-600 line-clamp-3 mb-4">
          {event.description}
        </p>

        <dl className="space-y-1.5 text-xs text-slate-500">
          <div className="flex justify-between gap-2">
            <dt className="font-medium text-navy">Date</dt>
            <dd className="text-right">
              {new Date(event.event_date_time).toLocaleString()}
            </dd>
          </div>
          <div className="flex justify-between gap-2">
            <dt className="font-medium text-navy">Location</dt>
            <dd className="text-right">{event.location}</dd>
          </div>
          <div className="flex justify-between gap-2">
            <dt className="font-medium text-navy">Capacity</dt>
            <dd>{event.capacity}</dd>
          </div>
          <div className="flex justify-between gap-2">
            <dt className="font-medium text-navy">Organizer</dt>
            <dd>{event.organizer?.name || "Unknown"}</dd>
          </div>
        </dl>
      </div>

      <div className="flex flex-wrap gap-2 mt-4 pt-3 border-t border-slate-100">
        {!isArchived && (
          <button
            type="button"
            onClick={() => onView(event)}
            className="flex-1 rounded-xl bg-navy/5 hover:bg-navy/10 text-navy text-xs font-semibold py-2 transition cursor-pointer"
          >
            View
          </button>
        )}

        {canManage && !isArchived && (
          <>
            <button
              type="button"
              onClick={() => onEdit(event)}
              className="flex-1 rounded-xl bg-slate-100 hover:bg-slate-200 text-navy text-xs font-semibold py-2 transition cursor-pointer"
            >
              Edit
            </button>
            <button
              type="button"
              onClick={() => onDelete(event)}
              className="flex-1 rounded-xl bg-red-50 hover:bg-red-100 text-red-700 text-xs font-semibold py-2 transition cursor-pointer"
            >
              Delete
            </button>
          </>
        )}

        {canManage && isArchived && (
          <>
            <button
              type="button"
              onClick={() => onRestore(event)}
              className="flex-1 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-xs font-semibold py-2 transition cursor-pointer"
            >
              Restore
            </button>
            {canForceDelete && (
              <button
                type="button"
                onClick={() => onForceDelete(event)}
                className="flex-1 rounded-xl bg-red-50 hover:bg-red-100 text-red-700 text-xs font-semibold py-2 transition cursor-pointer"
              >
                Delete Forever
              </button>
            )}
          </>
        )}
      </div>
    </div>
  );
}
