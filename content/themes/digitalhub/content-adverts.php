<?php
/**
 * @package DigitalHub
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('gallery__item'); ?>>

<?php if ( has_post_thumbnail() ) { // check if the post has a Post ?>
  <aside class="gallery--image">
    <?php the_post_thumbnail(); ?>
  </aside>
<?php } else { ?>

  <aside class="gallery--image">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/adverts_generic.jpg" alt="">
  </aside>

<?php } ?>
  <header class="adverts__header">
    <h1 class="adverts__title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
    <p class="adverts__content"><?php echo __( 'View Info &amp; Examples', 'digitalhub' ); ?></p>
  </header><!-- .entry-header -->
</article>