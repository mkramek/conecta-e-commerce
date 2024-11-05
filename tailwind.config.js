const defaultTheme = require("tailwindcss/defaultTheme");
const colors = require("tailwindcss/colors");

module.exports = {
    presets: [
		require("./vendor/wireui/wireui/tailwind.config.js"),
		 require("./vendor/power-components/livewire-powergrid/tailwind.config.js"),
		 "./vendor/robsontenorio/mary/src/View/Components/**/*.php"
	],
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                primary: colors.orange,
                "pg-primary": colors.gray,
            },
            fontFamily: {
                sans: ["Inter var", ...defaultTheme.fontFamily.sans],
            },
            animation: {
                fadein: "fadeIn .5s ease-in-out",
                fadeout: "fadeOut .5s ease-in-out",
            },
            keyframes: {
                fadeIn: {
                    from: { opacity: 0 },
                    to: { opacity: 1 },
                },
                fadeOut: {
                    from: { opacity: 1 },
                    to: { opacity: 0 },
                },
            },
        },
    },
    variants: {
        extend: {
            backgroundColor: ["active"],
        },
    },
    content: [
        "./app/**/*.php",
        "./resources/**/*.html",
        "./resources/**/*.js",
        "./resources/**/*.jsx",
        "./resources/**/*.ts",
        "./resources/**/*.tsx",
        "./resources/**/*.php",
        "./resources/**/*.vue",
        "./resources/**/*.twig",
        "./vendor/wireui/wireui/resources/**/*.blade.php",
        "./vendor/wireui/wireui/ts/**/*.ts",
        "./vendor/wireui/wireui/src/View/**/*.php",
        "./vendor/wireui/breadcrumbs/src/Components/**/*.php",
        "./vendor/wireui/breadcrumbs/src/views/**/*.blade.php",
        "./node_modules/tw-elements/js/**/*.js",
        "./vendor/power-components/livewire-powergrid/resources/views/**/*.php",
        "./vendor/power-components/livewire-powergrid/src/Themes/Tailwind.php",
    ],
    plugins: [
		require("@tailwindcss/forms"),
		require("@tailwindcss/typography"),
		require("tw-elements/plugin.cjs"),
		require("daisyui")
	],
};
