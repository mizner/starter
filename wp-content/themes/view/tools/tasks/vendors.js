import { theme } from '../utils/paths';
import { src, dest } from 'gulp';
import { config } from '../utils/env';
import pump from 'pump';

function vendors(cb) {
  return pump(
    [
      src(config.vendors.map(item => `node_modules/${item}`)),
      dest(`${theme}/dist/vendors`),
    ],
    cb,
  );
}

export { vendors };
