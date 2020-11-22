import { mode } from '../utils/env';
import { paths, root } from '../utils/paths';
import { server } from './serve';
import { src, dest } from 'gulp';
import noop from 'gulp-noop';
import plumber from 'gulp-plumber';
import pump from 'pump';
import sass from 'gulp-sass';
import rename from 'gulp-rename';
import cleanCSS from 'gulp-clean-css';
import sourcemaps from 'gulp-sourcemaps';
import sassImport from 'node-sass-package-importer';
import inject from 'gulp-header';
import sassGlob from 'gulp-sass-glob';
import postcss from 'gulp-postcss';
import autoprefixer from 'autoprefixer';
import tailwindCSS from 'tailwindcss';
import postCSSNoop from 'postcss-noop';

const options = {
  tailwind: require(`${root}/tailwind.config.js`),
  cleanCSS: {
    level: {
      1: {
        specialComments: false,
      },
    },
  },
  sass: {
    importer: sassImport(),
    includePaths: [
      paths.src.styles,
      paths.src.views,
      tailwindCSS.includePaths,
    ],
  },
  rename: {
    // suffix: 'production' === mode ? '.min' : '',
    extname: '.css',
  },
  autoprefixer: {
    grid: false, // autoplace,
    cascade: false,
  },
  purgeCSS: {
    whitelist: [
      'body',
    ],
    css: [
      './src/**/*.scss',
    ],
    content: [
      './src/**/*.js',
      './src/**/*.twig',
    ],
  },
};

function tailwindStyles(cb) {
  return pump([
    src(`${paths.src.styles}/tailwind.css`),
    plumber(),
    'production' === mode ? noop() : sourcemaps.init(),
    postcss([
      tailwindCSS(options.tailwind),
      autoprefixer(options.autoprefixer),
    ]),
    'production' === mode ? cleanCSS(options.cleanCSS) : noop(),
    rename(options.rename),
    'production' === mode ? noop() : sourcemaps.write(),
    dest(paths.dist.styles),
    server.stream(),
  ], cb);
}

function globalStyles(cb) {
  return pump([
    src([`${paths.src.styles}/*.scss`]),
    plumber(),
    'production' === mode ? noop() : sourcemaps.init(),
    sassGlob(),
    sass(options.sass).on('error', sass.logError),
    postcss([
      tailwindCSS(),
      // 'production' === mode ? purgeCSS(options.purgeCSS) : postCSSNoop(),
      autoprefixer(options.autoprefixer),
    ]),
    'production' === mode ? cleanCSS(options.cleanCSS) : noop(),
    rename(options.rename),
    'production' === mode ? noop() : sourcemaps.write(),
    dest(paths.dist.styles),
    server.stream(),
  ], cb);
}

function chunkStyles(cb) {
  return pump([
    src([
      `${paths.src.components}/organisms/**/*.scss`,
      `${paths.src.components}/templates/**/*.scss`,
      `${paths.src.components}/pages/**/*.scss`,
    ]),
    plumber(),
    'production' === mode ? noop() : sourcemaps.init(),
    inject(`
      @import "../../styles/utils/**/*";
    `),
    sassGlob(),
    sass(options.sass).on('error', sass.logError),
    postcss([
      tailwindCSS(options.tailwind),
      autoprefixer(options.autoprefixer),
    ]),
    rename(options.rename),
    'production' === mode ? noop() : sourcemaps.write(),
    dest(paths.dist.components),
    server.stream(),
  ], cb);
}

export { globalStyles, chunkStyles, tailwindStyles };
