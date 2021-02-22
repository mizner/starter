
import pump from 'pump';
import { dest, src } from 'gulp';
import { paths } from '../utils/paths';

function templates(cb) {
  return pump(
    [
      src(`${paths.src.components}/**/*.twig`),
      dest(paths.dist.components),
    ],
    cb,
  );
}

export { templates };
