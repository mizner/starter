import { create } from 'browser-sync';
import { config } from '../utils/env';
import { root } from '../utils/paths';

const { port, proxy, online, ui } = config.watch;
const server = create();

function serve(done) {
  server.init({
    proxy: proxy,
    port: port,
    ui: ui,
    online: online, // "offline" reduces start-up time
    root: root,
    open: {
      file: `${root}/index.php`,
    },
    notify: {
      styles: {
        top: 'auto',
        bottom: '0',
        left: '0',
        right: 'auto',
      },
    },
  });
  done();
}

function reload(done) {
  server.reload();
  done();
}

function quit() {
  console.log('WARNING: build tools modified, killing watch processes');
  process.exit();
}

export { serve, reload, quit, server };
