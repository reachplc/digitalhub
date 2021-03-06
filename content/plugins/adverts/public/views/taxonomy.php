<?php
/**
 * Represents the view for the public-facing component of the plugin.
 *
 * This typically includes any information, if any, that is rendered
 * to the frontend of the theme when the plugin is activated.
 *
 * @package   Adverts
 * @author    Michael Bragg <michael@michaelbragg.net>
 * @license   GPL-2.0+
 * @link      http://trinitymirror.github.io
 * @copyright 2013 Trinity Mirror Creative
 */
?>
<?php $taxomnomy = $wp_query->get_queried_object();?>

<?php get_header(); ?>

  <div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">

<?php if ( have_posts() ) : ?>

      <header class="archive-header">
        <h1 class="archive-title"><?php echo $taxomnomy->name; ?></h1>
        <p> <?php echo $taxomnomy->description; ?></p>
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
<?php get_footer(); ?>
