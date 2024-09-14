/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
    './app/Http/Livewire/**/*.php', // Add this line for Livewire components
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
