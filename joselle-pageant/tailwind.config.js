/** @type {import('tailwindcss').Config} */
export default {
    content: ["./resources/**/*.blade.php", "./resources/**/*.js"],
    theme: {
        extend: {
            fontFamily: {
                brand: ['"Great Vibes"', "cursive"],
                heading: ['"Playfair Display"', "serif"],
                sans: ["Montserrat", "sans-serif"],
            },
            colors: {
                pageant: {
                    light: "#f8fafc", // Soft white
                    pink: "#ec4899", // Vibrant pink
                    rose: "#e11d48", // Deep red/rose
                    purple: "#7e22ce", // Rich purple
                    dark: "#0f172a", // Deep slate for contrast
                },
            },
        },
    },
    plugins: [],
};
