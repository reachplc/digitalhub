<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package DigitalHub
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	
	<nav id="js-nav" class="nav-main nav-main__nav" role="navigation">
		<h1 class="menu-toggle"><?php _e( 'Menu', 'digitalhub' ); ?></h1>
		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'digitalhub' ); ?></a>

		<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
	</nav><!-- #site-navigation -->



		<?php do_action( 'before' ); ?>
		<div id="bgimg">
		<header class="header__main nav-main__header cf" id="masthead" role="banner">
			<div class="wrapper">
			<div class="site-branding">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"></a></h1>
				<button id="js-nav-button">Menu</button>
				<a href="http://www.facebook.com"><div id="facebook"></div></a>
				<a href="http://www.twitter.com"><div id="twitter"></div></a>
				<div id="search">
					<form id="searchform" action="?php bloginfo('url'); ?" method="get">
					<div><input id="s" class="text" type="text" name="s" placeholder="Search" />
					<input class="submit button" type="submit" name="submit" value=""/>
					</div>
				</div>
				</form>
			
			</div><!-- end of site-branding-->


	</header><!-- #s-header -->
	<div id="strip"></div>
</div><!-- end of #bgimg -->

	<div id="content" class="site-content nav-main__content">
