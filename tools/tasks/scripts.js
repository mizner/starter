import { parse } from 'path';
import { src, dest } from 'gulp';
import pump from 'pump';
import plumber from 'gulp-plumber';
import named from 'vinyl-named';
import webpack from 'webpack';
import webpackStream from 'webpack-stream';
import { webpackConfig } from '../webpack.config';
import { paths } from '../utils/paths';
import { find } from 'globule';

const srcPaths = find([
  `${paths.src.scripts}/*.js`,
  `${paths.src.views}/**/*.js`,
]);

/**
 *
 * @param file
 * @returns {string}
 * @note This is specifically to search in globbed paths to identify view modules, for some reason multiple
 *       webpack instances wasn't working. The result being something like taking 'views/blocks/hero/hero.js'
 *       and outputting to 'dist/view/hero/hero.js'
 */
function filterToIdentifyViews(currentPath) {
  const originalPath = parse(srcPaths.find(path => path.includes(currentPath.basename)));

  if (originalPath.dir.includes(paths.src.views)) {
    return originalPath.dir.replace(paths.src.views, paths.dist.views);
  } else {
    return originalPath.dir.replace(paths.src.scripts, paths.dist.scripts);
  }
}

function scripts(cb) {
  return pump(
    [
      src(srcPaths),
      plumber(),
      named(),
      webpackStream(webpackConfig, webpack),
      dest(filterToIdentifyViews),
    ],
    cb,
  );
}

export { scripts };
