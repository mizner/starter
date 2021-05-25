const isProduction = process.env.NODE_ENV === 'production'

module.exports = {
  important: false,
  mode: 'jit',
  purge: {
    content: [
      './src/**/*.twig',
      './src/**/*.js',
      './src/**/*.scss',
    ],
    enabled: isProduction
  },
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
        DEFAULT: '1.5rem',
        sm: '2rem',
        lg: '12rem',
        xl: '14.25rem',
      },
    },
    fontFamily: {
      // Please Keep this under 3 or less fonts if possible. - https://tailwindcss.com/docs/font-family/#app
      base: ['Open Sans', 'sans-serif'],
      // heading: ['Montserrat', 'sans-serif'],
      // accent: ['Montserrat', 'sans-serif'],
    },
    fontSize: {
      // Please base this on https://type-scale.com
      xs: '0.64rem',
      sm: '0.75rem',
      md: '1rem', // p, h6
      lg: '1.25rem', // h5
      xl: '1.625rem', // h4
      '1xl': '1.953rem', // h3
      '2xl': '2.25rem', // h2
      '3xl': '3.6875rem', // h1
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
        DEFAULT: '#bdbdbd',
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
      borderWidth: {
        1: '1px',
      },
      borderRadius: {
        none: '0',
        DEFAULT: '3px',
        sm: '0.125rem',
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
