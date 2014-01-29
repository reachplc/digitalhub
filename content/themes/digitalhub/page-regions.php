<?php

/*
Template Name: Regions
*/


/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package DigitalHub
 */

get_header(); ?>

<div class="wrapper__sub">
<div id="primary" class="content-area">
<main id="main" class="site-main" role="main">
<article id="<?php echo $term->slug; ?>" class="cf">
<section class="grid ss__1-4 ms__1-6 ls__1-12 xls__1-18">
<div class="grid ss__1-4 ms__1-6 ls__1-6 xls__1-9">
  <?php while ( have_posts() ) : the_post(); ?>
  <?php get_template_part( 'content', 'page' ); ?>
  <?php
          // If comments are open or we have at least one comment, load up the comment template
          if ( comments_open() || '0' != get_comments_number() ) :
            comments_template();
          endif;
        ?>
  <?php endwhile; // end of the loop. ?>
</div>
<aside class="grid ss__1-4 ms__1-6 ls__7-12 xls__10-18">
<div id = "reg__map-wrap">
<img name="regionmap" src="
<?php echo get_template_directory_uri(); ?>/images/map_base.png" class="region-img" id="regionmap" usemap="#m_regionmap" alt="" />
<div id = "area__tags-wrap" class="animated fadeInDown">
<img name="area-tags" src="<?php echo get_template_directory_uri(); ?>/images/area-tags.png" class="region-img" id="area-tags" usemap="#m_area-tags" alt="" />
<map name="m_area-tags" id="m_area-tags">
<area shape="rect" coords="298,368,403,407" href="#tms" title="Southwest" alt="Southwest" />
<area shape="rect" coords="162,329,244,368" href="#wales" title="Wales" alt="Wales" />
<area shape="rect" coords="255,287,356,323" href="#midlands" title="Midlands" alt="Midlands" />
<area shape="rect" coords="264,238,346,276" href="#men" title="MEN" alt="MEN" />
<area shape="rect" coords="148,246,261,287" href="#northwest" title="NorthWest" alt="NorthWest" />
<area shape="rect" coords="268,165,385,204" href="#northeast" title="NorthEast" alt="NorthEast" />
<area shape="rect" coords="191,125,298,160" href="#scotland" title="Scotland" alt="Scotland" />
</div>
</div>
</aside>
</section>
<section class="grid ss__1-4 ms__1-6 ls__1-12 xls__1-18">
  <div class="region__preview">
    <h1>National</h1>
    <ul class="list list__inline">
      <li><a title="Mirror" href="http://www.mirror.co.uk/" target="_blank"><img class="alignnone size-full wp-image-127" alt="mirror" src="http://localhost/digitalhub/content/uploads/2014/01/mirror.jpg" /></a></li>
    </ul>
  </div>
  <div class="region__preview" id="northwest">
    <h1>Northwest</h1>
    <ul class="list list__inline">
      <li><a title="Crewe Chronicle" href="http://www.crewechronicle.co.uk/" target="_blank"><img class="alignnone size-full wp-image-111" alt="crewe_chronicle" src="http://localhost/digitalhub/content/uploads/2014/01/crewe_chronicle.jpg" /></a></li>
      <li><a title="Chester Chronicle" href="http://www.chesterchronicle.co.uk/" target="_blank"><img class="alignnone size-full wp-image-109" alt="chester_chron" src="http://localhost/digitalhub/content/uploads/2014/01/chester_chron.jpg" /></a></li>
      <li><a title="Crosby Herald" href="http://www.crosbyherald.co.uk/" target="_blank"><img class="alignnone size-full wp-image-112" alt="crosby_herald" src="http://localhost/digitalhub/content/uploads/2014/01/crosby_herald.jpg" /></a></li>
      <li><a title="Formby Times" href="http://www.formbytimes.co.uk/" target="_blank"><img class="alignnone  wp-image-114" alt="formbytimes" src="http://localhost/digitalhub/content/uploads/2014/01/formbytimes.jpg" /></a></li>
      <li><a title="Liverpool Echo" href="http://www.liverpoolecho.co.uk/" target="_blank"><img class="alignnone size-full wp-image-123" alt="liverpool_echo" src="http://localhost/digitalhub/content/uploads/2014/01/liverpool_echo.jpg" /></a></li>
      <li><a title="Ormskirk &amp; Skelmersdale Advertiser" href="http://www.osadvertiser.co.uk/" target="_blank"><img class="alignnone size-full wp-image-128" alt="orm_skem_advertiser" src="http://localhost/digitalhub/content/uploads/2014/01/orm_skem_advertiser.jpg" /></a></li>
      <li><a title="Runcorn and Widnes Weekly News" href="http://www.runcornandwidnesweeklynews.co.uk/" target="_blank"><img class="alignnone size-full wp-image-130" alt="runc_widness_weekly" src="http://localhost/digitalhub/content/uploads/2014/01/runc_widness_weekly.jpg" /></a></li>
    </ul>
  </div>
  <div class="region__preview" id="midlands">
    <h1>Midlands</h1>
    <ul class="list ">
      <li><a title="Birmingham Mail" href="http://www.birminghammail.co.uk/" target="_blank"><img class="alignnone size-full wp-image-131" alt="birm_mail" src="http://localhost/digitalhub/content/uploads/2014/01/birm_mail-300x116.jpg" /></a></li>
      <li><a href="http://www.birminghampost.co.uk/"><img class="alignnone size-full wp-image-131" alt="birm_post" src="http://localhost/digitalhub/content/uploads/2014/01/birm_post-300x116.jpg" /></a></li>
      <li><a title="Coventry Telegraph" href="http://www.coventrytelegraph.net/"><img class="alignnone size-full wp-image-131" alt="coventry_tele" src="http://localhost/digitalhub/content/uploads/2014/01/coventry_tele-300x116.jpg" /></a></li>
      <li><a href="http://www.hinckleytimes.net/" target="_blank"><img class="alignnone size-full wp-image-121" alt="hinckleytimes" src="http://localhost/digitalhub/content/uploads/2014/01/hinckleytimes.jpg" /></a></li>
      <li><a title="Loughborough Echo" href="http://www.loughboroughecho.net/" target="_blank"><img class="alignnone size-full wp-image-131" alt="loughborough_echo" src="http://localhost/digitalhub/content/uploads/2014/01/loughborough_echo-300x116.jpg" /></a></li>
      <li><a title="Solihull News" href="http://www.solihullnews.net/" target="_blank"><img class="alignnone size-full wp-image-131" alt="solihull_news" src="http://localhost/digitalhub/content/uploads/2014/01/solihull_news.jpg" /></a></li>
    </ul>
  </div>
  <div class="region__preview" id="scotland">
    <h1>Scotland</h1>
    <ul class="list list__inline">
      <li><a title="Daily Record" href="http://www.dailyrecord.co.uk/" target="_blank"><img class="alignnone size-full wp-image-155" alt="daily_recorder" src="http://localhost/digitalhub/content/uploads/2014/01/daily_recorder.jpg" /></a></li>
    </ul>
  </div>
  <div class="region__preview" id="tms">
    <h1>TMS</h1>
    <ul class="list list__inline">
      <li><a title="getbucks" href="http://www.getbucks.co.uk/" target="_blank"><img class="alignnone size-full wp-image-116" alt="get_bucks" src="http://localhost/digitalhub/content/uploads/2014/01/get_bucks.jpg" /></a></li>
      <li><a title="gethampshire" href="http://www.gethampshire.co.uk/"><img class="alignnone size-full wp-image-117" alt="get_hamps" src="http://localhost/digitalhub/content/uploads/2014/01/get_hamps.jpg" /></a></li>
      <li><a title="getreading" href="http://www.getreading.co.uk/" target="_blank"><img class="alignnone size-full wp-image-118" alt="getreading" src="http://localhost/digitalhub/content/uploads/2014/01/getreading.jpg" /></a></li>
      <li><a title="getsurrey" href="http://www.getsurrey.co.uk/" target="_blank"><img class="alignnone size-full wp-image-119" alt="getsurrey" src="http://localhost/digitalhub/content/uploads/2014/01/getsurrey.jpg" /></a></li>
      <li><a title="getwestlondon" href="http://www.getwestlondon.co.uk/"><img class="alignnone size-full wp-image-120" alt="getwestlondon" src="http://localhost/digitalhub/content/uploads/2014/01/getwestlondon.jpg" /></a></li>
    </ul>
  </div>
  <div class="region__preview" id="men">
    <h1>MEN</h1>
    <ul class="list list__inline">
      <li><a title="Accrington Observer" href="http://www.accringtonobserver.co.uk/" target="_blank"><img class="alignnone  wp-image-89" alt="accrington_ob" src="http://localhost/digitalhub/content/uploads/2014/01/accrington_ob.jpg" /></a></li>
      <li><a title="Macclesfield Express" href="http://www.macclesfield-express.co.uk/"><img class="alignnone size-full wp-image-125" alt="macc_express" src="http://localhost/digitalhub/content/uploads/2014/01/macc_express.jpg" /></a></li>
      <li><a title="Manchester Evening News" href="http://www.manchestereveningnews.co.uk/" target="_blank"><img class="alignnone size-full wp-image-126" alt="MEN" src="http://localhost/digitalhub/content/uploads/2014/01/MEN.jpg" /></a></li>
      <li><a title="Huddersfield Examiner" href="http://www.examiner.co.uk/" target="_blank"><img class="alignnone size-full wp-image-122" alt="hudder_examiner" src="http://localhost/digitalhub/content/uploads/2014/01/hudder_examiner.jpg" /></a></li>
      <li><a title="Rossendale Free Press" href="http://www.rossendalefreepress.co.uk/" target="_blank"><img class="alignnone size-full wp-image-129" alt="rossendale_fp" src="http://localhost/digitalhub/content/uploads/2014/01/rossendale_fp.jpg" /></a></li>
    </ul>
  </div>
  <div class="region__preview" id="northeast">
    <h1>Northeast</h1>
    <ul class="list list__inline">
      <li><a title="Gazette Live" href="http://www.gazettelive.co.uk/" target="_blank"><img class="alignnone size-full wp-image-115" alt="gazzette_live" src="http://localhost/digitalhub/content/uploads/2014/01/gazzette_live.jpg" /></a></li>
      <li><a title="The Journal" href="http://www.thejournal.co.uk/" target="_blank"><img class="alignnone size-full wp-image-132" alt="thejounal" src="http://localhost/digitalhub/content/uploads/2014/01/thejounal.jpg" /></a></li>
    </ul>
  </div>
  <div class="region__preview" id="wales">
    <h1>Wales</h1>
    <ul class="list list__inline">
      <li><a title="Daily Post" href="http://www.dailypost.co.uk/" target="_blank"><img class="alignnone size-full wp-image-113" alt="dailypost" src="http://localhost/digitalhub/content/uploads/2014/01/dailypost.jpg" /></a></li>
      <li><a title="Wales Online" href="http://www.walesonline.co.uk/" target="_blank"><img class="alignnone size-full wp-image-133" alt="walesonline" src="http://localhost/digitalhub/content/uploads/2014/01/walesonline.jpg" /></a></li>
    </ul>
  </div>
</section>
</article>
</main>
<!-- #main -->
</div>
<!-- #primary -->

</div>
<!--/ wrapper_sub  -->

<?php get_footer(); ?>
