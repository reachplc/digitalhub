<?php
/**
 * The template for displaying taxonomy terms with links.
 *
 * @package DigitalHub
 */

$taxonomies = 'formats';
$args = array(
  'orderby'       => 'count',
  'order'         => 'DESC',
  'hide_empty'    => true,
);
$terms = get_terms( $taxonomies, $args );
$count = count($terms);

?>

<section class="adverts__nav grid ss__1-4 ms__1-6 ls__1-12 xls__1-18">
<?php

  if ( $count > 0 ){

    echo '<ul class="list list__inline">';

    foreach ( $terms as $term ) {

      $url = trailingslashit(home_url()) . trailingslashit($taxonomies) . trailingslashit($term->slug);

      echo '<li><a href="' . $url . '">' . $term->name . '</a></li>';

    }

    echo '</ul>';

  }
?>
</section>