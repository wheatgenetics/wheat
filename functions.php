<?php
/**
 * Wheat functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Wheat
 */

if ( ! function_exists( 'wheat_setup' ) ) :
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   */
  function wheat_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on Wheat, use a find and replace
     * to change 'wheat' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'wheat', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
      'menu-1' => esc_html__( 'Primary', 'wheat' ),
      'social' => esc_html__( 'Social Media Menu', 'wheat' ),
      'social-footer' => esc_html__( 'Social Media Menu Footer', 'wheat' ),
      'other-sites' => esc_html__( 'Other Sites Menu', 'wheat' ),
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
    ) );

    // Set up the WordPress core custom background feature.
    add_theme_support( 'custom-background', apply_filters( 'wheat_custom_background_args', array(
      'default-color' => 'ffffff',
      'default-image' => '',
    ) ) );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support( 'custom-logo', array(
      'height'      => 90,
      'width'       => 90,
      'flex-width'  => true,
      'flex-height' => true,
    ) );
  }
endif;
add_action( 'after_setup_theme', 'wheat_setup' );

/**
 * Register custom fonts.
 */
function wheat_fonts_url() {
  $fonts_url = '';

  /*
    * Translators: If there are characters in your language that are not
    * supported by Libre Baskerville and Raleway, translate this to 'off'. Do not translate
    * into your own language.
    */
  $libre_baskerville = _x( 'on', 'Libre Baskerville font: on or off', 'wheat' );
  $raleway = _x( 'on', 'Raleway font: on or off', 'wheat' );

  $font_families = array();
    if ( 'off' !== $libre_baskerville ) {
      $font_families[] = 'Libre Baskerville:400,400i,700';
  }

  if ( 'off' !== $raleway ) {
    $font_families[] = 'Raleway:400,400i,600,600i,700,300';
  }

  if ( in_array( 'on', array($libre_baskerville, $raleway) ) ) {
    $query_args = array(
      'family' => urlencode( implode( '|', $font_families ) ),
      'subset' => urlencode( 'latin,latin-ext' ),
    );

    $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
  }

  return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function wheat_resource_hints( $urls, $relation_type ) {
  if ( wp_style_is( 'wheat-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
    $urls[] = array(
      'href' => 'https://fonts.gstatic.com',
      'crossorigin',
    );
  }

  return $urls;
}
add_filter( 'wp_resource_hints', 'wheat_resource_hints', 10, 2 );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wheat_content_width() {
  // This variable is intended to be overruled from themes.
  // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
  // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
  $GLOBALS['content_width'] = apply_filters( 'wheat_content_width', 640 );
}
add_action( 'after_setup_theme', 'wheat_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wheat_widgets_init() {
  register_sidebar( array(
    'name'          => esc_html__( 'Sidebar', 'wheat' ),
    'id'            => 'sidebar-1',
    'description'   => esc_html__( 'Add widgets here.', 'wheat' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );
}
add_action( 'widgets_init', 'wheat_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wheat_scripts() {
  // Enqueue Google Fonts: Raleway and Libre Baskerville
  wp_enqueue_style( 'wheat-fonts', wheat_fonts_url() );
  
  wp_enqueue_style( 'wheat-style', get_stylesheet_uri() );
  wp_enqueue_style( 'mobile-menu', get_template_directory_uri() . '/mobile-menu.css' );

  wp_enqueue_script( 'wheat-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
  // wp_localize_script( 'wheat-navigation', 'wheatScreenReaderText', array(
  // 	'expand' => __('Expand child menu', 'wheat'),
  // 	'collapse' => __('Collapse child menu', 'wheat'),
    
  // ) );
  wp_enqueue_script( 'wheat-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
  wp_enqueue_script( 'underline-current-project', get_template_directory_uri() . '/js/underline-current-project.js', array('jquery'), '20151215', true );

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', 'wheat_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
  require get_template_directory() . '/inc/jetpack.php';
}

/**
 * This is to set up the ACF bidirectional relationship between the Artist and Exhibition, and between the Press Release and Exhibition custom post types.
 * The code was taken from here: https://www.advancedcustomfields.com/resources/bidirectional-relationships/
 */
function bidirectional_acf_update_value( $value, $post_id, $field  ) {
  // vars
  $field_name = $field['name'];
  $field_key = $field['key'];
  $global_name = 'is_updating_' . $field_name;
  
  // bail early if this filter was triggered from the update_field() function called within the loop below
  // - this prevents an inifinte loop
  if( !empty($GLOBALS[ $global_name ]) ) return $value;
  // set global variable to avoid inifite loop
  // - could also remove_filter() then add_filter() again, but this is simpler
  $GLOBALS[ $global_name ] = 1;
  
  // loop over selected posts and add this $post_id
  if( is_array($value) ) {
    foreach( $value as $post_id2 ) {
      // load existing related posts
      $value2 = get_field($field_name, $post_id2, false);
      // allow for selected posts to not contain a value
      if( empty($value2) ) {	
        $value2 = array();
      }
      
      // bail early if the current $post_id is already found in selected post's $value2
      if( in_array($post_id, $value2) ) continue;
    
      // append the current $post_id to the selected post's 'related_posts' value
      $value2[] = $post_id;	
    
      // update the selected post's value (use field's key for performance)
      update_field($field_key, $value2, $post_id2);
    }
  }
  
  // find posts which have been removed
  $old_value = get_field($field_name, $post_id, false);
  
  if( is_array($old_value) ) {	
    foreach( $old_value as $post_id2 ) {
      // bail early if this value has not been removed
      if( is_array($value) && in_array($post_id2, $value) ) continue;
      
      // load existing related posts
      $value2 = get_field($field_name, $post_id2, false);
      
      // bail early if no value
      if( empty($value2) ) continue;
      
      // find the position of $post_id within $value2 so we can remove it
      $pos = array_search($post_id, $value2);
      
      // remove
      unset( $value2[ $pos] );
      
      // update the un-selected post's value (use field's key for performance)
      update_field($field_key, $value2, $post_id2);
    }
  }
  
  // reset global varibale to allow this filter to function as per normal
  $GLOBALS[ $global_name ] = 0;
  
  // return
    return $value;
}
add_filter('acf/update_value/name=projects_research_areas', 'bidirectional_acf_update_value', 10, 3);



/**
 * Add a class of current-archive to the current archive's link when on that page.
 */ 
function example_get_archives_link($link_html) {
  if (is_day() || is_month() || is_year()) {
    if (is_day()) {
      $data = get_the_time('Y/m/d');
    } elseif (is_month()) {
      $data = get_the_time('Y/m');
    } elseif (is_year()) {
      $data = get_the_time('Y');
    }

    // Link to archive page
    $link = home_url($data);

    // Check if the link is in string
    $strpos = strpos($link_html, $link);

    // Add class if link has been found
    if ($strpos !== false) {
      $link_html = str_replace('<li>', '<li class="current-archive">', $link_html);
    }
  }

  return $link_html;
}
add_filter("get_archives_link", "example_get_archives_link");