<?php
/**
 *  投稿タイプ：固定ページで使用する処理を記載します。
 */

/**
 * 指定のスラッグがURIに含まれているか確認する。
 * 主に静的ページのチェックに使ってください。
 *
 * @param unknown_type $slug
 *
 * @return bool
 */
function is_static_page($slug = '')
{
    if (strstr($_SERVER['REQUEST_URI'], $slug)):
    return true;
    endif;

    return false;
}
