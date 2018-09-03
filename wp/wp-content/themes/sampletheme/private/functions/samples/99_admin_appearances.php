<?php

/**
 * 不要なメニューを削除する場合に利用します。
 */
function lig_wp_remove_menus() {
  remove_menu_page( 'edit.php' );
  remove_menu_page( 'upload.php' );
  remove_menu_page( 'link-manager.php' );
  remove_menu_page( 'edit-comments.php' );
  remove_menu_page( 'tools.php' );
  remove_submenu_page( 'index.php', 'update-core.php' ); // 本体更新ページ
  remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' );
}

if ( ! is_super_admin() ) { // ※管理者以外のログイン時にフックする場合。
//	add_action( 'admin_menu', 'lig_wp_remove_menus' );
}

/**
 * ログイン画面のスタイルシートを変更する場合に利用します。
 */
function lig_wp_change_admin_css() {
  echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo( 'template_directory' ) . '/css/custom-login-page.css" />';
}

//add_action( 'login_head', 'lig_wp_change_css_admin' );

/**
 * 管理画面のフッターを変更する場合に利用します。
 */
function lig_wp_custom_admin_footer() {
  echo ' <a href="http://liginc.co.jp">株式会社LIG</a>';
}

//add_filter( 'admin_footer_text', 'lig_wp_custom_admin_footer' );

/**
 * ログインメッセージを変更する場合に利用します。
 *
 * @param  object $wp_admin_bar
 */
function lig_wp_replace_hello_text( $wp_admin_bar ) {
  $my_account = $wp_admin_bar->get_node( 'my-account' );
  $newtitle   = str_replace( 'こんにちは、', 'お疲れさまです！', $my_account->title );
  $wp_admin_bar->add_menu( array(
    'id'    => 'my-account',
    'title' => $newtitle,
    'meta'  => false
  ) );
}

//add_filter( 'admin_bar_menu', 'lig_wp_replace_hello_text', 25 );

/**
 * WordPressSEOプラグインのメニュー非表示
 */
function lig_wp_remove_wordpress_seo_menu() {
  echo '<style type="text/css">';
  echo '#toplevel_page_wpseo_dashboard,#wp-admin-bar-view,#wp-admin-bar-wpseo-menu {';
  echo '  display: none;';
  echo '}';
  echo '</style>';
}

//add_action( 'admin_head', 'lig_wp_remove_wordpress_seo_menu', 100);

/**
 * adminbarを表示させない
 *
 * @memo adminbarを表示させるとスタイルが崩れることがある
 */
//add_filter( 'show_admin_bar' , 'lig_wp_hide_admin_bar');
function lig_wp_hide_admin_bar() {
  return false;
}
