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

  <div class="wrapper__sub">

  <div id="primary" class="content-area">

    <main id="main" class="site-main" role="main">

    <?php if ( have_posts() ) : ?>

      <header class="archive-header">
        <h1 class="archive-title"><?php echo $taxomnomy->name; ?></h1>
        <p> <?php echo $taxomnomy->description; ?></p>
      </header><!-- .archive-header -->

      <?php /* The loop */ ?>
      <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'content', 'formats'); ?>
      <?php endwhile; ?>

    <?php else : ?>
      <?php get_template_part( 'content', 'none' ); ?>
    <?php endif; ?>

    </main><!-- #main -->
  </div><!-- #primary -->

  </div><!--/ wrapper__sub  -->
<?php get_footer(); ?>
