<?php
/**
 * Custom Content view for Adverts plugin
 *
 * @package   Adverts
 * @author    Michael Bragg <michael@michaelbragg.net>
 * @license   GPL-2.0+
 * @link      http://trinitymirror.github.io
 * @copyright 2013 Trinity Mirror Creative
 */
?>

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
