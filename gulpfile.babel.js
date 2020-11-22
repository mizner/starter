import { series, parallel } from 'gulp';
import { scripts, chunkStyles, globalStyles, tailwindStyles, fonts, templates, images, svgs, sprite, clean, monitor, vendors, phpcs, phpcbf, copy } from './tools/index';
import { serve } from './tools/tasks/serve';

const start = series(
  parallel(
    serve,
    monitor,
  ),
);

const build = series(
  clean,
  series(
    tailwindStyles,
    globalStyles,
    chunkStyles,
    scripts,
    fonts,
    templates,
    svgs,
    sprite,
    images,
    vendors,
    // phpcs,
    // phpcbf,
  ),
);

const prod = series(
  clean,
  parallel(
    fonts,
    tailwindStyles,
    globalStyles,
    chunkStyles,
    scripts,
    templates,
    svgs,
    sprite,
    images,
    vendors,
    copy,
  ),
);

export {
  build,
  start,
  prod
};
