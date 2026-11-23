import { useState } from "react";
import { useNavigate } from "react-router-dom";
import { useAuth } from "../useAuth";

export default function Login() {
  const { login } = useAuth();
  const navigate = useNavigate();

  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [error, setError] = useState("");
  const [fieldErrors, setFieldErrors] = useState({});
  const [submitting, setSubmitting] = useState(false);

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError("");
    setFieldErrors({});
    setSubmitting(true);

    try {
      await login(email, password);
      navigate("/events");
    } catch (err) {
      const status = err.response?.status;
      const data = err.response?.data;

      if (status === 422 && data?.errors) {
        setFieldErrors(data.errors);
      } else if (status === 401) {
        setError(data?.message || "Invalid email or password.");
      } else {
        setError("Unable to connect to the server.");
      }
    } finally {
      setSubmitting(false);
    }
  };

  return (
    <div className="min-h-screen flex items-center justify-center px-4">
      <div className="w-full max-w-md bg-white rounded-2xl shadow-sm border border-slate-100 p-8">
        <div className="mb-6">
          <span className="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-rose-50 text-coral mb-3">
            Campus Event Manager
          </span>
          <h1 className="text-2xl font-bold text-navy">Welcome back</h1>
          <p className="text-sm text-slate-500 mt-1">
            Sign in to browse and manage campus events.
          </p>
        </div>

        {error && (
          <div className="mb-4 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
            {error}
          </div>
        )}

        <form onSubmit={handleSubmit} className="space-y-4">
          <div>
            <label className="block text-sm font-medium text-navy mb-1">
              Email
            </label>
            <input
              type="email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              placeholder="karljatienza@gmail.com"
              required
              className="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-coral/30 focus:border-coral"
            />
            {fieldErrors.email && (
              <p className="mt-1 text-xs text-red-600">
                {fieldErrors.email[0]}
              </p>
            )}
          </div>

          <div>
            <label className="block text-sm font-medium text-navy mb-1">
              Password
            </label>
            <input
              type="password"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              placeholder="••••••••"
              required
              className="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-coral/30 focus:border-coral"
            />
            {fieldErrors.password && (
              <p className="mt-1 text-xs text-red-600">
                {fieldErrors.password[0]}
              </p>
            )}
          </div>

          <button
            type="submit"
            disabled={submitting}
            className="w-full rounded-xl bg-coral hover:bg-coral-hover text-white font-semibold py-2.5 text-sm transition cursor-pointer disabled:opacity-60"
          >
            {submitting ? "Signing in..." : "Sign In"}
          </button>
        </form>
      </div>
    </div>
  );
}
