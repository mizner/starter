
import pump from 'pump'
import { dest, src } from 'gulp'
import { paths } from '../utils/paths'
import jlto from 'gulp-jlto' // https://www.npmjs.com/package/jlto

function templates(cb) {
  return pump(
    [
      src(`${paths.src.components}/**/*.twig`),
      jlto({
        minifyHtml: true
      }),
      dest(paths.dist.components),
    ],
    cb,
  )
}

export { templates }
