<?php

/**
 * 投稿一覧画面で表示タグを非表示にする（CSS）.
 */
function lig_wp_remove_indexpage_view_link()
{
    global $post_type; // 投稿タイプで変更可能。
    echo '<style type="text/css">';
    echo 'span.view {';
    echo '  display: none;';
    echo '}';
    echo '</style>';
}

//add_action('admin_print_styles-edit.php', 'lig_wp_remove_indexpage_view_link');

/**
 * カテゴリ一覧で表示リンクを非表示にする.
 */
function lig_wp_remove_category_view_link()
{
    echo '<style type="text/css">';
    echo '.view {';
    echo '  display: none;';
    echo '}';
    echo '</style>';
}

//add_action("admin_head-edit-tags.php", "lig_wp_remove_category_view_link");

/*
 * カテゴリ一覧で表示リンクを非表示にする
 */

//カテゴリ一覧ページの説明の箇所を非表示にする
if (is_admin()) {
    if ('edit-tags.php' == $pagenow) {
        function lig_wp_remove_tag_view_link()
        {
            echo '<style type="text/css">';
            echo '.form-field:nth-of-type(4){';
            echo '  display: none;';
            echo '}';
            echo '</style>';
        }
        //		add_action("admin_print_styles-edit-tags.php", "lig_wp_remove_tag_view_link");
    }
}
