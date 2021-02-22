import del from 'del';
import { theme } from '../utils/paths';

export function clean() {
  return Promise.all(
    [
      del(
        [
          `${theme}/dist/**/*`,
        ],
        {
          force: true,
        },
      ),
    ],
  );
}
