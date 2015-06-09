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
<div>Plugin Template</div>
<?
get_header(); ?>

  <div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">

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
			'current' => max( 1, get_query_var( 'paged' ) ),
			'total' => $wp_query->max_num_pages
		) );
		?>

    <?php else : ?>
		<?php get_template_part( 'content', 'none' ); ?>
    <?php endif; ?>

    </div><!-- #content -->
  </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>>
