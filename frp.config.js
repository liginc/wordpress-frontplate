'use strict';

var PACKAGE = require('./package.json');

// https://github.com/frontainer/frontplate-cli/wiki/6.%E8%A8%AD%E5%AE%9A
module.exports = function (production) {
  global.FRP_SRC  = 'src';
  global.FRP_DEST = 'wp/wp-content/themes/sampletheme';
  return {
    clean: {
      src: `${FRP_DEST}/assets`
    },
    style: production ? {} : {},
    script: production ? {} : {},
    server: {
      proxy: 'localhost'
    },
    copy: {},
    sprite: [],
    test: {}
  }
};
