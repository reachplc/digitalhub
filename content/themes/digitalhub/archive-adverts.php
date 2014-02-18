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

      <header class="archive-header">
        <h1 class="archive-title">Adverts</h1>
      </header><!-- .archive-header -->

          <div class="entry-content">
            <p>Aliquam magna quam, faucibus a sodales a, posuere feugiat libero. Suspendisse ut eleifend mi, eu imperdiet enim. Nam vitae nulla in orci scelerisque mattis non non neque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed elementum vel libero vitae auctor. Proin eleifend lacus felis, at condimentum erat fermentum id. Quisque in dui tortor. Pellentesque eu felis lacus. Phasellus vitae est non urna dignissim hendrerit ut et diam. In fermentum magna vel arcu accumsan posuere. Integer luctus lacus viverra consequat fringilla. Morbi in sapien dapibus, venenatis nisl at, sollicitudin justo.</p>
            <p>Etiam sapien urna, iaculis non ante vitae, tincidunt tincidunt ante. Aliquam erat volutpat. Fusce fringilla vel quam quis congue. Donec et nulla odio. Maecenas scelerisque velit vitae augue volutpat, in vulputate dui ornare. Duis pulvinar mollis pellentesque.</p>
          </div>
        </article>
        <aside class="grid ss__1-4 ms__1-6 ls__7-12 xls__11-18">
          <img class="image__responsive" src="<?php echo get_stylesheet_directory_uri(); ?>/images/format_header.png" alt="">
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
