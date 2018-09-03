<?php

/**
 * ヘッダーにWPのバージョンを表示させない
 */

remove_action('wp_head', 'wp_generator');

/**
 * WPの自動更新をしない
 */
//define('AUTOMATIC_UPDATER_DISABLED', true);
