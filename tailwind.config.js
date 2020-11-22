module.exports = {
  important: false,
  purge: [
    './src/**/*.twig',
    './src/**/*.js',
    './src/**/*.scss',
  ],
  theme: {
    // https://tailwindcss.com/docs/theme/#app
    screens: {
      sm: '640px',
      md: '768px',
      lg: '1024px',
      xl: '1280px',
    },
    // https://tailwindcss.com/docs/container/#app
    container: {
      center: true,
      padding: {
        default: '1rem',
        sm: '2rem',
        lg: '4rem',
        xl: '6rem',
      },
    },
    fontFamily: {
      // Please Keep this under 3 or less fonts if possible. - https://tailwindcss.com/docs/font-family/#app
      base: ['IBM Plex Sans', 'sans-serif'],
      // primary: ['Montserrat', 'sans-serif'],
      // secondary: ['Montserrat', 'sans-serif'],
      // tertiary: ['Montserrat', 'sans-serif'],
    },
    fontSize: {
      // Please base this on https://type-scale.com
      xs: '0.64rem',
      sm: '0.75rem',
      base: '1rem', // p, h6
      md: '1.25rem', // h5
      lg: '1.625rem', // h4
      xl: '1.953rem', // h3
      '1xl': '2.25rem', // h2
      '2xl': '3.6875rem', // h1
      '3xl': '4.8rem',
      '4xl': '6.9375rem',
    },
    colors: {
      // https://tailwindcss.com/docs/customizing-colors/#app
      light: '#FEFFFF',
      dark: '#000000',
      primary: '#FFD100',
      transparent: 'transparent',
      warning: '#FF7B00',
      error: '#B61200',
      gray: {
        100: '#f5f5f5',
        200: '#eeeeee',
        300: '#e0e0e0',
        400: '#bdbdbd',
        500: '#9e9e9e',
        600: '#757575',
        700: '#616161',
        800: '#424242',
        900: '#212121',
      },
    },
    extend: {
      // https://tailwindcss.com/docs/theme/#app
      screens: {
        '2xl': '1440px',
      },
    },
  },
  corePlugins: {
    float: false,
    objectFit: true,
    objectPosition: false,
    // preflight: false,
  },
};
