<?php
/**
 * Malik functions and definitions
 *
 * @package Malik
 */

if ( ! function_exists( 'malik_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function malik_setup() {
		/*
		 * Make theme available for translation.
		 */
		load_theme_textdomain( 'malik', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'primary'   => esc_html__( 'Primary', 'malik' ),
			'secondary' => esc_html__( 'Secondary', 'malik' ),
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
		add_theme_support( 'custom-background', apply_filters( 'malik_custom_background_args', array(
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
			'height'      => 80,
			'width'       => 240,
			'flex-width'  => true,
			'flex-height' => true,
			'header-text' => array(
				'site-title',
				'site-description',
			),
		) );

		/**
		 * Add support for Gutenberg wide images.
		 */
		remove_theme_support( 'custom-header' );

		/**
		 * Add support for Gutenberg editor color palette.
		 *
		 * @link https://wordpress.org/gutenberg/
		 */
		add_theme_support( 'editor-color-palette',
			array(
				'name'  => 'Ivory Black',
				'color' => '#1D2731',
			),
			array(
				'name'  => 'Prussian Blue',
				'color' => '#0B3C5D',
			),
			array(
				'name'  => 'Sky Blue',
				'color' => '#328CC1',
			),
			array(
				'name'  => 'Gold Leaf',
				'color' => '#D6BB53',
			),
			array(
				'name'  => 'Carbon Grey',
				'color' => '#808182',
			),
			array(
				'name'  => 'Watermelon Red',
				'color' => '#EF5656',
			)
		);

		/**
		 * Add support for Gutenberg wide images.
		 */
		add_theme_support( 'align-wide' );

	}
endif;
add_action( 'after_setup_theme', 'malik_setup', 20 );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function malik_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'malik_content_width', 640 );
}
add_action( 'after_setup_theme', 'malik_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function malik_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Header Right', 'malik' ),
		'id'            => 'header-right',
		'description'   => esc_html__( 'Displays in the header, to the right of the site title.', 'malik' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'malik' ),
		'id'            => 'footer',
		'description'   => esc_html__( 'Displays in the footer, below the footer menu.', 'malik' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'malik_widgets_init' );

/**
 * Google Fonts
 */
function malik_fonts_url() {
	$fonts_url = '';
	/**
	* Translators: If there are characters in your language that are not
	* supported by Google Fonts, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$font = _x( 'on', 'Theme Google Fonts: on or off', 'malik' );
	if ( 'off' !== $font ) {
		$font_families = array();
		// Get the selected theme fonts or default to Playfair and Lato.
		$font_selection = get_theme_mod( 'font_pairing', 'playfair_lato' );
		if ( 'playfair_lato' === $font_selection ) {
			$font_families[] = 'Playfair Display:400,700';
			$font_families[] = 'Lato:400,400i,700';
		} elseif ( 'opensans_gentiumbasic' === $font_selection ) {
			$font_families[] = 'Open Sans:400,700';
			$font_families[] = 'Gentium Basic:400,400i,700';
		} elseif ( 'archivoblack_tenorsans' === $font_selection ) {
			$font_families[] = 'Archivo Black:400';
			$font_families[] = 'Tenor Sans:400';
		} elseif ( 'rubik_robotomono' === $font_selection ) {
			$font_families[] = 'Rubik:400,700';
			$font_families[] = 'Roboto Mono:400,400i,700';
		} elseif ( 'ovo_muli' === $font_selection ) {
			$font_families[] = 'Ovo:400';
			$font_families[] = 'Muli:400,400i,700';
		} elseif ( 'opensanscondensed_lora' === $font_selection ) {
			$font_families[] = 'Open Sans Condensed:300,700';
			$font_families[] = 'Lora:400,400i,700';
		} elseif ( 'nixieone_librebaskerville' === $font_selection ) {
			$font_families[] = 'Nixie One:400';
			$font_families[] = 'Libre Baskerville:400,400i,700';
		} else {
			$font_families[] = 'Playfair Display:400,700';
			$font_families[] = 'Lato:400,400i,700';
		}
		$query_args = array(
			'family' => rawurlencode( implode( '|', $font_families ) ),
			'subset' => rawurlencode( 'latin,latin-ext' ),
		);
		$fonts_url  = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}
	return esc_url_raw( $fonts_url );
}

/**
 * Gutenberg Editor Styles
 */
function malik_editor_styles() {
	// Fonts.
	wp_enqueue_style( 'malik-fonts', malik_fonts_url(), array(), null );
	// Editor styles.
	wp_enqueue_style( 'malik-editor-style', get_template_directory_uri() . '/css/editor-style.css' );
}
add_action( 'enqueue_block_editor_assets', 'malik_editor_styles' );

/**
 * Enqueue scripts and styles.
 */
function malik_scripts() {
	// Fonts.
	wp_enqueue_style( 'malik-fonts', malik_fonts_url(), array(), null );

	// Font Awesome http://fontawesome.com.
	wp_enqueue_script( 'fontawesome5', get_stylesheet_directory_uri() . '/js/fontawesome-all.min.js', array(), '5.0.9', false );

	// Primary Styles.
	wp_enqueue_style( 'malik-style', get_stylesheet_uri(), array( 'malik-fonts' ) );

	// Thread comments.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Scripts for the Malik theme.
	wp_enqueue_script( 'malik-scripts', get_template_directory_uri() . '/js/malik.js', array( 'jquery' ), '20180329', true );

	// Pass theme mods to Malik scripts.
	$malik_options = array(
		'header_location'  => get_theme_mod( 'header_location', 'top' ),
		'night_mode'       => get_theme_mod( 'night_mode', true ),
		'hide_header'      => get_theme_mod( 'hide_header', true ),
		'hide_header_menu' => get_theme_mod( 'hide_header_menu', true ),
		'read_time'        => get_theme_mod( 'read_time', true ),
		'progression_bar'  => get_theme_mod( 'progression_bar', true ),
		'link_color'       => get_theme_mod( 'link_color', '328CC1' ),
	);
	wp_localize_script( 'malik-scripts', 'malik_options', $malik_options );

}
add_action( 'wp_enqueue_scripts', 'malik_scripts' );

// setup FontAwesome 5 SVGs for use.
add_action( 'wp_head', function() {
	echo '<script>FontAwesomeConfig = { searchPseudoElements: true };</script>';
}, 1 );


/**
 * Defer loading of scripts.
 *
 * @param string $tag The tag of the source for the script.
 * @param string $handle The handle of the script to check.
 *
 * @return string $tag The call to the script.
 */
function malik_defer_scripts( $tag, $handle ) {

	// The handles of the enqueued scripts we want to defer.
	$defer_scripts = array(
		'comment-reply',
		'fontawesome5',
	);

	foreach ( $defer_scripts as $defer_script ) {
		if ( $handle === $defer_script ) {
			return str_replace( ' src', ' defer="defer" src', $tag );
		}
	}

	return $tag;
}
add_filter( 'script_loader_tag', 'malik_defer_scripts', 10, 2 );

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
 * Shortcodes included in the theme.
 */
require get_template_directory() . '/inc/template-shortcodes.php';

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

