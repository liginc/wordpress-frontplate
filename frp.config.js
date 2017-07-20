'use strict';

var PACKAGE = require('./package.json');

// https://github.com/frontainer/frontplate-cli/wiki/6.%E8%A8%AD%E5%AE%9A
module.exports = function (production) {
  global.THEME_NAME   = 'Sample Theme';
  global.THEME_DOMAIN = 'sampletheme';
  global.FRP_SRC  = 'src/' + THEME_DOMAIN;
  global.FRP_DEST = 'wp/wp-content/themes/' + THEME_DOMAIN;
  return {
    clean: {
    },
    html: {
      src: `${FRP_SRC}/view/**/*.{svg,html,php,css}`,   // 読み込むビューファイル
      dest: FRP_DEST,        // 出力先
      params: {                   // ビューで使うグローバル変数
        name: THEME_NAME,
        version: PACKAGE.version,
        domain: THEME_DOMAIN
      },
      ext: null,        // 出力する際の拡張子
      // １つのテンプレートで複数作成するときに使用する
      // pages: [
      //   {
      //       name: 'style.css',    // 出力するファイル名
      //       src: `${FRP_SRC}/view/style.css`,  // テンプレート
      //     ext: '.css',
      //       params: {       // ページに渡す変数
      //           version: PACKAGE.version
      //       }
      //   }
      // ],
    },
    style: production ? {} : {},
    script: production ? {} : {},
    server: {
      proxy: 'localhost'
    },
    copy: {
      [`${FRP_SRC}/view/inc/*`]: `${FRP_DEST}/inc/`,
      [`${FRP_SRC}/view/screenshot.png`]: `${FRP_DEST}/`
    },
    sprite: [],
    test: {}
  }
};
