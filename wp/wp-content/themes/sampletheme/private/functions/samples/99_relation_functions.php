<?php

global $my_where; //get_related_data関数で期間指定する時に使うグローバル変数
/**
 * 関連記事を取得する
 * get_postsをラップした関数です。
 * 第一引数にget_postsの引数を設定することでカテゴリ指定やタグ指定ができます。
 * 第二引数でランダム処理にするか指定できます。
 * 第三引数で記事の公開期間指定ができます。こちらはstrtotimeのフォーマットに準じています。
 *
 * @param unknown_type $arg    get_postsの引数
 * @param unknown_type $random shuffleでランダム処理にするか設定
 */
function get_related_data($arg = array(), $random = false, $date_check = null)
{
    global $my_where;
    $showposts = -1;
    //記事の期間指定
    if (!is_null($date_check)) {
        $my_where = " AND post_date >= '".date('Y-m-d', strtotime($date_check))."'";
        add_filter('posts_where', 'related_filter_where');
    }
    if (empty($arg)) {
        $arg = array('post_type' => 'post', 'showposts' => -1, 'post_status' => 'publish', 'suppress_filters' => false);
    } else {
        if ($random) {
            $showposts = $arg['showposts'];
            $arg['showposts'] = -1;
        } else {
            $showposts = $arg['showposts'];
        }
    }
    $datas = get_posts($arg);
    remove_filter('posts_where', 'related_filter_where');
    //0件時
    if (empty($datas)) {
        return null;
    }
    if ($random) {
        shuffle($datas);
        $relateddata = $datas;
        $datas = array();
        //件数はshowpostsで取る。指定なしは取得件数分にする。
        $limit = -1 == $showposts ? count($relateddata) : $showposts;
        $i = 1;
        foreach ($relateddata as $key => $value) {
            if ($i > $limit) {
                break;
            }
            $datas[] = $value;
            ++$i;
        }
    }

    return $datas;
}

/**
 * get_related_data関数で期間指定する時に使うフィルター関数.
 *
 * @global type $my_where
 *
 * @param type $where
 *
 * @return type
 */
function related_filter_where($where)
{
    global $my_where;

    return $where.$my_where;
}
