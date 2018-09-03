<?php

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
