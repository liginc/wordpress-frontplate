<?php
/**
 * ここはパーマリンク設定、リライトルールを変更する処理を記載するファイルです。
 */
add_action('init', 'lig_add_post_type_rules');

function lig_add_post_type_rules()
{
    //ここからカスタム投稿タイプのパーマリンクをカスタマイズする処理を記載します。
    // add_action('init', 'myposttype_rewrite');
    /**
     * リライトルール設定
     * カスタム投稿の数だけ書き込む
     */
    function myposttype_rewrite()
    {
        global $wp_rewrite;
        //サンプル　カスタム投稿タイプ　columnのリライトルール
        $queryarg = 'post_type=column&p='; //post_type=にカスタム投稿名を記載する
        $wp_rewrite->add_rewrite_tag('%column_id%', '([^/]+)', $queryarg); //第一引数にカスタム投稿名を記載する
        //第一引数にカスタム投稿名を記載する　第二引数は設定したいURL構成を記載。例ではmyposttype_permalinkで定義している「カスタム投稿名_id」で指定の投稿タイプ記事IDを指定しています。
        $wp_rewrite->add_permastruct('column', '/column/%column_id%', false);

        /*
         * 以降、上記サンプルのようにカスタム投稿タイプ毎に設定をしていく
         * $queryarg = 'post_type=blog&p=';
         * $wp_rewrite->add_rewrite_tag('%blog_id%', '([^/]+)',$queryarg);
         * $wp_rewrite->add_permastruct('blog', '/blog/%blog_id%', false);
         **/
    }

    // add_filter('post_type_link', 'myposttype_permalink', 1, 3);

    /**
     * カスタム投稿タイプのパーマリンク構造を変更する。
     *
     * @param unknown_type $post_link
     * @param unknown_type $id
     * @param unknown_type $leavename
     *
     * @return unknown
     */
    function myposttype_permalink($post_link, $id = 0, $leavename)
    {
        global $wp_rewrite;
        $post = &get_post($id);
        if (is_wp_error($post)) {
            return $post;
        }
        $newlink = $wp_rewrite->get_extra_permastruct($post->post_type);
        $newlink = str_replace('%'.$post->post_type.'_id%', $post->ID, $newlink);
        $newlink = home_url(user_trailingslashit($newlink));

        return $newlink;
    }

    //ここまでカスタム投稿タイプのパーマリンクをカスタマイズする処理を記載します。
}
