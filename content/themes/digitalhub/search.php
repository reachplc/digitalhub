<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package DigitalHub
 */

get_header(); ?>

<div class="wrapper__sub">

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header box grid ss__1-4 ms__1-6 ls__1-12 xls__1-18">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'digitalhub' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'search' ); ?>

			<?php endwhile; ?>

			<?php digitalhub_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->
</div>
<?php get_footer(); ?>
