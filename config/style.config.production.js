'use strict';
const conf = require('./style.config');
const merge = require('webpack-merge');
module.exports = merge(conf, {
  sourceMap: false,
  plugins: [  // postcssプラグイン
    require('postcss-csso')(),
    require('postcss-cachebuster')({
      imagesPath : `/${FRP_DEST}/assets/images`,
      cssPath : `/${FRP_DEST}/assets/css`
    })
  ]
});
