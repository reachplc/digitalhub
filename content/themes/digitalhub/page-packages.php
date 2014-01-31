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
$posts = get_categories('taxonomy=packages&type=adverts');
$pages = get_pages(array( 'child_of' => $post->ID, 'sort_column' => 'post_date', 'sort_order' => 'desc' ));

$current_package = 0;
$current_package_post = 0;
$alt = true;

function package_aside(){ ?>
  <aside class="packages-image">
  <img class="image__responsive" src="<?php the_package_image(); ?>" alt="">
  </aside>
<?php }

function package_section(){?>
  <section class="packages-text">
    <h1 class="packages__title"><?php the_package_title(); ?></h1>
    <p><?php the_package_description();?></p>
    <p><a class="btn btn--primary" href="<?php the_package_link();?>">View Available Formats<span class="sprite sprite--plus icon icon__append"></span></a></p>
    <img class="image__responsive hide" src="<?php the_package_page_image(); ?>" alt="">
  </section>
<?php }

get_header(); ?>

<div class="wrapper__sub">

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
<h1>Welcome to the TM Digital Hub.</h1>

<h1>Just by choosing us, you’ve already taken the first step to a larger audience, more innovative advertising and a bigger market share for your business.</h1>

<h1>Browse our gallery of exciting and innovative digital advertising solutions, from simple online ad slots, to bespoke campaigns that employ the most creative and effective strategies to drive audience and maximise response.</h1>

    <?php /* Start the Loop */ ?>
      <?php while ( have_packages() ) : the_packages(); ?>

      <article id="" class="cf packages__img">
        <?php echo (($alt = !$alt)?package_aside() . package_section():package_section() . package_aside());?>
      </article>


      <?php endwhile; ?>

<?php
function package_page_aside() { ?>
<aside class="packages-image">
<img class="image__responsive" src="<?php the_package_page_image(); ?>" alt="">
</aside><?php
}

function package_page_section(){ ?>
<section class="packages-text">

  <h1 class="packages__title"><?php the_package_page_title(); ?></h1>
  <p><?php the_package_page_description(); ?></p>
  <p>
    <p><a class="btn btn--primary" href="<?php the_package_page_link();?>">View Available Formats<span class="sprite sprite--plus icon icon__append"></span></a></p>
  <img class="image__responsive hide" src="<?php the_package_page_image(); ?>" alt="">
</section>
<?php }

while (have_package_page()) { the_package_page(); ?>

  <article id="" class="cf packages__img">
    <?php echo (($alt = !$alt)?package_page_aside() . package_page_section():package_page_section() . package_page_aside());?>
  </article>

<?php } ?>

    </main><!-- #main -->
  </div><!-- #primary -->

</div><!--/ wrapper_sub  -->

<?php get_footer(); ?>
