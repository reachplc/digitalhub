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
		<div class="site-info wrapper__sub">
			<?php do_action( 'digitalhub_credits' ); ?>
			<div id="tm-logo"></div>
			<div id="copy-credit">Copyright © Trinity Mirror plc 2014 <a href="#" id="credit"> Trinity Mirror Creative</a></div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>


<script>
;(function( $ ){
  $(document).ready(function() {

    // To extend the default config settings
    // pass a object as an argument for the init function
    // eg. randomHero.init({ images: 'image01.jpg', 'image02.jpg' });

    randomHero.init( { parent: '#bgimg', path: '<?php echo get_template_directory_uri(); ?>/images/', images: ['back_one.png', 'backgroundtest_02.jpg', 'backgroundtest_03.jpg'] });

  });
})( jQuery );


<?php if( $post_type == 'adverts' ) {?>
;(function( $ ){
  $(document).ready(function(){
    // Target your .container, .wrapper, .post, etc.
    $(".example").fitVids();
  });
})( jQuery );
<?php } ?>

</script>



<script>
<?php if( $page == 'regions') {?>
;(function( $ ){
$(document).ready(function(e) {
  $('img[usemap]').rwdImageMaps();
});
})( jQuery );
<?php } ?>
</script>




    <script>

    ;(function( $ ){

    function goToScrollDiv(link){
          // Reove "link" from the ID
var href = link;

 
        //link = link.remove("#", "");
        $('html,body').animate({
            scrollTop: $(href).offset().top},
            'slow');
       
        console.log (href);  
    }
    

    $("#reg__map-wrap map area").click(function(e) { 
          // Prevent a page reload when a link is pressed
        

        var link = $(this).attr('href');
      
          // Call the scroll function
        goToScrollDiv(link); 


             
    });

})( jQuery );


    </script>

</body>
</html>