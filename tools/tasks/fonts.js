import pump from 'pump';
import { dest, src } from 'gulp';
import { paths } from '../utils/paths';
import flatten from 'gulp-flatten';

const fontTypes = ['woff', 'woff2', 'ttf', 'otf', 'eot'];

function fonts(cb) {
  return pump(
    [
      src(fontTypes.map(fontType => `${paths.src.fonts}/**/*.${fontType}`)),
      flatten(),
      dest(paths.dist.fonts),
    ],
    cb,
  );
}

export { fonts };
