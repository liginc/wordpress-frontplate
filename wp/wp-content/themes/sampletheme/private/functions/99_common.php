<?php
/**
 * WordPress全体で共通して使用する処理を記載します。
 */

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


/**
 * 抜粋の文字数設定
 *
 * @param unknown_type $length
 *
 * @return number
 */
function set_excerpt_mblength( $length ) {
  return 59;
}

//add_filter('excerpt_mblength', 'set_excerpt_mblength');

/**
 * 抜粋の文末変更
 *
 * @param unknown_type $more
 *
 * @return string
 */
function set_excerpt_more( $more ) {
  return '...';
}

//add_filter('excerpt_more', 'set_excerpt_more');

/**
 * 指定のスラッグがURIに含まれているか確認する。
 * 主に静的ページのチェックに使ってください。
 *
 * @param unknown_type $slug
 *
 * @return boolean
 */
function is_static_page( $slug = '' ) {
  if ( strstr( $_SERVER["REQUEST_URI"], $slug ) ):
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
 * エンコード
 *
 * @param unknown_type $str
 */
function xss( $str = null ) {
  return htmlentities( $str, ENT_QUOTES, "UTF-8" );
}

/**
 * get_template_part の変わりに利用してください。
 * $argsをローカルスコープにて渡すことが可能です。
 *
 * @param       $tpl
 * @param array $vars
 */
function importTemplate( $tpl, $vars = array() ) {
  $tpl  = ltrim( $tpl, '/' ) . '.php';
  $path = locate_template( array( $tpl ) );
  if ( empty( $path ) ) {
    throw new LogicException( "Cannot locate the template '$tpl'." );
  }
  extract( $vars );
  include $path;
}

function importPart( $tpl, $vars = array() ) {
  importTemplate( 'parts/' . ltrim( $tpl, '/' ), $vars );
}


/**
 * 対象の記事の最初のtermを取得します
 *
 * @param        $post_id
 * @param string $tax
 *
 * @return array
 */
function get_primary_term( $post_id, $tax = "category" ) {

  $terms = get_the_terms( $post_id, $tax );

  if ( ! empty( $terms[0] ) ) {
    return $terms[0];
  } else {
    return array();
  }
}

/**
 * 静的ファイルのキャッシュ対策としてファイルにクエリパラメータを追記して返します
 *
 * @param [string] $file
 * @return string
 */
function add_anticache( $file ) {
  // anticache.jsonがある場合
  if('' !== (string) ANTICACHE_HASH){
    // svg fragment identifierの可能性を考慮
    $parts = explode('#', $file);
    $fragment = '';

    // #が含まれている場合
    if(strpos($file, '#') !== false){
      $fragment = "#{$parts[1]}";
    }

    // ?が含まれていない場合
    if(strpos($parts[0], '?') === false){
      $delimeter = '?';
    } else {
      $delimeter = '&';
    }

    $file = "{$parts[0]}{$delimeter}_=" . ANTICACHE_HASH . $fragment;
  }

  return $file;
}
