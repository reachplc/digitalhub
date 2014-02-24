<?php

/*
Template Name: Regions
*/


/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package DigitalHub
 */

$taxonomy_type = 'regions';
$terms = get_terms($taxonomy_type, array( 'orderby' => 'menu_order' ));

get_header(); ?>

<div class="wrapper__sub">
<div id="primary" class="content-area">
<main id="main" class="site-main" role="main">

  <?php if ( have_posts() ) : ?>

    <section class="box separator--horizontal cf">
    <?php while ( have_posts() ) : the_post(); ?>
      <?php get_template_part( 'content', 'page' ); ?>
      <?php endwhile; // end of the loop. ?>
    </section>

    <section class="box cf">

      <?php foreach( $terms as $term ): ?>
      <article class="region__preview box separator--horizontal cf">
      <header class="gallery--header grid ss__1-4 ms__1-6 ls__1-12 xls__1-18 cf">
        <h2 id="<?php echo $term->slug; ?>"><?php echo $term->name;?></h2>
      </header>
        <?php $myposts = get_posts(array(
                'post_type' => 'titles',
                'taxonomy' => $term->taxonomy,
                'term' => $term->slug,
                'orderby' => 'menu_order',
                'order' => 'ASC',
                'nopaging' => true
              ));?>
       <ul class="list list____inline">
        <?php /*  Loop  */ ?>
        <?php  foreach( $myposts as $post ):?>
          <?php setup_postdata($post); ?>
          <?php get_template_part( 'content', 'titles' ); ?>
        <?php endforeach;?>
        <?php wp_reset_postdata(); ?>
        </ul>
      </article>
      <?php  endforeach; ?>


    <?php else : ?>
      <?php get_template_part( 'content', 'none' ); ?>

    </section>

  <?php endif; ?>

</main>
<!-- #main -->
</div>
<!-- #primary -->

</div>

<div id ="back-map"><a href="#map">Back to Map</a></div>
<!--/ wrapper_sub  -->

<?php get_footer(); ?>
