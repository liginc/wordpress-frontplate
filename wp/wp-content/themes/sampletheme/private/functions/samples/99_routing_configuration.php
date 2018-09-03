<?php

/**
 * 後方一致リダイレクトを切る
 *
 * @memo WPは404だった場合、URLが後方一致で一致するページにリダイレクトする
 */
//add_filter('redirect_canonical', 'lig_wp_remove_redirect_guess_404_permalink', 10, 2);
function lig_wp_remove_redirect_guess_404_permalink( $redirect_url, $requested_url ) {
  if ( is_404() ) {
    return false;
  }

  return $redirect_url;
}
