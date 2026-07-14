import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                "primary-fixed": "#ffdbc8",
                "on-tertiary": "#ffffff",
                "surface-container-highest": "#eee0d8",
                "inverse-on-surface": "#fceee6",
                "outline-variant": "#d5c3ba",
                "secondary-fixed-dim": "#dac2b2",
                "primary-fixed-dim": "#f2bb9b",
                "surface-dim": "#e5d7d0",
                "on-surface-variant": "#51443e",
                "tertiary-fixed": "#bfeaf4",
                "secondary": "#6d5b4e",
                "on-primary": "#ffffff",
                "on-primary-container": "#7a5138",
                "on-primary-fixed-variant": "#643e26",
                "on-surface": "#211a16",
                "tertiary": "#3b656d",
                "on-tertiary-fixed-variant": "#224d55",
                "error": "#ba1a1a",
                "on-secondary": "#ffffff",
                "on-error": "#ffffff",
                "tertiary-container": "#afdae4",
                "secondary-fixed": "#f7decd",
                "on-background": "#211a16",
                "on-primary-fixed": "#301402",
                "on-tertiary-container": "#376169",
                "tertiary-fixed-dim": "#a3ced8",
                "surface-container-lowest": "#ffffff",
                "secondary-container": "#f4dbca",
                "surface-container": "#f9ebe3",
                "inverse-primary": "#f2bb9b",
                "on-secondary-container": "#725f52",
                "surface-container-high": "#f4e5de",
                "inverse-surface": "#372f2a",
                "surface-bright": "#fff8f5",
                "primary-container": "#ffc7a7",
                "on-secondary-fixed": "#26190f",
                "error-container": "#ffdad6",
                "on-secondary-fixed-variant": "#544337",
                "on-tertiary-fixed": "#001f25",
                "surface-tint": "#7e553b",
                "primary": "#7e553b",
                "surface-variant": "#eee0d8",
                "on-error-container": "#93000a",
                "surface": "#fff8f5",
                "outline": "#83746c",
                "surface-container-low": "#fff1e9",
                "background": "#fff8f5"
            },
            borderRadius: {
                "DEFAULT": "0.25rem",
                "lg": "0.5rem",
                "xl": "0.75rem",
                "2xl": "1.5rem",
                "full": "9999px"
            },
            spacing: {
                "lg": "48px",
                "gutter": "24px",
                "base": "8px",
                "container-max": "1280px",
                "xl": "80px",
                "md": "24px",
                "sm": "12px",
                "xs": "4px"
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                "display-lg": ["Manrope", ...defaultTheme.fontFamily.sans],
                "body-md": ["Manrope", ...defaultTheme.fontFamily.sans],
                "body-lg": ["Manrope", ...defaultTheme.fontFamily.sans],
                "headline-md": ["Manrope", ...defaultTheme.fontFamily.sans],
                "label-md": ["Manrope", ...defaultTheme.fontFamily.sans],
                "headline-sm": ["Manrope", ...defaultTheme.fontFamily.sans],
                "label-sm": ["Manrope", ...defaultTheme.fontFamily.sans],
                "display-lg-mobile": ["Manrope", ...defaultTheme.fontFamily.sans]
            },
            fontSize: {
                "display-lg": ["48px", { "lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                "body-md": ["16px", { "lineHeight": "1.6", "fontWeight": "400" }],
                "body-lg": ["18px", { "lineHeight": "1.6", "fontWeight": "400" }],
                "headline-md": ["30px", { "lineHeight": "1.3", "letterSpacing": "-0.01em", "fontWeight": "600" }],
                "label-md": ["14px", { "lineHeight": "1", "letterSpacing": "0.01em", "fontWeight": "500" }],
                "headline-sm": ["24px", { "lineHeight": "1.4", "fontWeight": "600" }],
                "label-sm": ["12px", { "lineHeight": "1", "letterSpacing": "0.05em", "fontWeight": "600" }],
                "display-lg-mobile": ["36px", { "lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700" }]
            },
            boxShadow: {
                'neon': '0 0 15px rgba(255, 199, 167, 0.6), 0 0 30px rgba(255, 219, 200, 0.4), 0 0 45px rgba(255, 199, 167, 0.2)',
                'ambient': '0 10px 30px rgba(255, 199, 167, 0.25)',
            },
            backgroundImage: {
                'gradient-peach-neon': 'linear-gradient(135deg, #FFC7A7 0%, #FFDBC8 100%, #FFC7A7 200%)',
            }
        },
    },

    plugins: [forms],
};
