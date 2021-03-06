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

  /* Primary color (header background, sponsors background, homepage intro box background, accents, etc. */
  $wp_customize->add_setting( 'wheat_primary_color' , array(
    'default'     => '#472979',
    'transport'   => 'refresh',
  ) );

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wheat_primary_color', array(
    'label'      => 'Primary Color (header background, sponsors background, homepage intro box background, accents, etc.)',
    'section'    => 'wheat_colors',
    'settings'   => 'wheat_primary_color',
  ) ) );

  /* Secondary color (footer background, secondary button background, etc.) */
  $wp_customize->add_setting( 'wheat_secondary_color' , array(
    'default'     => '#333333',
    'transport'   => 'refresh',
  ) );

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wheat_secondary_color', array(
    'label'      => 'Secondary Color (footer background, secondary button background, etc.)',
    'section'    => 'wheat_colors',
    'settings'   => 'wheat_secondary_color',
  ) ) );

  /* Link color */
  $wp_customize->add_setting( 'link_color' , array(
    'default'     => 'royalblue',
    'transport'   => 'refresh',
  ) );

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
    'label'      => 'Link Color',
    'section'    => 'wheat_colors',
    'settings'   => 'link_color',
  ) ) );

  /* Main menu link color */
  $wp_customize->add_setting( 'wheat_main_menu_link_color' , array(
    'default'     => '#c1bcbc',
    'transport'   => 'refresh',
  ) );

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wheat_main_menu_link_color', array(
    'label'      => 'Main Menu Link Color',
    'section'    => 'wheat_colors',
    'settings'   => 'wheat_main_menu_link_color',
  ) ) );

  /* Main menu link hover color */
  $wp_customize->add_setting( 'wheat_main_menu_link_color_hover' , array(
    'default'     => '#80b567',
    'transport'   => 'refresh',
  ) );

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wheat_main_menu_link_color_hover', array(
    'label'      => 'Main Menu Link Hover Color',
    'section'    => 'wheat_colors',
    'settings'   => 'wheat_main_menu_link_color_hover',
  ) ) );

  /* Main menu link underline color */
  $wp_customize->add_setting( 'wheat_main_menu_link_underline_color' , array(
    'default'     => '#FDC345',
    'transport'   => 'refresh',
  ) );

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wheat_main_menu_link_underline_color', array(
    'label'      => 'Main Menu Link Underline Color',
    'section'    => 'wheat_colors',
    'settings'   => 'wheat_main_menu_link_underline_color',
  ) ) );

  /* Button color */
  $wp_customize->add_setting( 'wheat_button_color' , array(
    'default'     => '#333333',
    'transport'   => 'refresh',
  ) );

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wheat_button_color', array(
    'label'      => 'Button Color',
    'section'    => 'wheat_colors',
    'settings'   => 'wheat_button_color',
  ) ) );
}
add_action( 'customize_register', 'wheat_customize_register' );

function wheat_customizer_css() {
?>
  <style type="text/css">
    a {
      color: <?php echo get_theme_mod('link_color', 'royalblue'); ?>;
    }

    #sponsors,
    #home-page-intro-box,
    #research-areas .research-box,
    .site-header .social-menu,
    .purple-background,
    .wp-caption .wp-caption-text,
    .wppsac-post-carousel.design-1 a.wppsac-readmorebtn,
    .wppsac-post-carousel.design-1 a.wppsac-readmorebtn:hover {
      background-color: <?php echo get_theme_mod('wheat_primary_color', '#472979'); ?>;
    }

    .wppsac-post-carousel.design-1 .slick-arrow, .wppsac-post-carousel.design-1 .slick-arrow:hover {
      background-color: <?php echo get_theme_mod('wheat_primary_color', '#472979'); ?> !important;
    }

    .recent-post-carousel.design-1 a.readmorebtn,
    .recent-post-carousel.design-1 a.readmorebtn:hover,
    .recent-post-carousel.design-1 a.readmorebtn:focus,
    .recent-post-carousel.design-1 .slick-arrow,
    .recent-post-carousel.design-1 .slick-arrow:hover,
    .recent-post-carousel.design-1 .slick-arrow:focus {
      background-color: <?php echo get_theme_mod('wheat_primary_color', '#472979'); ?> !important;
    }

    @media screen and (min-width: 900px) {
      body:not(.home) .main-menu-wrapper {
        background-color: <?php echo get_theme_mod('wheat_primary_color', '#472979'); ?>;
      }
    }

    .site-content .entry-content h3,
    h3.entry-title,
    h3.entry-title a,
    h4.entry-title,
    #page-title,
    .team-title,
    .widget h2.widget-title,
    blockquote,
    blockquote p,
    .wp-block-quote.is-large,
    .wp-block-quote.is-style-large,
    .purple {
      color: <?php echo get_theme_mod('wheat_primary_color', '#472979'); ?>;
    }

    .site-footer {
      background-color: <?php echo get_theme_mod('wheat_secondary_color', '#333333'); ?>;
    }

    .main-navigation a {
      color: <?php echo get_theme_mod('wheat_main_menu_link_color', '#c1bcbc'); ?>;
    }

    body:not(.home) .main-navigation ul li a:hover {
      color: <?php echo get_theme_mod('wheat_main_menu_link_color_hover', '#80b567'); ?>;
    }

    .main-navigation .menu-main-menu-container>ul>li.current-menu-item>a:before,
      .main-navigation ul li.current-menu-parent>a:before {
      border-bottom: 1px solid <?php echo get_theme_mod('wheat_main_menu_link_underline_color', '#FDC345'); ?>;
    }

    .wp-block-button__link, a.button {
      background-color: <?php echo get_theme_mod('wheat_button_color', '#333333'); ?>;
    }

    .site-footer .footer-box .fab, .site-footer .footer-box a:hover {
      color: <?php echo get_theme_mod('wheat_main_menu_link_color_hover', '#80b567'); ?>;
    }
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
