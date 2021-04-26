import path from 'path';

const
  { resolve } = path,
  root = resolve(process.env.PWD),
  src = `${root}/src`,
  dist = `${root}/dist`,
  paths = {
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

export {
  paths,
  root
};
