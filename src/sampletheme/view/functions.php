<?php
/**
 * Theme version
 */
define( 'THEME_VERSION', '<%= version %>' );

require_once( get_template_directory() . '/inc/define.php' );

/*
 * functionsフォルダにあるファイルをすべて読み込む
*/
foreach ( glob( TEMPLATEPATH . "/functions/*.php" ) as $file ) {
  require_once $file;
}
