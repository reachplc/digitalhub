<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package DigitalHub
 */
?>
<!DOCTYPE html>

<!--[if IE 8]>    <html class="lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico">
<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/images/speeddial-160x160.png">
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-touch-icon-152x152-precomposed.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-touch-icon-120x120-precomposed.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-touch-icon-76x76-precomposed.png">
  <link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-touch-icon-60x60-precomposed.png">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'digitalhub' ); ?></a>

		<?php do_action( 'before' ); ?>
		<div class="hero">
		<header class="header__main cf" id="masthead" role="banner">
			<div class="wrapper">
				<div id="search-slide">
					<form action="<?php echo home_url( '/' ); ?>" method="get">
					<div id="search-left"><input id="s" class="text" type="text" name="s" placeholder="Search" />
					<input class="submit button" type="submit" name="submit" value=""/>
					</div>
				</form>
				<div id="search-close">x</div>
				</div>
			<div class="site-branding">
				<div class="wrapper__sub">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><h1 class="site-title sprite"></h1>
				</a>
				<button class="search"></button>
				<div id="search">
					<form id="searchform" action="<?php echo home_url( '/' ); ?>" method="get">
					<div><input id="s" class="text" type="text" name="s" placeholder="Search" />
					<input class="submit button" type="submit" name="submit" value=""/>
					</div>
				</div>
				</div>
				</form>

			</div><!-- end of site-branding-->


	</header><!-- #s-header -->
	<div id="titles">
	<h1 class="mega title--main slide delay-05">Trinity Mirror Digital Hub</h1><br />
	<h2 class="kilo title--secondary slide delay-08">Inspiring advertising to maximise impact</h2>
</div>
	<div class="strip">
		<?php wp_nav_menu( array( 'theme_location' => 'secondary-menu', 'menu_class' => 'secondary-menu') ); ?>
	</div>
	</div>
</div><!-- end of #bgimg -->

	<div id="content" class="site-content">
