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

      <section class="cf">
        <article class="grid ss__1-4 ms__3-6 ls_5-12 xls__7-18">

      <header class="archive-header">
        <h1 class="archive-title">Adverts</h1>
      </header><!-- .archive-header -->

          <div class="entry-content">
            <p>Aliquam magna quam, faucibus a sodales a, posuere feugiat libero. Suspendisse ut eleifend mi, eu imperdiet enim. Nam vitae nulla in orci scelerisque mattis non non neque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed elementum vel libero vitae auctor. Proin eleifend lacus felis, at condimentum erat fermentum id. Quisque in dui tortor. Pellentesque eu felis lacus. Phasellus vitae est non urna dignissim hendrerit ut et diam. In fermentum magna vel arcu accumsan posuere. Integer luctus lacus viverra consequat fringilla. Morbi in sapien dapibus, venenatis nisl at, sollicitudin justo.</p>
            <p>Etiam sapien urna, iaculis non ante vitae, tincidunt tincidunt ante. Aliquam erat volutpat. Fusce fringilla vel quam quis congue. Donec et nulla odio. Maecenas scelerisque velit vitae augue volutpat, in vulputate dui ornare. Duis pulvinar mollis pellentesque.</p>
          </div>
        </article>
        <aside class="grid ss__1-4 ms__1-2 ls__1-4 xls__1-6">
          <img class="image__responsive" src="http://placehold.it/600x326.png" alt="">
        </aside>
      </section>

    <?php if ( have_posts() ) : ?>
      <section class="gallery cf">
      <?php /* The loop */ ?>
      <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'content', 'adverts' ); ?>
      <?php endwhile; ?>
      </section>
      <section class="pagination">
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
      </section>
    <?php else : ?>
      <?php get_template_part( 'content', 'none' ); ?>
    <?php endif; ?>

     </main><!-- #main -->
  </div><!-- #primary -->

  </div><!--/ wrapper__sub  -->

<?php get_footer(); ?>
