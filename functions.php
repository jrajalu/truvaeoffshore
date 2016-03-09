<?php
/**
 * @package myxon
 * @since 1.0
 */

add_action( 'admin_enqueue_scripts', 'chrome_fix' );
function chrome_fix() {
  if ( strpos( $_SERVER['HTTP_USER_AGENT'], 'Chrome' ) !== false )
    wp_add_inline_style( 'wp-admin', '#adminmenu { transform: translateZ(0); }' );
}

add_action( 'login_head', 'add_favicon' );
add_action( 'admin_head', 'add_favicon' );
add_action( 'wp_head', 'add_favicon' );

  function add_favicon() {
    $favicon = get_stylesheet_directory_uri() . '/favicon.ico';
    echo '<link rel="shortcut icon" href="' . $favicon . '" />';
  }

add_action( 'after_setup_theme', 'truvae_setup' );

  function truvae_setup() {
    
    add_theme_support( 'title-tag' );

    add_theme_support( 'html5', array( 'search-form' ) );
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 145, 145, true );
   
    remove_action( 'wp_head', 'wp_generator' );
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    
    load_theme_textdomain( 'myxon', get_template_directory() . '/lang' );

    add_theme_support( 'custom-header', array(
      'width'         => 319.953,
      'height'        => 90,
      'default-image' => get_template_directory_uri() . '/images/logo.svg',
      'uploads'       => true,
      'header-text'   => false,
      )
    );

    add_filter( 'show_admin_bar', '__return_false' );
    
    register_nav_menus( array(
      'main-navigation'   => __( 'Main Navigation', 'myxon' ),
    ) );
    
  }

add_action( 'wp_enqueue_scripts', 'truvae_scripts' );

  function truvae_scripts() {
    // javascripts
    wp_deregister_script( 'jquery' );
    wp_enqueue_script( 'jquery', get_template_directory_uri() . '/lib/jquery/jquery.min.js', array(), '2.1.4', false );
    wp_enqueue_script( 'uikit', get_template_directory_uri() . '/lib/uikit/js/uikit.min.js', array(), '2.20.3', true );
    wp_enqueue_script( 'uikit-slider', get_template_directory_uri() . '/lib/uikit/js/components/slider.min.js', array(), '2.20.3', true );
    wp_enqueue_script( 'uikit-slideshow', get_template_directory_uri() . '/lib/uikit/js/components/slideshow.min.js', array(), '2.20.3', true );
    wp_enqueue_script( 'uikit-slideset', get_template_directory_uri() . '/lib/uikit/js/components/slideset.min.js', array(), '2.20.3', true );
    wp_enqueue_script( 'uikit-lightbox', get_template_directory_uri() . '/lib/uikit/js/components/lightbox.min.js', array(), '2.20.3', true );
    wp_enqueue_script( 'uikit-search', get_template_directory_uri() . '/lib/uikit/js/components/search.min.js', array(), '2.20.3', true );
    wp_enqueue_script( 'uikit-tooltip', get_template_directory_uri() . '/lib/uikit/js/components/tooltip.min.js', array(), '2.20.3', true );
    wp_enqueue_script( 'fitvidsjs', get_template_directory_uri() . '/lib/fitvids/jquery.fitvids.js', array(), '1.1.0', true );
    wp_enqueue_script( 'theme', get_template_directory_uri() . '/js/dist/scripts.min.js', array(), '6.7', true );
    // stylesheet
    wp_enqueue_style( 'uikit', get_template_directory_uri() . '/lib/uikit/css/uikit.almost-flat.min.css', false, '2.20.3' );
    wp_enqueue_style( 'uikit-slider', get_template_directory_uri() . '/lib/uikit/css/components/slider.almost-flat.min.css', false, '2.20.3' );
    wp_enqueue_style( 'uikit-slideshow', get_template_directory_uri() . '/lib/uikit/css/components/slideshow.almost-flat.min.css', false, '2.20.3' );
    wp_enqueue_style( 'uikit-slidenav', get_template_directory_uri() . '/lib/uikit/css/components/slidenav.almost-flat.min.css', false, '2.20.3' );
    wp_enqueue_style( 'uikit-search', get_template_directory_uri() . '/lib/uikit/css/components/search.almost-flat.min.css', false, '2.20.3' );
    wp_enqueue_style( 'uikit-tooltip', get_template_directory_uri() . '/lib/uikit/css/components/tooltip.almost-flat.min.css', false, '2.20.3' );
    wp_enqueue_style( 'style', get_stylesheet_uri(), false, '8.0' );
  }

add_action( 'after_setup_theme', 'truvae_files' );

  function truvae_files() {
    
    require( get_template_directory() . '/inc/theme-cpt.php' );
    require( get_template_directory() . '/inc/theme-metabox.php' );
    require( get_template_directory() . '/inc/theme-navigation.php' );
    
    require( get_template_directory() . '/inc/theme-update.php' );
      new ThemeUpdateChecker(
        'truvaeoffshore-master',
        'https://raw.githubusercontent.com/jrajalu/truvaeoffshore/master/package.json'
      );
      
    require( get_template_directory() . '/inc/theme-login.php' );
    
    //require( get_template_directory() . '/inc/widget-follow-us.php' );
     
  }

// WIDGETS
  
add_action( 'widgets_init', 'truvae_widgets_init' );

  function truvae_widgets_init() {

    register_sidebar( array(
      'name'            => __( 'Page Sidebar', 'myxon' ),
      'id'              => 'sidebar-1',
      'description'     => __( 'Appears when using the optional page', 'myxon' ),
      'before_widget'   => '<aside class="arrow-box">',
      'after_widget'    => '</aside>',
      'before_title'    => '<h3 class="widget-title">',
      'after_title'     => '</h3>',
    ) );

    register_sidebar( array(
      'name'            => __( 'Frontpage: Left', 'myxon' ),
      'id'              => 'sidebar-2',
      'description'     => __( 'Appears when using the optional Front Page', 'myxon' ),
      'before_widget'   => '<aside class="col-8-12 widget-left front-widget">',
      'after_widget'    => '</aside>',
      'before_title'    => '<h2 class="widget-title">',
      'after_title'     => '</h2>',
    ) );
    
    register_sidebar( array(
      'name'            => __( 'Frontpage: Right', 'myxon' ),
      'id'              => 'sidebar-3',
      'description'     => __( 'Appears when using the optional Front Page', 'myxon' ),
      'before_widget'   => '<aside class="col-4-12 widget-right front-widget">',
      'after_widget'    => '</aside>',
      'before_title'    => '<h2 class="widget-title">',
      'after_title'     => '</h2>',
    ) );
  }

// SEARCH

add_filter( 'get_search_form', 'truvae_search_form' );

  function truvae_search_form( $form ) {
    $form = '<form role="search" method="get" class="uk-form" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
    <input type="search" class="search-field" placeholder="' . esc_attr__( 'Search...', 'myxon' ) . '" value="' . get_search_query() . '" name="s" id="s" />
    <button class="search-submit uk-button" id="searchsubmit">'. esc_attr__( 'Search' ) .'</button>
    </form>';

    return $form;
  }
  