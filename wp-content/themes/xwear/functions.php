<?php
/**
 * xwear functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package xwear
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}


function xwear_setup() {

	load_theme_textdomain( 'xwear', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'xwear' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'xwear_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'xwear_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function xwear_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'xwear_content_width', 640 );
}
add_action( 'after_setup_theme', 'xwear_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function xwear_widgets_init() {
	/*
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'xwear' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'xwear' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	*/
}
add_action( 'widgets_init', 'xwear_widgets_init' );


/**
 * Functions which enhance the theme by hooking into WordPress.
 */

require get_template_directory() . '/inc/template-functions.php';


/**
 * Enqueue scripts and styles.
 */

function xwear_scripts() {
	wp_enqueue_style( 'xwear-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'xwear-core-css', get_template_directory_uri() . '/css/core.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'xwear-edit-code', get_template_directory_uri() . '/css/edit-code.css', array(), _S_VERSION );
	wp_enqueue_style( 'xwear-counter', get_template_directory_uri() . '/css/counter.css', array(), _S_VERSION );

	wp_enqueue_script( 'xwear-core-js', get_template_directory_uri() . '/js/core.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'xwear-edit-js', get_template_directory_uri() . '/js/edit.js', array(), _S_VERSION, true );


	$prices = get_filtered_price();
	$localized_data = [
		'min' => $prices['min'],
		'max' => $prices['max']
	];	
	wp_localize_script('xwear-core-js', 'rangePrices', $localized_data);

	wp_enqueue_script( 'xwear-counter', get_template_directory_uri() . '/js/counter.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'xwear-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), _S_VERSION, true );

	if(is_shop()) {
		wp_enqueue_script( 'xwear-shop-filter', get_template_directory_uri() . '/js/shop-filter-ajax.js', array('jquery'), _S_VERSION, true );
		wp_enqueue_script( 'xwear-shop-sorting', get_template_directory_uri() . '/js/shop-sorting.js', array('jquery'), _S_VERSION, true );
	}

	if(is_product()) {
		wp_enqueue_script( 'xwear-single-product-attributes', get_template_directory_uri() . '/js/single-product-attributes.js', array('jquery', 'wc-add-to-cart-variation'), _S_VERSION, true );
	}

	if(is_cart()) {
		wp_enqueue_script( 'xwear-cart-subtotals', get_template_directory_uri() . '/js/cart-subtotals.js', array('jquery'), _S_VERSION, true );
	}


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'xwear_scripts', 100);

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


if( in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) ) {
	// Add Theme support WooCommerce
	function xwear_add_woocommerce_support() {
		add_theme_support( 'woocommerce' );
	}
	add_action( 'after_setup_theme', 'xwear_add_woocommerce_support' );

	require get_template_directory() . '/inc/woocommerce.php';
}

/*
*	Shop filter action	
*/
require get_template_directory() . '/inc/shop-filter-handler.php';

add_action( 'wp_ajax_shop_filter', 'xwear_shop_filter_handler');
add_action( 'wp_ajax_nopriv_shop_filter', 'xwear_shop_filter_handler');

/*
*	Cart subtotals actions
*/

