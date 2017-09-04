<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>

  <?php while ( have_posts() ) : the_post(); ?>

  <?php endwhile; ?>

<?php endif; ?>

<?php
get_sidebar();
get_footer();
