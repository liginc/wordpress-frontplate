<?php

/**
 * get_template_part の変わりに利用してください。
 * $args をローカルスコープにて渡すことが可能です。
 *
 * @param       $tpl
 * @param array $vars
 */
function resolve_asset_url( $subpath = '' ) {
  return esc_url( add_anticache( rtrim( get_template_directory_uri(), '/' ) . '/assets/' . ltrim( $subpath, '/' ) ) );
}

/**
 * get_template_part の変わりに利用してください。
 * $args をローカルスコープにて渡すことが可能です。
 *
 * @param       $tpl
 * @param array $vars
 */
function resolve_url( $path = '' ) {
  return esc_url( get_home_url( null, $path ) );
}

/**
 * 特定の $post_type のアーカイブページURLを取得します。
 *
 * @param       $post_type
 * @param array $vars
 */
function resolve_archive_url( $post_type ) {
  if ( false === $url = get_post_type_archive_link( $post_type ) ) {
    throw new BadMethodCallException( "Unsupported/unarchivable post_type [$post_type]" );
  }

  return $url;
}
