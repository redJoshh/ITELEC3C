import { CATEGORIES, SORT_FIELDS, STATUSES } from "../constants";

export default function FilterBar({ filters, onChange, onReset }) {
  const handle = (field) => (e) => onChange(field, e.target.value);

  return (
    <div className="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 mb-6">
      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
        <input
          type="text"
          value={filters.search}
          onChange={handle("search")}
          placeholder="Search title or location..."
          className="rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-coral/30 focus:border-coral"
        />

        <select
          value={filters.category}
          onChange={handle("category")}
          className="rounded-xl border border-slate-200 px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-coral/30 focus:border-coral"
        >
          <option value="">All Categories</option>
          {CATEGORIES.map((c) => (
            <option key={c} value={c}>
              {c}
            </option>
          ))}
        </select>

        <select
          value={filters.status}
          onChange={handle("status")}
          className="w-50 rounded-xl border border-slate-200 px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-coral/30 focus:border-coral"
        >
          <option value="">All Statuses</option>
          {STATUSES.map((s) => (
            <option key={s} value={s}>
              {s}
            </option>
          ))}
        </select>

        <div className="flex gap-2">
          <select
            value={filters.sort_by}
            onChange={handle("sort_by")}
            className="flex-1 rounded-xl border border-slate-200 px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-coral/30 focus:border-coral"
          >
            {SORT_FIELDS.map((f) => (
              <option key={f.value} value={f.value}>
                Sort: {f.label}
              </option>
            ))}
          </select>

          <select
            value={filters.sort_order}
            onChange={handle("sort_order")}
            className="w-50 rounded-xl border border-slate-200 px-2.5 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-coral/30 focus:border-coral"
          >
            <option value="asc">Ascending</option>
            <option value="desc">Descending</option>
          </select>
        </div>
      </div>

      <div className="flex flex-wrap items-center gap-3 mt-3 pt-3 border-t border-slate-100">
        <div className="flex items-center gap-2 text-xs text-slate-500">
          <span>From</span>
          <input
            type="date"
            value={filters.date_from}
            onChange={handle("date_from")}
            className="rounded-lg border border-slate-200 px-2.5 py-1.5 text-xs text-navy"
          />
          <span>To</span>
          <input
            type="date"
            value={filters.date_to}
            onChange={handle("date_to")}
            className="rounded-lg border border-slate-200 px-2.5 py-1.5 text-xs text-navy"
          />
        </div>

        <button
          type="button"
          onClick={onReset}
          className="ml-auto rounded-xl bg-slate-100 hover:bg-slate-200 text-navy text-xs font-medium px-3.5 py-2 transition cursor-pointer"
        >
          Reset Filters
        </button>
      </div>
    </div>
  );
}
