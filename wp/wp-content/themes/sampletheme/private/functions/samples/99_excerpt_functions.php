<?php

/**
 * 対象の記事の最初のtermを取得します.
 *
 * @param        $post_id
 * @param string $tax
 *
 * @return array
 */
function get_primary_term($post_id, $tax = 'category')
{
    $terms = get_the_terms($post_id, $tax);

    if (!empty($terms[0])) {
        return $terms[0];
    } else {
        return array();
    }
}

/**
 * 抜粋の文字数設定.
 *
 * @param unknown_type $length
 *
 * @return number
 */
function set_excerpt_mblength($length)
{
    return 59;
}

//add_filter('excerpt_mblength', 'set_excerpt_mblength');

/**
 * 抜粋の文末変更.
 *
 * @param unknown_type $more
 *
 * @return string
 */
function set_excerpt_more($more)
{
    return '...';
}

//add_filter('excerpt_more', 'set_excerpt_more');
