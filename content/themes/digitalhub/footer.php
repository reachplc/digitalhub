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

        <footer id="colophon" class="footer__main cf" role="contentinfo">
                <div class="site-info wrapper__sub">
                        <?php do_action( 'digitalhub_credits' ); ?>
                        <a href="http://www.trinitymirror.com/">
                        <div class="tm-logo sprite"></div></a>
                        <div class="copy-credit">Copyright &copy; Trinity Mirror plc 2014 <a href="<?php echo home_url( '' ); ?>/tmcreative/" id="credit">Trinity Mirror Creative</a></div>
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

    randomHero.init( { parent: '#bgimg', path: '<?php echo get_template_directory_uri(); ?>/images/hero/', images: ['hero_001.jpg', 'hero_002.jpg', 'hero_003.jpg', 'hero_004.jpg', 'hero_005.jpg', 'hero_007.jpg', 'hero_008.jpg', 'hero_009.jpg', 'hero_010.jpg'] });

  });
})( jQuery );
</script>

<?php if( !empty($post_type) == 'adverts' ) {?>
<script>
;(function( $ ){
  $(document).ready(function(){
    // Target your .container, .wrapper, .post, etc.
    $(".example").fitVids();
  });
})( jQuery );
</script>
<?php } ?>

<?php if( !empty($page) == 'regions') {?>
<script>
;(function( $ ){
$(document).ready(function(e) {
  $('img[usemap]').rwdImageMaps();
});
})( jQuery );
</script>
<?php } ?>

<script>
;(function( $ ){

  function goToScrollDiv(link){
    // Reove "link" from the ID
    var href = link;
    //link = link.remove("#", "");
    $('html,body').animate({
      scrollTop: $(href).offset().top-110}
      , 800);;
    }

    $("#reg__map-wrap map area, .contacts-menu ul li a").click(function(e) {
          // Prevent a page reload when a link is pressed
          e.preventDefault();
        var link = $(this).attr('href');
          // Call the scroll function
        goToScrollDiv(link);
    });



})( jQuery );


;(function( $ ){
$(window).scroll(function(){
    if ($(this).scrollTop() > 120) {
       $('#area__tags-wrap').addClass('fadeInDown');
    } else {
       $('#area__tags-wrap').removeClass('fadeInDown');

    }
});
})( jQuery );
</script>

<?php if( !empty($page) == 'regions') {?>
<script>
;(function( $ ){

$(document).ready(function(){

  // hide #back-top first
  $("#back-map").hide();

  // fade in #back-top
  $(function () {
    $(window).scroll(function () {
      if ($(this).scrollTop() > 550) {
        $('#back-map').fadeIn();
      } else {
        $('#back-map').fadeOut();
      }
    });

    // scroll body to 0px on click
    $('#back-map a').click(function () {
      $('html, body').animate({
        scrollTop: $("#map").offset().top-140
    }, 800);
      return false;
    });
  });

});
})( jQuery );
</script>
<?php } ?>

<script>

var iconBase = '<?= get_bloginfo("template_url") . '/images/'; ?>';


</script>

</body>
</html>