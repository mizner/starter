import { paths } from '../utils/paths';

const { spawn } = require('child_process');

function phpcs(cb) {
  return spawn(`${paths.src.vendor}/squizlabs/php_codesniffer/bin/phpcs`, [], { stdio: 'inherit' })
    .on('close', cb)
    .on('exit', () => cb())
    .on('error', err => {
      console.error(err);
      process.exit(err);
    });
}

function phpcbf(cb) {
  return spawn(`${paths.src.vendor}/squizlabs/php_codesniffer/bin/phpcbf`, [], { stdio: 'inherit' })
    .on('close', cb)
    .on('exit', () => cb())
    .on('error', err => {
      console.error(err);
      process.exit(err);
    });
}

export { phpcs, phpcbf };
