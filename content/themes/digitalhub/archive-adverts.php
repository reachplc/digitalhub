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
global $post;
$categories = get_terms('formats', array( 'orderby' => 'menu_order' ));

?>

<?php get_header(); ?>

  <div class="wrapper__sub">

  <div id="primary" class="content-area">

    <main id="main" class="site-main" role="main">

      <section class="adverts__intro cf">
        <article class="grid ss__1-4 ms__1-6 ls__1-6 xls__1-10">

      <header class="adverts--header">
        <h1>Adverts</h1>
      </header><!-- .archive-header -->

          <div class="entry-content">
            <p>Trinity Mirror has a wide range of display advertising formats designed to deliver your message across all platforms and create experiences enabling you to engage with our audience of 33 million.</p>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/XLtW0JiWHNY" frameborder="0" allowfullscreen></iframe>
          </div>
        </article>
        <aside id="js-format-image"class="grid ss__1-4 ms__1-6 ls__7-12 xls__11-18 format-image">
        </aside>
      </section>


    <?php if ( have_posts() ) : ?>
    <section class="cf">
    <?php get_template_part( 'nav', 'taxonomies-adverts' ); ?>
    </section>
      <?php foreach( $categories as $category ): ?>

        <section class="gallery box separator--horizontal cf">
        <div class="cf">
          <header class="gallery--header grid ss__1-4 ms__1-6 ls__1-12 xls__1-18 cf">
            <h2 id="<?php echo $category->slug; ?>"><?php echo $category->name;?><a class="back-to-top" href="#page" title="back to top"><span class="icon icon__append sprite sprite--top-blue"></span></a></h2>
          </header>
        </div>
        <?php $myposts = get_posts(array(
                'post_type' => 'adverts',
                'taxonomy' => $category->taxonomy,
                'term' => $category->slug,
                'nopaging' => true
              ));?>

        <?php /*  Loop  */ ?>
        <?php  foreach( $myposts as $post ):?>
          <?php setup_postdata($post); ?>

          <?php get_template_part( 'content', 'adverts' ); ?>

        <?php endforeach;?>
        <?php wp_reset_postdata(); ?>

        </section>
      <?php  endforeach; ?>

    <?php else : ?>
      <?php get_template_part( 'content', 'none' ); ?>
    <?php endif; ?>

     </main><!-- #main -->
  </div><!-- #primary -->

  </div><!--/ wrapper__sub  -->

<?php get_footer(); ?>
