<?php

/**
 * get_template_part の変わりに利用してください。
 * $args をローカルスコープにて渡すことが可能です。
 *
 * @param       $tpl
 * @param array $vars
 */
function import_template( $tpl, $vars = array() ) {
  $tpl  = ltrim( $tpl, '/' ) . '.php';
  $path = locate_template( array( $tpl ) );
  if ( empty( $path ) ) {
    throw new LogicException( "Cannot locate the template '$tpl'." );
  }
  extract( $vars );
  include $path;
}

// 後方互換性のための代理名
function importTemplate( $tpl, $vars = array() ) {
  trigger_error('The function importTemplate was renamed to import_template.', E_USER_DEPRECATED);
  return call_user_func_array('import_template', func_get_args());
}


/**
 * parts/ 以下のテンプレートを読み込むのに利用してください。
 * $args をローカルスコープにて渡すことが可能です。
 *
 * @param       $tpl
 * @param array $vars
 */
function import_part( $tpl, $vars = array() ) {
  import_template( 'parts/' . ltrim( $tpl, '/' ), $vars );
}

// 後方互換性のための代理名
function importPart( $tpl, $vars = array() ) {
  trigger_error('The function importPart was renamed to import_part.', E_USER_DEPRECATED);
  return call_user_func_array('import_part', func_get_args());
}
