<?php
/**
 * Archive view for the public-facing component of the plugin.
 *
 * To overwrite this template copy it to your themes folder
 * and make your amends.
 *
 * @package   Adverts
 * @author    Michael Bragg <michael@michaelbragg.net>
 * @license   GPL-2.0+
 * @link      http://trinitymirror.github.io
 * @copyright 2013 Trinity Mirror Creative
 */
?>

<?php get_header(); ?>

  <div class="wrapper__sub">

  <div id="primary" class="content-area">

    <main id="main" class="site-main" role="main">

    <?php if ( have_posts() ) : ?>
      <header class="archive-header">
        <h1 class="archive-title">Adverts</h1>
      </header><!-- .archive-header -->

      <?php /* The loop */ ?>
      <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'content', get_post_format() ); ?>
      <?php endwhile; ?>

      <?php
      global $wp_query;

      $big = 999999999; // need an unlikely integer

      echo paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages
      ) );
      ?>

    <?php else : ?>
      <?php get_template_part( 'content', 'none' ); ?>
    <?php endif; ?>

     </main><!-- #main -->
  </div><!-- #primary -->

  </div><!--/ wrapper__sub  -->

<?php get_footer(); ?>
