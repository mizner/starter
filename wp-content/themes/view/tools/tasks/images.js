import pump from 'pump';
import { dest, src } from 'gulp';
import { paths } from '../utils/paths';
import flatten from 'gulp-flatten';

const types = ['png', 'jpg'];

function images(cb) {
  return pump(
    [
      src(types.map(type => `${paths.src.images}/**/*.${type}`)),
      flatten(),
      dest(paths.dist.images),
    ],
    cb,
  );
}

export { images };
