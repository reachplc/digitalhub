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

get_header(); ?>

<div class="wrapper__sub">

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

<?php
$terms = get_terms('packages');
   foreach ($terms as $term) {
      $wpq = array ('taxonomy'=>'packages','term'=>$term->slug);
      $myquery = new WP_Query ($wpq);
      $article_count = $myquery->post_count;
      echo "<h1 class=\"term-heading\" id=\"".$term->slug."\">";
      echo $term->name;
      echo "</h1>";
      echo '<p>' . $term->description . '</p>';
      echo '<p>';
      echo '<a class="btn btn--primary" href="'. trailingslashit($term->slug) . '">';
      echo 'View Available Formats';
      echo '</a>';
      echo '</p>';
      }
?>

    </main><!-- #main -->
  </div><!-- #primary -->

</div><!--/ wrapper_sub  -->

<?php get_footer(); ?>
