import pump from 'pump';
import { dest, src } from 'gulp';
import { paths } from '../utils/paths';
import svgCleaner from 'gulp-svgo';

const options = {
  svgCleaner: {
    plugins:
    [
      {
        removeViewBox: false,
      },
      {
        cleanupIDs: false,
      },
    ],
  },
};

function svgs(cb) {
  return pump(
    [
      src(`${paths.src.svgs}/*.svg`),
      svgCleaner(options.svgCleaner),
      dest(paths.dist.svgs),
    ],
    cb,
  );
}

export { svgs };
