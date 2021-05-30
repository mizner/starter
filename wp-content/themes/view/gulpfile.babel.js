import { series, parallel } from 'gulp';
import { scripts, chunkStyles, globalStyles, blockPreviewStyles, fonts, templates, images, svgs, sprite, clean, monitor, vendors, phpcs, phpcbf } from './tools/index';
import { serve } from './tools/tasks/serve';

const start = series(
  parallel(
    serve,
    monitor,
  ),
);

const build = series(
  clean,
  parallel(
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
  blockPreviewStyles,
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
  scripts,
  globalStyles,
  chunkStyles,
  build,
  start,
  prod
};
