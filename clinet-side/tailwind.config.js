module.exports = {
  // mode: 'jit',
  purge: ['./src/**/*.{html,ts}'],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      textColor:{
        primary:'var(--text-primary)',
        secondary:'var(--text-secondary)'
      },
      backgroundColor:{
        "google-btn":'var(--google-btn)'
      }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
};
