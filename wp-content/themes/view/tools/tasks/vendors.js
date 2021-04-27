import { paths } from '../utils/paths';
import { src, dest } from 'gulp';
import { config } from '../utils/env';
import pump from 'pump';

const srcPaths = config.vendors.map(item => `node_modules/${item.path}`);

function matchSrcFile(currentPath) {
  let filename = ''
  config.vendors.forEach(vendor => {
    if (vendor.path.includes(currentPath.basename)){
      filename = `${paths.dist.base}/vendors/${vendor.name}`
    }
  })
  if (filename !== '') {
    return filename;
  }
  else {
    new Error('file not found in sources')
    process.exit(0)
  }
}

function vendors(cb) {
  return pump(
    [
      src(srcPaths),
      dest(matchSrcFile),
    ],
    cb,
  );
}

export { vendors };
