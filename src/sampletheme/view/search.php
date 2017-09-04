<?php
/**
 * The template for displaying search results pages
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 * @package Sample_Theme
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>

  <?php echo get_search_query(); ?>

  <?php while ( have_posts() ) : the_post(); ?>

  <?php endwhile; ?>

<?php endif; ?>

<?php
get_sidebar();
get_footer();
