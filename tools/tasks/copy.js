import pump from 'pump';
import { dest, src } from 'gulp';
import { paths, theme } from '../utils/paths';

function copy(cb) {
  return pump(
    [
      src(`${paths.src.base}/**/*`),
      dest(`${theme}/src`),
    ],
    cb,
  );
}

export { copy };
