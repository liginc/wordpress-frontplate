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
