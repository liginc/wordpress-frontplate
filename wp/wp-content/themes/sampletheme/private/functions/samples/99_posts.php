<?php

//add_image_size( 'hoge-thumbnail', 200, 200, false );	// アイキャッチサイズ指定

/**
 * 投稿が指定期間以内かチェックする
 *
 * @param type $post_id 記事ID
 * @param type $time    期間指定　strtotimeのフォーマットを指定
 *
 * @return boolean
 */
function is_newpost( $post_id = null, $time = NEW_POST_TIME ) {
  $dt = new DateTime();
  $dt->setTimeZone( new DateTimeZone( 'Asia/Tokyo' ) );
  $today     = get_post_time( 'Y-m-d', false, $post_id );
  $limit_day = date( "Y-m-d", strtotime( $time ) );
  if ( strtotime( $today ) >= strtotime( $limit_day ) ) :
    return true;
  endif;

  return false;
}


/**
 * ファイル保存しているカスタムフィールドからファイルリンクを取得する
 *
 * @param unknown_type $postid 記事ID
 * @param unknown_type $key    ファイルを保持しているカスタムフィールドキー
 */
function get_customfield_filelink( $postid, $key ) {
  $files = get_post_meta( $postid, $key, false );
  foreach ( $files as $file ):
    $file = wp_get_attachment_url( $file );

    return $file;
  endforeach;
}
