<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>
  <?php while ( have_posts() ) : the_post(); ?>

    <?php echo get_permalink(); ?>

    <?php if ( has_post_thumbnail() ) : ?>

      <?php the_post_thumbnail( "" ); ?>

    <?php else: ?>

      <?php //NoIMAGE ?>

    <?php endif; ?>

    <?php echo get_the_date( 'Y/m/d' ); ?>
    <?php the_title(); ?>
    <?php the_content(); ?>

  <?php endwhile; ?>
<?php endif; ?>

<?php
get_sidebar();
get_footer();
