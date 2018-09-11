<?php
/**
 * ページングです
 *
 * @param int $range
 */
function pagination( $range = 6 ) {


  global $paged, $wp_query;
  if ( empty( $paged ) ) {
    $paged = 1;
  }

  $pages = $wp_query->max_num_pages;
  if ( ! $pages ) {
    $pages = 1;
  }

  $out = "";
  if ( 1 != $pages ) {


    if ( $paged > 1 ) {

      $before_page = get_pagenum_link( $paged - 1 );
      // 前のページと最初のページ
      $out .= <<<EOF
<div class="pagination-first-page">
    <a href="{$before_page}">
    <span class="icon icon-icon_arrow_left"></span>
    </a>
</div>
<div class="pagination--prev">
    <a href="{$before_page}">
        <span class="icon icon-icon_arrow_left"></span>
    </a>
</div>
EOF;
    }

    $out .= "<ul>";
    for ( $i = 1; $i <= $pages; $i ++ ) {
      if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) ) ) {
        if ( $paged == $i ) {
          // current syile
          $out .= <<<EOF
                    <li class="current">{$i}</li>
EOF;
        } else {
          // 普通のリンク
          $page_link = get_pagenum_link( $i );
          $out       .= <<<EOF
                    <li class="pagination__item">
                                                <a href="{$page_link}" class="pagination__link">{$i}</a>
                                            </li>
EOF;
        }
      }
    }

    $out .= "</ul>";

    if ( $paged < $pages ) {
      $next_page = get_pagenum_link( $paged + 1 );
      // 次のページ
      $out .= <<<EOF
<div class="pagination__next">
    <a href="{$next_page}">
        <span class="icon icon-icon_arrow_right"></span>
    </a>
</div>
EOF;

    }

    if ( $paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages ) {
      // last page
      $out .= <<<EOF
 DOMをかいていいよ
EOF;

    }

  }

  $out = '<div class="news__pagination"><div class="pagination">' . $out . "</div></div>";
  echo $out;
}
