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
  `${paths.src.components}/organisms/*.js`,
  `${paths.src.components}/templates/*.js`,
  `${paths.src.components}/pages/*.js`,
  `${paths.src.components}/*.js`,
], {
  allowEmpty: true,
});

function matchSrcFile(currentPath) {
  const originalPath = parse(srcPaths.find(path => path.includes(currentPath.basename)));

  if (srcPaths.includes(`${originalPath.dir}/${originalPath.base}`)) {
    return originalPath.dir.replace('/src/', '/dist/')
  }
  else {
    new Error('file not found in sources')
    process.exit(0)
  }
}

function scripts(cb) {
  return pump(
    [
      src(srcPaths),
      plumber(),
      named(),
      webpackStream(webpackConfig, webpack),
      dest(matchSrcFile),
    ],
    cb,
  );
}

export { scripts };
