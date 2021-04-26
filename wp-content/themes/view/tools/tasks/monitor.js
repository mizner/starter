import { series, watch } from 'gulp';
import { quit, reload } from './serve';
import { theme, plugin } from '../utils/paths';
import { scripts, images, globalStyles, chunkStyles, svgs, fonts, sprite, templates, phpcs, phpcbf } from '../index';

function monitor(cb) {
  // Kill build tools on config edit
  watch(
    [
      'tools/**/*',
      'gulpfile.babel.js',
      'babel.config.js',
      'package.json',
    ],
    quit,
  );
  // Handle font changes
  watch(
    [
      'src/fonts/**/*',
    ],
    fonts,
  );
  // Handle PHP change tasks
  watch(
    [
      `${theme}/**/*.php`,
      `!${theme}/vendor/**/*`,
      `${plugin}/**/*.php`,
      `!${plugin}/vendor/**/*`,
    ],
    series(
      // phpcs,
      // phpcbf,
      reload,
    ),
  );
  // Handle SVG's
  watch(
    [
      'src/**/*.svg',
    ],
    series(
      svgs,
      sprite,
      reload,
    ),
  );
  // Handle JS files changes
  watch(
    [
      'src/**/*.js',
      'views/**/*.js',
    ],
    series(
      scripts,
      tailwindStyles,
      reload,
    ),
  );
  // Handle CSS files changes
  watch(
    [
      'src/**/*.scss',
      '!src/styles/utils/theme.scss',
      'tailwind.config.js',
    ],
    series(
      globalStyles,
      chunkStyles,
    ),
  );
  // Handle Image changes
  watch(
    [
      'src/images/**/*',
    ],
    series(
      images,
      reload,
    ),
  );
  // Handle twig changes
  watch(
    [
      'src/components/**/*',
    ],
    series(
      templates,
      chunkStyles,
      tailwindStyles,
      reload,
    ),
  );
  cb();
}

export { monitor };
