<?php
/**
 * Represents the view for the public-facing component of the plugin.
 *
 * This typically includes any information, if any, that is rendered to the
 * frontend of the theme when the plugin is activated.
 *
 * @package   Adverts
 * @author    Michael Bragg <michael@michaelbragg.net>
 * @license   GPL-2.0+
 * @link      http://trinitymirror.github.io
 * @copyright 2013 Trinity Mirror Creative
 */
?>

<?php
get_header(); ?>

  <div class="wrapper__sub">

  <div id="primary" class="content-area">

    <main id="main" class="site-main" role="main">

      <?php /* The loop */ ?>
      <?php while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <header class="entry-header">
    <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
    <div class="entry-thumbnail">
      <?php the_post_thumbnail('full'); ?>
    </div>
    <?php endif; ?>

    <?php if ( is_single() ) : ?>
    <h1 class="entry-title"><?php the_title(); ?></h1>
    <?php else : ?>
    <h1 class="entry-title">
      <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
    </h1>
    <?php endif; // is_single() ?>

    <div class="entry-meta">
      <?php
        $custom         = get_post_custom();

        if(!empty($custom['document_file_id'][0]) && $custom['document_file_id'][0] != '0') {
          $download_id    = $custom['document_file_id'][0];

            echo '<p><a href="' . wp_get_attachment_url($download_id) . '">
                Download Build Guide</a></p>';
        }
        ?>

        <?php

        //  Example Adverts

        if(!empty($custom['_example_1_url_preview']) && $custom['_example_1_url_preview'][0] != '0') {

          $_example_preview = urldecode( $custom['_example_1_url_preview'][0] );
          $_example_mp4 = urldecode( $custom['_example_1_url_mp4'][0] );
          $_example_webm = urldecode( $custom['_example_1_url_webm'][0] );
          $_example_ogg = urldecode( $custom['_example_1_url_ogg'][0] );
          $_example_flv = urldecode( $custom['_example_1_url_flv'][0] );
          echo '<div class="example-video example_video--active">';
          echo '<video poster="' . $_example_preview . '" controls>';
          echo '<source src="' . $_example_mp4 . '">';
          echo '<source src="' . $_example_webm . '">';
          echo '<source src="' . $_example_ogg . '">';
          echo '<p>This is fallback content</p>';
          echo '</video>';
          echo '</div>';
        }

        if(!empty($custom['_example_2_url_preview']) && $custom['_example_2_url_preview'][0] != '0') {

          $_example_preview = urldecode( $custom['_example_2_url_preview'][0] );
          $_example_mp4 = urldecode( $custom['_example_2_url_mp4'][0] );
          $_example_webm = urldecode( $custom['_example_2_url_webm'][0] );
          $_example_ogg = urldecode( $custom['_example_2_url_ogg'][0] );
          $_example_flv = urldecode( $custom['_example_2_url_flv'][0] );
          echo '<div class="example-video example_video--active">';
          echo '<video poster="' . $_example_preview . '" controls>';
          echo '<source src="' . $_example_mp4 . '">';
          echo '<source src="' . $_example_webm . '">';
          echo '<source src="' . $_example_ogg . '">';
          echo '<p>This is fallback content</p>';
          echo '</video>';
          echo '</div>';
        }

        if(!empty($custom['_example_3_url_preview']) && $custom['_example_3_url_preview'][0] != '0') {

          $_example_preview = urldecode( $custom['_example_3_url_preview'][0] );
          $_example_mp4 = urldecode( $custom['_example_3_url_mp4'][0] );
          $_example_webm = urldecode( $custom['_example_3_url_webm'][0] );
          $_example_ogg = urldecode( $custom['_example_3_url_ogg'][0] );
          $_example_flv = urldecode( $custom['_example_3_url_flv'][0] );
          echo '<div class="example-video example_video--active">';
          echo '<video poster="' . $_example_preview . '" controls>';
          echo '<source src="' . $_example_mp4 . '">';
          echo '<source src="' . $_example_webm . '">';
          echo '<source src="' . $_example_ogg . '">';
          echo '<p>This is fallback content</p>';
          echo '</video>';
          echo '</div>';
        }

        ?>

      <?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
    </div><!-- .entry-meta -->
  </header><!-- .entry-header -->

  <?php if ( is_search() ) : // Only display Excerpts for Search ?>
  <div class="entry-summary">
    <?php the_excerpt(); ?>
  </div><!-- .entry-summary -->
  <?php else : ?>
  <div class="entry-content">
    <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?>
    <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
  </div><!-- .entry-content -->
  <?php endif; ?>

  <footer class="entry-meta">
    <?php if ( comments_open() && ! is_single() ) : ?>
      <div class="comments-link">
        <?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'twentythirteen' ) . '</span>', __( 'One comment so far', 'twentythirteen' ), __( 'View all % comments', 'twentythirteen' ) ); ?>
      </div><!-- .comments-link -->
    <?php endif; // comments_open() ?>

    <?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
      <?php get_template_part( 'author-bio' ); ?>
    <?php endif; ?>
  </footer><!-- .entry-meta -->
</article><!-- #post -->
      <?php comments_template(); ?>

      <?php endwhile; ?>

    </main><!-- #main -->
  </div><!-- #primary -->

  <?php get_sidebar(); ?>

  </div><!--/ wrapper__sub  -->

<?php get_footer(); ?>
