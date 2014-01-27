<?php
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
$taxonomy_type = 'packages';
$id = $post->ID;
$pages = query_posts(array('showposts' => 99, 'post_parent' => $id, 'post_type' => 'page'));
$current_package = 0;
$current_package_post = 0;
$alt = true;

function package_aside(){ ?>
  <aside class="grid ss__1-4 ms__1-2 ls__1-4 xls__1-6">
  <img class="image__responsive" src="<?php the_package_image(); ?>" alt="">
  </aside>
<?php }

function package_section(){?>
  <section class="grid ss__1-4 ms__3-6 ls_5-12 xls__7-18">
    <h1 class="term-heading"><?php the_package_title(); ?></h1>
    <p><?php the_package_description();?></p>
    <p><a class="btn btn--primary" href="<?php the_package_link();?>">View Available Formats</a></p>
  </section>
<?php }

get_header(); ?>

<div class="wrapper__sub">

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

    <?php /* Start the Loop */ ?>
      <?php while ( have_packages() ) : the_packages(); ?>

      <article id="" class="cf">
        <?php echo (($alt = !$alt)?package_aside() . package_section():package_section() . package_aside());?>
      </article>


      <?php endwhile; ?>

<?php
function package_page_aside() { ?>
<aside class="grid ss__1-4 ms__1-2 ls__1-4 xls__1-6">
<img class="image__responsive" src="<?php the_package_page_image(); ?>" alt="">
</aside><?php
}

function package_page_section(){ ?>
<section class="grid ss__1-4 ms__3-6 ls_5-12 xls__7-18">
  <h1 class="term-heading"><?php the_package_page_title(); ?></h1>
  <p><?php the_package_page_description(); ?></p>
  <p><a class="btn btn--primary" href="<?php the_package_page_link(); ?>">View Available Formats</a></p>
</section>
<?php }

while (have_package_page()) { the_package_page(); ?>

  <article id="" class="cf">
    <?php echo (($alt = !$alt)?package_page_aside() . package_page_section():package_page_section() . package_page_aside());?>
  </article>

<?php } ?>

    </main><!-- #main -->
  </div><!-- #primary -->

</div><!--/ wrapper_sub  -->

<?php get_footer(); ?>
