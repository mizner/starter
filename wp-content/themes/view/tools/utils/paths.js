import path from 'path';

const { resolve } = path;
const root = resolve(process.env.PWD);
const theme = `${root}/wp-content/themes/look`;
const plugin = `${root}/wp-content/plugins/do`;

const src = `${root}/src`;
const dist = `${root}/dist`;

const paths = {
  src: {
    base: src,
    styles: `${src}/styles`,
    scripts: `${src}/scripts`,
    images: `${src}/images`,
    fonts: `${src}/fonts`,
    svgs: `${src}/svgs`,
    components: `${src}/components`,
    vendor: `${src}/vendor`,
  },
  dist: {
    base: dist,
    styles: `${dist}/styles`,
    scripts: `${dist}/scripts`,
    images: `${dist}/images`,
    fonts: `${dist}/fonts`,
    svgs: `${dist}/svgs`,
    components: `${dist}/components/`,
  },
};

export { paths, root, theme, plugin };
