<?php
/**
 *  archiveページで使用する処理を記載します。
 */

/**
 * 記事一覧の情報を取得し、記事一覧ワード、説明文（あれば）を返す.
 *
 * @return array
 */
function get_archive_list_data()
{
    $archive_data = array();
    if (is_search()) {
        if (get_search_query()) {
            $archive_data['title'] = '「'.get_search_query().'」の検索結果一覧';
        } else {
            $archive_data['title'] = '検索結果一覧';
        }
        $archive_data['description'] = null;
    } elseif (is_category() || is_tax() || is_tag()) {
        $cat = get_queried_object();
        $archive_data['title'] = $cat->name;
        $archive_data['description'] = $cat->description;
    }

    return $archive_data;
}
