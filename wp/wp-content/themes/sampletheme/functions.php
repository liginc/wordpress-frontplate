<?php
/**
 * Theme version
 * style.cssで定義されているバージョン番号を定数化しておきます。
 */
define( 'THEME_VERSION', wp_get_theme()->get( 'Version' ) );

/**
 * 読み込む順番を保証する必要があるファイルは直接インクルードするようにしてください。
 */
require_once( get_template_directory() . '/inc/define.php' );

/*
 * functionsフォルダにあるファイルをすべて読み込む
*/
foreach ( glob( TEMPLATEPATH . "/functions/*.php" ) as $file ) {
  require_once $file;
}
