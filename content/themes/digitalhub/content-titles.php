<?php
/**
 * @package DigitalHub
 */
?>

<li>
<?php if(have_link()){ ?>

  <a href="<?php the_link(); ?>" target="_blank">
<?php } ?>
<?php if ( has_post_thumbnail() ) { // check if the post has a thumbnail ?>
    <?php the_post_thumbnail(); ?>
<?php } else { ?>
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/generic_thumbnail.png" alt="">
<?php } ?>

<?php if(have_link()){ ?>
  </a>
<?php } ?>
</li>
