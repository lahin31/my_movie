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
 	}

 	public function adminHooks() {
 		$postTypeName = \MyMovie\Classes\PostTypeClass::$postTypeName;

 		add_action( 'add_meta_boxes_' . $postTypeName, array('MyMovie\Classes\MetaBoxClass', 'addMetaBoxes') );
 		add_action( 'save_post_' . $postTypeName, array('MyMovie\Classes\MetaBoxClass', 'saveMeta') );
 		add_action( 'admin_menu', array('MyMovie\Classes\SettingsClass', 'addSettingsMenu'));
 	}

}

add_action( 'plugins_loaded', function() {
	$movies = new MyMovie();
	$movies->boot();
});