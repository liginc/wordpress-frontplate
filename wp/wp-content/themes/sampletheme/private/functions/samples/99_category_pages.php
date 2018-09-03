<?php
/**
 *  カテゴリの操作に関する処理.
 */

/**
 * 全親カテゴリのみ取得.
 *
 * @param string $category
 *
 * @return array
 */
function get_parent_categories($category = 'category')
{
    $parent_categories = array();
    $parent_datas = get_terms(
        $category,
        array(
            'fields' => 'all',
            'get' => 'all',
            'parent' => 0,
        )
    );
    if (!empty($parent_datas)) {
        foreach ($parent_datas as $key => $val) {
            $parent_categories[$val->term_id] = $val;
        }
    }

    return $parent_categories;
}

/**
 * アーカイブのURLから「category」や「taxonomy名」を削除.
 *
 * @param $link
 *
 * @return mixed
 */
function remcat_function($link, $term = null, $taxonomy = 'category')
{
    return str_replace('/'.$taxonomy.'/', '/', $link);
}

// categoryを消す場合はこちら有効
//add_filter('user_trailingslashit', 'remcat_function');

// カスタム投稿のパーマリンクの「/taxonomy/」を削除する場合は下記有効に
//add_filter('term_link', 'remcat_function',11,3);

// rewriteルールに追加
function remcat_rewrite($wp_rewrite)
{
    $new_rules = array(
        // postのcategoryを削除したURLを適用
        '(.+)/page/(.+)/?' => 'index.php?category_name='.$wp_rewrite->preg_index(1).'&paged='.$wp_rewrite->preg_index(2),
        // カスタムタクソノミのURL調整した場合は下記を記載
        // 例：posttype:pertnerのカスタムタクソノミpartner_categoryを削除した場合は下記
        // 'partner/([^/]+)?$' => 'index.php?partner_category=' . $wp_rewrite->preg_index(1),
        // 'partner/([^/]+)/page/([0-9]+)/?$' => 'index.php?partner_category=' .$wp_rewrite->preg_index(1) . '&paged='.$wp_rewrite->preg_index(2),
    );
    $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}

//add_filter('generate_rewrite_rules', 'remcat_rewrite');

// rewriteルール適用
function remcat_flush_rules()
{
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
}
//add_action('init', 'remcat_flush_rules');
