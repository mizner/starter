import { mode } from './utils/env';

// const extension = mode === 'production' ? '.min.js' : '.js'; // not using for now

const webpackConfig = {
  mode: mode,
  devtool: 'production' === mode ? 'none' : 'inline-source-map',
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
        },
      },
      {
        test: /\.svg$/,
        loader: 'svg-inline-loader',
      },
      {
        test: /\.twig$/,
        loader: 'twig-loader',
        options: {
          // See options section below
        },
      },
    ],
  },
  output: {
    filename: '[name].js',
  },
  node: {
    fs: 'empty', // avoids error messages
  },
};

export { webpackConfig };
