import del from 'del';
import { paths } from '../utils/paths';

export function clean() {
  return Promise.all(
    [
      del(
        [
          `./dist/**/*`,
        ],
        {
          force: true,
        },
      ),
    ],
  );
}
