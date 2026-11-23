export const CATEGORIES = [
  "Academic",
  "Sports",
  "Cultural",
  "Tech",
  "Social",
  "Workshop",
];

export const STATUSES = ["Upcoming", "Ongoing", "Completed", "Cancelled"];

export const SORT_FIELDS = [
  { value: "event_date_time", label: "Event Date" },
  { value: "capacity", label: "Capacity" },
  { value: "title", label: "Title" },
  { value: "created_at", label: "Date Created" },
];

export const CATEGORY_STYLES = {
  Academic: "bg-blue-50 border-blue-200 text-blue-800",
  Sports: "bg-emerald-50 border-emerald-200 text-emerald-800",
  Cultural: "bg-amber-50 border-amber-200 text-amber-800",
  Tech: "bg-violet-50 border-violet-200 text-violet-800",
  Social: "bg-rose-50 border-rose-200 text-rose-800",
  Workshop: "bg-indigo-50 border-indigo-200 text-indigo-800",
};

export const STATUS_STYLES = {
  Upcoming: "bg-sky-100 text-sky-800",
  Ongoing: "bg-emerald-100 text-emerald-800",
  Completed: "bg-slate-200 text-slate-700",
  Cancelled: "bg-red-100 text-red-700",
};
