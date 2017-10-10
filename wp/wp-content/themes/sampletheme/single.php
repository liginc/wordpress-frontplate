<?php
/**
 * The template for displaying all single posts
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

  <?php the_title(); // The title of post(タイトル). ?>

  <?php the_time( 'Y-m-d H:i:s' ); // The published time(local timezone) of post(公開日時). ?>

  <?php if ( has_post_thumbnail() ) : ?>
    <img src="<?php the_post_thumbnail_url( 'large' ); // The url of large size eye-catch image(アイキャッチ). ?>" alt="<?php the_title(); ?>のアイキャッチ">
  <?php endif; ?>

  <?php the_content(); // The content of post(本文) with HTML. ?>

  <?php the_author(); // The display name(ブログ上の表示名). ?>

  <?php
  // $user = get_userdata( get_the_author_meta( 'ID' ) ); // Return the instance of WP_User if exist.
  // echo $user->image; // If user has custom meta, can access the meta data via magic method like this.
  ?>

  <?php foreach ( get_the_category() as $category ): // $category is instance of WP_Term(カテゴリー). ?>
    <?php echo esc_html( $category->name ); ?>
  <?php endforeach; ?>

  <?php if ( $tags = get_the_tags() ): // Return either array or false. ?>
    <?php foreach ( $tags as $tag ): // $tag is instance of WP_Term(タグ). ?>
      <?php echo esc_html( $tag->name ); ?>
    <?php endforeach; ?>
  <?php endif; ?>

  <?php if ( $terms = get_the_terms( get_the_ID(), 'CUSTOM_TAXONOMY_NAME' ) ): // Return either array or false when custom taxonomy exist. ?>
    <?php foreach ( $terms as $term ): // $term is instance of WP_Term(タグ). ?>
      <?php echo esc_html( $term->name ); ?>
    <?php endforeach; ?>
  <?php endif; ?>

  <?php if ( $newer_post = get_next_post() ): // Return the instance of Post newer post than current if exist. ?>
    <a href="<?php the_permalink( $newer_post ); ?>"><?php echo esc_html( get_the_title( $newer_post ) ); ?></a>
  <?php endif; ?>

  <?php if ( $older_post = get_previous_post() ): // Return the instance of Post older than current if exist. ?>
    <a href="<?php the_permalink( $older_post ); ?>"><?php echo esc_html( get_the_title( $older_post ) ); ?></a>
  <?php endif; ?>

<?php endwhile; ?>

<?php get_sidebar(); ?>

<?php
get_footer();
