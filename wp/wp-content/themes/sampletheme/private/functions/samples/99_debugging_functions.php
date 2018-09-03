<?php

/**
 * print_rを整形
 *
 * @param type $vars
 */
function pr( $vars ) {
  if ( WP_DEBUG ) {
    echo '<pre>';
    print_r( $vars );
    echo '</pre>';
  }
}
