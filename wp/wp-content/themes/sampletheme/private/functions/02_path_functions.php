<?php

function resolve_asset_uri( $subpath = '' ) {
  return esc_url( add_anticache( rtrim( get_template_directory_uri(), '/' ) . '/assets/' . ltrim( $subpath, '/' ) ) );
}

function resolve_url( $path = '' ) {
  return esc_url( get_home_url( null, $path ) );
}

function resolve_archive_uri( $post_type ) {
  if ( false === $url = get_post_type_archive_link( $post_type ) ) {
    throw new BadMethodCallException( "Unsupported/unarchivable post_type [$post_type]" );
  }

  return $url;
}
