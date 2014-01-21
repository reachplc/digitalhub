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
?>
    <article id="<?php echo $term->slug; ?>" class="cf">

      <aside class="grid ss__1-4 ms__1-2 ls__1-4 xls__1-6">
        <img src="http://placehold.it/250x250.png" alt="">
      </aside>

      <section class="grid ss__1-4 ms__3-6 ls_5-12 xls__7-18">
        <h1 class="term-heading"><?php echo $term->name; ?></h1>
        <p><?php echo $term->description; ?></p>
        <p><a class="btn btn--primary" href="<?php echo trailingslashit(home_url()) . trailingslashit('packages') . trailingslashit($term->slug); ?>">View Available Formats</a></p>
      </section>

    </article>
<?php } ?>

<?php
$id = $post->ID;
query_posts(array('showposts' => 20, 'post_parent' => $id, 'post_type' => 'page'));
while (have_posts()) { the_post(); ?>
  <article id="" class="cf">
    <aside class="grid ss__1-4 ms__1-2 ls__1-4 xls__1-6">
      <img src="http://placehold.it/250x250.png" alt="">
    </aside>

    <section class="grid ss__1-4 ms__3-6 ls_5-12 xls__7-18">
        <h1 class="term-heading"><?php the_title(); ?></h1>
        <p>@TODO: description</p>
        <p><a class="btn btn--primary" href="#">View Available Formats</a></p>
    </section>
  </article>
<?php } ?>

    </main><!-- #main -->
  </div><!-- #primary -->

</div><!--/ wrapper_sub  -->

<?php get_footer(); ?>
