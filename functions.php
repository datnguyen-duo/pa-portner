<?php

if ( ! function_exists( 'site_setup' ) ) :
	function site_setup() {
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );

		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Header', 'portner' ),
				'menu-2' => esc_html__( 'Footer - Navigation', 'portner' ),
				'menu-3' => esc_html__( 'Footer - Social Media', 'portner' ),
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
	}
endif;
add_action( 'after_setup_theme', 'site_setup' );

function site_scripts() {
	wp_enqueue_style( 'site-style', get_stylesheet_uri(), array(), '1' );
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);
    wp_enqueue_script('slick-slider', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array(), null, true);

//    wp_enqueue_script('vimeo', 'https://player.vimeo.com/api/player.js', array(), null, true);

    wp_enqueue_script('custom-select-js', get_theme_file_uri('/js/custom-select.js'), NULL, '1', true);
    wp_enqueue_script('jquery-validate', get_theme_file_uri('/js/jquery.validate.min.js'), NULL, '1', true);

    wp_enqueue_script('swiper-js', get_theme_file_uri('/js/swiper-min.js'), NULL, '1', true);
    wp_enqueue_script('global', get_theme_file_uri('/js/global.js'), NULL, '1', true);

    wp_localize_script('global','site_data',array(
        'site_url' => site_url(),
        'theme_url' => get_template_directory_uri(),
    ));
}
add_action( 'wp_enqueue_scripts', 'site_scripts' );

function remove_options() {
    remove_menu_page( 'edit.php' );
    remove_menu_page( 'edit-comments.php' );
}
add_action('admin_menu', 'remove_options');

require_once("inc/inc-acf.php");
require_once("inc/custom-posts-types.php");
require_once("inc/custom-taxonomies.php");
require_once("inc/portfolio-filter.php");
require_once("inc/featured-project-filter.php");
