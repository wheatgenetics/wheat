<?php
/**
 * Wheat Theme Customizer
 *
 * @package Wheat
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wheat_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'wheat_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'wheat_customize_partial_blogdescription',
		) );
	}

	$wp_customize->add_section( 'wheat_colors' , array(
		'title'      => 'Wheat Colors',
		'priority'   => 1000,
	) );

	/* Primary color (header background, sponsors background, accents, etc. */
	$wp_customize->add_setting( 'wheat_primary_color' , array(
		'default'     => '#472979',
		'transport'   => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wheat_primary_color', array(
		'label'        => 'Primary Color (header background, sponsors background, accents, etc.)',
		'section'    => 'wheat_colors',
		'settings'   => 'wheat_primary_color',
	) ) );

	/* Secondary color (footer background, secondary button background, homepage intro box background, etc.) */
	$wp_customize->add_setting( 'wheat_secondary_color' , array(
		'default'     => '#333333',
		'transport'   => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wheat_secondary_color', array(
		'label'        => 'Secondary color (footer background, secondary button background, homepage intro box background, etc.)',
		'section'    => 'wheat_colors',
		'settings'   => 'wheat_secondary_color',
	) ) );
}
add_action( 'customize_register', 'wheat_customize_register' );

function wheat_customizer_css() {
?>
	<style type="text/css">
		.site-footer { background-color: <?php echo get_theme_mod('wheat_secondary_color', '#dfa345'); ?>; }
		#sponsors { background-color: <?php echo get_theme_mod('wheat_primary_color', '#472979'); ?>; }
		#home-page-intro-box { background-color: <?php echo get_theme_mod('wheat_secondary_color', '#472979'); ?>; }
	</style>
<?php
}
add_action( 'wp_head', 'wheat_customizer_css');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function wheat_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function wheat_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wheat_customize_preview_js() {
	wp_enqueue_script( 'wheat-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'wheat_customize_preview_js' );
