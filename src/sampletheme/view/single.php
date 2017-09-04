<?php
/**
 * The template for displaying all single posts
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<?php endwhile; ?>

<?php
get_sidebar();
get_footer();
