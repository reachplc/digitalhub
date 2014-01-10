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
		<header class="header__main nav-main__header cf" id="masthead" role="banner">
			<div class="wrapper">
			<div class="site-branding">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="/content/themes/digitalhub/images/logo.png"></a></h1>
				<button id="js-nav-button">Navicon</button>
			</div>


	</header><!-- #s-header -->

	<div id="content" class="site-content nav-main__content">
