<?php

/**
 * アセットディレクトリ配下の指定された $subpath の完全URLを生成します
 *
 * @param string $subpath
 * @return string
 */
function resolve_asset_url( $subpath = '' ) {
  return esc_url( add_anticache( rtrim( get_template_directory_uri(), '/' ) . '/assets/' . ltrim( $subpath, '/' ) ) );
}

/**
 * 指定された $path の完全URLを生成します
 *
 * @param string $path
 * @return string
 */
function resolve_url( $path = '' ) {
  return esc_url( get_home_url( null, $path ) );
}

/**
 * 特定の $post_type のアーカイブページURLを取得します。
 *
 * @param $post_type
 * @return string
 */
function resolve_archive_url( $post_type ) {
  if ( false === $url = get_post_type_archive_link( $post_type ) ) {
    throw new BadMethodCallException( "Unsupported/unarchivable post_type [$post_type]" );
  }

  return $url;
}
