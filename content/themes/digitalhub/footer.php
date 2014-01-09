<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package DigitalHub
 */
?>

	</div><!-- #content -->

</div><!-- #end of container -->

</div><!-- #end of wrapper -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php do_action( 'digitalhub_credits' ); ?>
			<a href="http://wordpress.org/" rel="generator"><?php printf( __( 'Proudly powered by %s', 'digitalhub' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'digitalhub' ), 'DigitalHub', '<a href="http://www.trinitymirror.com" rel="designer">Trinity Mirror Creative</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<script src="js/menu-slide.js">
<script src="js/jquery.toggle-nav.js">
<?php wp_footer(); ?>

</body>
</html>