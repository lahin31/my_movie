<?php

/*
Plugin Name: My Movie
Plugin URI:  https://developer.wordpress.org/restaurant-menu/the-basics/
Description: A simple Movie plugin
Version:     0.1
Author:      Muhammad Lahin
Author URI:  https://wpmanageninja.com
Text Domain: lh_movie
Domain Path: /languages
License:     GPL2

 */

defined( 'ABSPATH' ) or die();

// defining constant
define( 'LH_MOVIE_PATH', plugin_dir_path(__FILE__) );
define( 'LH_MOVIE_URL', plugin_dir_url(__FILE__) );
define( 'LH_MOVIE_VERSION', '1.0' );

include 'load.php';

class MyMovie {

	public function boot() {
		$this->commonHooks();
		if( is_admin() ) {
			$this->adminHooks();
		} else {
			$this->publicHooks();
		}
 	}

 	public function publicHooks() {
 	}

 	public function commonHooks() {
 		// Register Post Type
 		add_action( 'init', array( '\MyMovie\Classes\PostTypeClass', 'initMoviePostType' ));
 		// Register ShortCode
 		$shortCodeClass = new \MyMovie\Classes\ShortCodeClass();
 		add_shortcode( 'lh_menu', array( $shortCodeClass, 'register'));
 		add_action( 'wp_enqueue_scripts', array( $this, 'enqueueScripts' ));

 		$menuContentClass = new \MyMovie\Classes\MenuContentClass();
 		add_action( 'init', function() use ($menuContentClass) {
 			if( isset($_GET['lh_get_item']) && $_GET['lh_get_item']) {
 				$menuContentClass->getItemModal();
 				die();
 			}
 		});

 		// add_filter( 'the_content', array($menuContentClass, 'filterSingleMenuContent') );
	}

 	public function adminHooks() {
 		$postTypeName = \MyMovie\Classes\PostTypeClass::$postTypeName;

 		add_action( 'add_meta_boxes_' . $postTypeName, array('MyMovie\Classes\MetaBoxClass', 'addMetaBoxes') );
 		add_action( 'save_post_' . $postTypeName, array('MyMovie\Classes\MetaBoxClass', 'saveMeta') );
 		add_action( 'admin_menu', array('MyMovie\Classes\SettingsClass', 'addSettingsMenu'));

 		add_action( 'admin_enqueue_scripts', array( $this, 'load_custom_wp_admin_style' ));
 	}

 	public function load_custom_wp_admin_style() {
 		wp_register_style( 'custom_wp_admin_css', LH_MOVIE_URL . 'assets/css/admin_style.css', array(), LH_MOVIE_VERSION );
 		wp_enqueue_style( 'custom_wp_admin_css' );
 	}

 	public function enqueueScripts() {
 		wp_register_style( 'lh_movie_style', LH_MOVIE_URL . 'assets/css/style.css', array(),
			LH_MOVIE_VERSION );
 		wp_enqueue_style( 'lh_movie_style' );

 		wp_register_script( 'lh_menu_script', LH_MOVIE_URL . 'assets/js/app.js', array( 'jquery'), LH_MOVIE_VERSION, true );

 		wp_enqueue_script( 'lh_menu_script' );
 	}

}

add_action( 'plugins_loaded', function() {
	$movies = new MyMovie();
	$movies->boot();
});