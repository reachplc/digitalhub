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
			<div id="tm-logo"></div>
			<div id="copy-credit">Copyright © Trinity Mirror plc 2014 <a href="#" id="credit"> Trinity Mirror Creative</a></div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>