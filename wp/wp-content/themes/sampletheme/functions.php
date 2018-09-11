<?php
/**
 * Theme version
 * style.cssで定義されているバージョン番号を定数化しておきます。
 */
define('THEME_VERSION', wp_get_theme()->get('Version'));

/*
 * functionsフォルダにあるファイルをすべて読み込む
*/
foreach (glob(TEMPLATEPATH.'/private/functions/*.php') as $file) {
    require_once $file;
}
