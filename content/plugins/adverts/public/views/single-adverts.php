<?php
/**
 * Represents the view for the public-facing component of the plugin.
 *
 * This typically includes any information, if any, that is rendered to the
 * frontend of the theme when the plugin is activated.
 *
 * @package   Adverts
 * @author    Michael Bragg <michael@michaelbragg.net>
 * @license   GPL-2.0+
 * @link      http://trinitymirror.github.io
 * @copyright 2013 Trinity Mirror Creative
 */
?>

<?php
get_header(); ?>

  <div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">

      <?php /* The loop */ ?>
      <?php while ( have_posts() ) : the_post(); ?>

      <?php
      /**
       * Fall-back to plugin's content-adverts.php if theme's
       * is not available.
       */
      if(locate_template('content-'.'adverts'.'.php') != '') {
        get_template_part( 'content', get_post_format() );
      }

      if(is_file( plugin_dir_path( __FILE__ ) . 'content-' . $wp->query_vars['post_type'] . '.php') ) {
        include(plugin_dir_path( __FILE__ ) . 'content-' . $wp->query_vars['post_type'] . '.php');
      }
      ?>
      <?php comments_template(); ?>

      <?php endwhile; ?>

    </div><!-- #content -->
  </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
