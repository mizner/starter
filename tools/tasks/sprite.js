import pump from 'pump';
import { paths, root } from '../utils/paths';
import { dest, src } from 'gulp';
import { config } from '../utils/env';

import svgSymbols from 'gulp-svg-symbols';
import svgo from 'gulp-svgo';
import rename from 'gulp-rename';
import { find } from 'globule';

const fa = `${root}/node_modules/@fortawesome/fontawesome-pro`;

function sprite(cb) {
  return pump(
    [
      src([
        ...config['fontawesome-pro'].map(svg => `${fa}/svgs/${svg}.svg`),
        ...find(`${paths.src.svgs}/sprite/*.svg`),
      ]),
      svgo(),
      svgSymbols({
        id: 'icon-%f',
        class: '.icon-%f',
        templates: ['default-svg'],
        warn: false,
        svgAttrs: {
          class: 'svg-icon-lib',
          'aria-hidden': 'true',
          style: 'position:absolute;width:0;height:0;overflow:hidden;',
          'data-enabled': 'true',
        },
      }),
      rename({
        basename: 'sprite',
      }),
      dest(paths.dist.svgs),
    ],
    cb,
  );
}

export { sprite };
