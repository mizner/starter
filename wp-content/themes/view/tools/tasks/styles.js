import { mode } from '../utils/env';
import { paths, root } from '../utils/paths';
import { server } from './serve';
import { src, dest } from 'gulp';
import noop from 'gulp-noop';
import plumber from 'gulp-plumber';
import pump from 'pump';
import rename from 'gulp-rename';
import cleanCSS from 'gulp-clean-css';
import sourcemaps from 'gulp-sourcemaps';
import inject from 'gulp-header';
import postcss from 'gulp-postcss';
import postcssPresetEnv from 'postcss-preset-env';
import postcssImport from 'postcss-import';
import postcssGlobImport from 'postcss-import-ext-glob';
import autoprefixer from 'autoprefixer';
import tailwindCSS from 'tailwindcss';

const options = {
  tailwind: require(`${root}/tailwind.config.js`),
  cleanCSS: {
    level: {
      1: {
        specialComments: false,
      },
    },
  },
  rename: {
    suffix: 'production' === mode ? '.min' : '',
    extname: '.css',
  },
  autoprefixer: {
    grid: false, // autoplace,
    cascade: false,
  },
  postcssPresetEnvOptions: {
    stage: 3,
    features: {
      'nesting-rules': true
    }
  }
};

function globalStyles(cb) {
  return pump([
    src([
      `${paths.src.components}/base.css`
    ]),
    plumber(),
    'production' === mode ? noop() : sourcemaps.init(),
    postcss([
      postcssGlobImport(),
      postcssImport(),
    ]),
    inject(`@tailwind base; @tailwind components; @tailwind utilities; @tailwind screens;`),
    postcss([
      tailwindCSS(),
      postcssPresetEnv(options.postcssPresetEnvOptions),
      autoprefixer(options.autoprefixer),
    ]),
    'production' === mode ? cleanCSS(options.cleanCSS) : noop(),
    rename(options.rename),
    'production' === mode ? noop() : sourcemaps.write(),
    dest((currentPath => currentPath._base.replace('/src/', '/dist/'))),
    server.stream(),
  ], cb);
}

function chunkStyles(cb) {
  return pump([
    src([
      `${paths.src.components}/organisms/**/*.css`,
      `${paths.src.components}/templates/**/*.css`,
      `${paths.src.components}/pages/**/*.css`,
    ]),
    plumber(),
    'production' === mode ? noop() : sourcemaps.init(),
    postcss([
      postcssGlobImport(),
      postcssImport(),
      tailwindCSS(options.tailwind),
      postcssPresetEnv(options.postcssPresetEnvOptions),
      autoprefixer(options.autoprefixer),
    ]),
    'production' === mode ? cleanCSS(options.cleanCSS) : noop(),
    'production' === mode ? noop() : sourcemaps.write(),
    dest((currentPath => currentPath._base.replace('/src/', '/dist/'))),
    server.stream(),
  ], cb);
}

export {
    globalStyles,
    chunkStyles,
};
