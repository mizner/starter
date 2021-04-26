import { series, parallel } from 'gulp';
import { scripts, chunkStyles, globalStyles, fonts, templates, images, svgs, sprite, clean, monitor, vendors, phpcs, phpcbf } from './tools/index';
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
    globalStyles,
    chunkStyles,
    scripts,
    templates,
    svgs,
    sprite,
    images,
    vendors,
  ),
);

export {
  build,
  start,
  prod
};
