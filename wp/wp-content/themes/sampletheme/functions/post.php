<?php
/**
 *  投稿タイプ：投稿で使用する処理を記載します。
 */

/**
 * アイキャッチを取得、なければノーイメージを返す
 *
 * @return string
 */
function get_eyecatch_data( $post_id, $thumbnail = "full", $noimage = false ) {
  if ( has_post_thumbnail( $post_id ) ) {
    $image_data = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $thumbnail, true );

    return $image_data[0];
  } elseif ( empty( $noimage ) ) {
    return false;
  } else {
    return $noimage;
  }
}

/**
 * カスタムフィールドの画像を取得、なければノーイメージを返す
 *
 * @return string
 */
function get_thumbnail_data( $image_id, $thumbnail = "full", $noimage = false ) {
  if ( ! empty( $image_id ) ) {
    $image_data = wp_get_attachment_image_src( $image_id, $thumbnail, true );

    return $image_data[0];
  } elseif ( empty( $noimage ) ) {
    return false;
  } else {
    return $noimage;
  }
}
