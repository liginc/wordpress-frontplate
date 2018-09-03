<?php
/**
 *  メインクエリーとかクエリー系処理を記載します。
 */

function change_posts_per_page( $query ) {
  //管理画面のメインクエリーとメインクエリーじゃないときは処理しない
  if ( is_admin() || ! $query->is_main_query() ) {
    return;
  }


  //ホーム画面のメインクエリー処理
  if ( $query->is_home() ) {
    $query->set( 'posts_per_page', '10' );//件数変更
    //$query->set( 'category_name', 'topics' );//カテゴリ指定
    $query->set( 'orderby', 'post_date' );//ソート指定
    $query->set( 'order', 'DESC' );//ソート順番
    $query->set( 'post_status', 'publish' );//公開状態
  }
  //カテゴリ一覧画面のメインクエリー処理
  if ( $query->is_category() ) {
    $query->set( 'posts_per_page', '10' );//件数変更
    $query->set( 'orderby', 'post_date' );//ソート指定
    $query->set( 'order', 'DESC' );//ソート順番
    $query->set( 'post_status', 'publish' );//公開状態
  }
  //検索結果一覧画面のメインクエリー処理
  if ( $query->is_search() ) {
    $query->set( 'posts_per_page', '10' );//件数変更
    $query->set( 'orderby', 'post_date' );//ソート指定
    $query->set( 'order', 'DESC' );//ソート順番
    $query->set( 'post_status', 'publish' );//公開状態
  }
  //カスタム投稿タイプ一覧画面のメインクエリー処理（カスタム投稿タイプ名は自分で直して下さい）
//	if(!empty($query->query_vars["post_type"]) && $query->query_vars["post_type"] == "sample"){
//		$query->set( 'posts_per_page', '10' );//件数変更
//		$query->set( 'orderby', 'post_date' );//ソート指定
//		$query->set( 'order', 'DESC' );//ソート順番
//		$query->set( 'post_status', 'publish' );//公開状態
//	}

}
// add_action( 'pre_get_posts', 'change_posts_per_page' );
