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
$posts = get_categories('taxonomy=' . $taxonomy_type . '&type=adverts');
$terms = get_terms($taxonomy_type, array( 'orderby' => 'menu_order' ));

$current_package = 0;
$alt = true;

function package_aside(){ ?>
  <aside class="packages-image packages-image--<?php the_package_class(); ?>">
  </aside>
<?php }

function package_section(){?>
  <section class="packages-text">
    <h1 class="packages__title"><?php the_package_title(); ?></h1>
    <p><?php the_package_description();?></p>
    <p><a class="btn btn--primary" href="<?php the_package_link();?>">View Available Formats<span class="sprite sprite--plus icon icon__append"></span></a></p>
    <aside class="packages-image--<?php the_package_class(); ?> hide">
  </section>
<?php }

get_header(); ?>

<div class="wrapper__sub">

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

    <header class="intro">

    <h1 class="packages__title">Welcome to the TM Digital Hub.</h1>

    <p class="gamma intro__content">Just by choosing us, you've already taken the first step to a larger audience, more innovative advertising and a bigger market share for your business.</p>

    <p class="gamma intro__content">Browse our gallery of exciting and innovative digital advertising solutions, from simple online ad slots, to bespoke campaigns that employ the most creative and effective strategies to drive audience and maximise response.</p>

    </header>

    <?php /* Start the Loop */ ?>
      <?php while ( have_packages() ) : ?>

      <article id="" class="cf packages__img">
        <?php echo (($alt = !$alt)?package_aside() . package_section():package_section() . package_aside());?>
      </article>


      <?php the_packages(); endwhile; ?>

    </main><!-- #main -->
  </div><!-- #primary -->

</div><!--/ wrapper_sub  -->

<?php get_footer(); ?>
