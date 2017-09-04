<?php

//■■■■■■■■■■■■■■■投稿画面カスタマイズ START■■■■■■■■■■■■■■■
/**
 * アイキャッチの説明を追加する場合に利用します。
 *
 * @param  string $content
 *
 * @return string
 */
function lig_wp_add_featured_image_instruction( $content ) {
  global $post_type; // 投稿タイプで変更可能。
  $content .= '<p>';
  $content .= 'アイキャッチ画像として画像を追加するとサムネイルが表示されるようになります。<br />';
  $content .= 'サイズは横300px、縦200pxになるようにしてください。';
  $content .= '</p>';

  return $content;
}

//add_filter( 'admin_post_thumbnail_html', 'lig_wp_add_featured_image_instruction');

/**
 * タイトルのプレースホルダーを変更する場合に利用します。
 *
 * @param  string $title
 *
 * @return string
 */
function lig_wp_change_title_placeholder( $title ) {
  global $post_type; // 投稿タイプで変更可能。

  return $title = 'ここに記事の題名を書きます';
}

//add_filter( 'enter_title_here', 'lig_wp_change_title_placeholder' );

/**
 * 投稿フォームで不要な項目を除外する場合に利用します。
 *
 * @memo 'post'には投稿タイプを指定する
 */
function lig_wp_remove_default_screen_metaboxes() {
  remove_meta_box( 'postcustom', 'post', 'normal' ); // カスタムフィールド
  remove_meta_box( 'postexcerpt', 'post', 'normal' ); // 抜粋
  remove_meta_box( 'commentstatusdiv', 'post', 'normal' ); // コメント
  remove_meta_box( 'trackbacksdiv', 'post', 'normal' ); // トラックバック
  remove_meta_box( 'slugdiv', 'post', 'normal' ); // スラッグ
  remove_meta_box( 'authordiv', 'post', 'normal' ); // 著者
}

//add_action( 'admin_menu','lig_wp_remove_default_screen_metaboxes' );

/**
 * iframeとiframeで使える属性を指定する
 *
 * @global array $allowedposttags
 *
 * @param type   $content
 *
 * @return type
 */
function lig_wp_allow_iframe_tag( $content ) {
  global $allowedposttags;

  // iframeとiframeで使える属性を指定する
  $allowedposttags['iframe'] = array(
    'class'        => array(),
    'src'          => array(),
    'width'        => array(),
    'height'       => array(),
    'frameborder'  => array(),
    'scrolling'    => array(),
    'marginheight' => array(),
    'marginwidth'  => array()
  );

  return $content;
}

//add_filter('content_save_pre','lig_wp_allow_iframe_tag');

/**
 * 投稿画面のプレビューボタンを非表示にする
 *
 * @global type $post_type
 */
function lig_wp_remove_previewbutton_css_custom() {
  global $post_type; // 投稿タイプで変更可能。
  echo '<style>#preview-action {display: none;}</style>';
}

//add_action('admin_print_styles', 'lig_wp_remove_previewbutton_css_custom');

/**
 * 投稿画面のパーマリンクを非表示にする
 *
 * @global type $post_type
 */
function lig_wp_remove_permlink_css_custom() {
  global $post_type; // 投稿タイプで変更可能。
  echo '<style>#edit-slug-box,#view-post-btn {display: none;}</style>';
}

//add_action('admin_print_styles', 'lig_wp_remove_permlink_css_custom');

/**
 * タイトルが入力されていない場合、alertを出します
 */
//add_action( 'admin_head-post-new.php', 'lig_wp_alert_empty_title' );
function lig_wp_alert_empty_title() {
  ?>
  <script type="text/javascript">
    jQuery(document).ready(function ($) {
      var post_type = $('#post_type').val();
      if ('blog' == post_type || 'page' == post_type || 'member' == post_type || 'works' == post_type) {
        $("#post").submit(function (e) {
          if ('' == $('#title').val()) {
            alert('タイトルを入力してください。');
            $('#ajax-loading').css('visibility', 'hidden');
            $('#publish').removeClass('button-primary-disabled');
            $('#publishing-action .spinner').hide();
            $('#title').focus();
            return false;
          }
        });
      }
    });
  </script>
  <?php
}

/**
 * カテゴリが入力されていない場合、alertを出します
 */
if ( ! has_action( 'admin_footer', 'alert_category' ) ) {
//	add_action( 'admin_footer' , 'lig_wp_alert_unselected_category' );
}
function lig_wp_alert_unselected_category() {
  echo <<< EOF
<script type="text/javascript">

	jQuery("#post").attr("onsubmit", "return check_category();");

	function check_category(){
		var post_type = jQuery('#post_type').val() ,
			categoryDiv,
			categoryList;
		if(post_type == "blog") {
			categoryList = jQuery("#genrechecklist");
			categoryDiv = jQuery("#genrediv");
		} else if( post_type == "works") {
			categoryList = jQuery("#works_categorychecklist");
			categoryDiv = jQuery("#works_categorydiv");
		} else {
			return true;
		}

		if(categoryList.length) {
			var check_num = categoryList.find("input:checked").length;
			if(check_num <= 0){
				alert(categoryDiv.find("span").html() + "を選択してください。");
				jQuery("#ajax-loading").css("visibility","hidden");
				jQuery("#publish").removeClass("button-primary-disabled");
				return false;
			} else {
				return true;
			}
		}
	}

</script>';
EOF;
}

// タクソノミーを1つしか選べないようにする
if ( ! has_action( 'admin_print_footer_scripts', 'lig_wp_change_select_tax_to_radio' ) ) {
//	add_action( 'admin_print_footer_scripts' , 'lig_wp_change_select_tax_to_radio' );
}

function lig_wp_change_select_tax_to_radio() {
  ?>
  <script type="text/javascript">
    jQuery(function ($) {
      var tax_name = "";
      var post_type = jQuery('#post_type').val();

      if (post_type == "blog") {
        tax_name = "genre";
      } else if (post_type == "works") {
        tax_name = "works";
      } else {
        return;
      }

      // 投稿画面
      $('#taxonomy-' + tax_name + ' input[type=checkbox]').each(function () {
        $(this).replaceWith($(this).clone().attr('type', 'radio'));
      });

      // 一覧画面
      var hoge_taxonomy_checklist = $('.' + tax_name + '_taxonomy-checklist input[type=checkbox]');
      hoge_taxonomy_checklist.click(function () {
        $(this).parents('.' + tax_name + '-checklist').find(' input[type=checkbox]').attr('checked', false);
        $(this).attr('checked', true);
      });
    });
  </script>
  <?php
}

// メディアから画像いれたときのうっとおしいリンクを削除
//add_filter( 'media_send_to_editor', 'lig_wp_delete_link_inserting_media', 999, 3 );
function lig_wp_delete_link_inserting_media( $html ) {
  return preg_replace( '/<a .*?>(.*?)<\/a>/', '$1', $html );
}

//■■■■■■■■■■■■■■■投稿画面カスタマイズ END■■■■■■■■■■■■■■■

//■■■■■■■■■■■■■■■管理画面外観カスタマイズ START■■■■■■■■■■■■■■■

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

//■■■■■■■■■■■■■■■管理画面外観カスタマイズ END■■■■■■■■■■■■■■■


//■■■■■■■■■■■■■■■投稿一覧、カテゴリ一覧カスタマイズ START■■■■■■■■■■■■■■■

/**
 * 投稿一覧画面で表示タグを非表示にする（CSS）
 */
function lig_wp_remove_indexpage_view_link() {
  global $post_type; // 投稿タイプで変更可能。
  echo '<style type="text/css">';
  echo 'span.view {';
  echo '  display: none;';
  echo '}';
  echo '</style>';
}

//add_action('admin_print_styles-edit.php', 'lig_wp_remove_indexpage_view_link');

/**
 * カテゴリ一覧で表示リンクを非表示にする
 */
function lig_wp_remove_category_view_link() {
  echo '<style type="text/css">';
  echo '.view {';
  echo '  display: none;';
  echo '}';
  echo '</style>';
}

//add_action("admin_head-edit-tags.php", "lig_wp_remove_category_view_link");

/**
 * カテゴリ一覧で表示リンクを非表示にする
 */

//カテゴリ一覧ページの説明の箇所を非表示にする
if ( is_admin() ) {
  if ( $pagenow == "edit-tags.php" ) {
    function lig_wp_remove_tag_view_link() {
      echo '<style type="text/css">';
      echo '.form-field:nth-of-type(4){';
      echo '  display: none;';
      echo '}';
      echo '</style>';

    }
//		add_action("admin_print_styles-edit-tags.php", "lig_wp_remove_tag_view_link");
  }
}

//■■■■■■■■■■■■■■■投稿一覧、カテゴリ一覧カスタマイズ END■■■■■■■■■■■■■■■
