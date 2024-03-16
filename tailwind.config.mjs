const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
export default {
	content: ['./src/**/*.{astro,html,js,jsx,md,mdx,svelte,ts,tsx,vue}', './node_modules/flowbite/**/*.js'
	],
	theme: {
		extend: {
			fontFamily: {
				mono: ["Jetbrains Mono Variable", ...defaultTheme.fontFamily.mono]
			}
		},
	},
	plugins: [require("@catppuccin/tailwindcss")({
		defaultFlavour: "mocha"
	}), require('flowbite/plugin')
	],
}
