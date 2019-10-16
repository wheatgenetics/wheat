<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Wheat
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<?php 
$object = get_queried_object();
$backgroundImage = get_field('background_image', $object->name);
if (!empty($backgroundImage)) {
	$backgroundImageUrl = $backgroundImage['url'];
}            
?>

<body <?php body_class(); ?>>

<input type="checkbox" id="menuToggler" class="input-toggler" />
<label for="menuToggler" class="menu-toggler">
	<span class="menu-toggler__line"></span>
	<span class="menu-toggler__line"></span>
	<span class="menu-toggler__line"></span>
</label>

<aside class="sidebar">
	<ul class="menu">
		<li class="menu__item"><a class="menu__link current" href=".">Home</a></li>
		<li class="menu__item"><a class="menu__link" href="./people/">People</a></li>
		<li class="menu__item"><a class="menu__link" href="./projects/">Projects</a></li>
		<li class="menu__item"><a class="menu__link" href="./publications/">Publications</a></li>
		<li class="menu__item"><a class="menu__link" href="./news/">News</a></li>
		<li class="menu__item"><a class="menu__link" href="./resources/">Resources</a></li>
	</ul>
</aside>
	
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wheat' ); ?></a>

	<header id="masthead" class="site-header" style="background-image:url(<?php if (!empty($backgroundImageUrl)) { echo $backgroundImageUrl; } ?>)">
		<div class="container">
			<div class="site-branding">
				<?php the_custom_logo(); ?>
				<div class="site-branding__text">
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
					endif;
					$wheat_description = get_bloginfo( 'description', 'display' );
					if ( $wheat_description || is_customize_preview() ) :
					?>
						<p class="site-description"><?php echo $wheat_description; /* WPCS: xss ok. */ ?></p>
					<?php endif; ?>
				</div><!-- .site-branding__text -->
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				) );
				?>
			</nav><!-- #site-navigation -->

			<nav class="social-menu">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'social'
				) );
				?>
			</nav>

			<div id="banner-text">
				<?php the_field('banner_text'); ?>
			</div>
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
