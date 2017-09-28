'use strict';
const packageJSON = require('./package.json');

// https://github.com/frontainer/frontplate-cli/wiki/6.%E8%A8%AD%E5%AE%9A
module.exports = function (production) {
  global.THEME_NAME   = 'Sample Theme';
  global.THEME_DOMAIN = 'sampletheme';
  global.FRP_SRC  = `src/${THEME_DOMAIN}`;
  global.FRP_DEST = `wp/wp-content/themes/${THEME_DOMAIN}`;
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
    test: {},
    // theme直下のstyle.cssの自動生成タスクへ渡すパラメータ
    wp: {
      dest: FRP_DEST,
      params: {
        name: THEME_NAME,
        version: packageJSON.version,
        domain: THEME_DOMAIN
      }
    }
  }
};
