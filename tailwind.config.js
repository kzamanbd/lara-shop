import defaultTheme from "tailwindcss/defaultTheme";
import colors from "tailwindcss/colors";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";
import aspectRatio from "@tailwindcss/aspect-ratio";
import { addDynamicIconSelectors } from "@iconify/tailwind";

/** @type {import('tailwindcss').Config} */

const primary = colors.green;
const colorConfig = {
    dark: {
        ...colors.slate,
        DEFAULT: "#1F2937",
    },
    white: {
        DEFAULT: "#FFFFFF",
        light: "#E0E6ED",
    },
    light: "#F5F8FA",
    primary: {
        ...primary,
        DEFAULT: "#00A76F",
    },
    info: {
        ...colors.indigo,
        DEFAULT: colors.indigo[500],
    },
    danger: {
        ...colors.rose,
        DEFAULT: colors.rose[500],
    },
    success: {
        ...colors.emerald,
        DEFAULT: colors.emerald[500],
    },
    warning: {
        ...colors.amber,
        DEFAULT: colors.amber[500],
    },
    secondary: {
        ...colors.gray,
        DEFAULT: colors.gray[400],
    },
};

export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],
    darkMode: "class", // or 'media'

    theme: {
        extend: {
            colors: colorConfig,
            fontFamily: {
                sans: [
                    'Inter, Helvetica, "sans-serif"',
                    ...defaultTheme.fontFamily.sans,
                ],
            },
        },
    },

    plugins: [forms, typography, aspectRatio, addDynamicIconSelectors()],
};
