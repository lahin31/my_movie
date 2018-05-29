<?php

/**
 * @package My Movie
 * USE: Create Custom Post Type
 * DESCRIPTION: Creating custom post
 */

namespace MyMovie\Classes;

class PostTypeClass {

	public static $postTypeName = 'lh_movie';
	public static $movieCategory = 'lh_movie_category';
	public static $movieType = 'lh_movie_type';

	public static function initMoviePostType() {

		self::registerMovieCPT();
		self::registerMovieCategory();
		self::registerMovieType();

	}

	public static function registerMovieCPT() {

		$urlSlug = apply_filters( 'lh_movie_url_slug', 'lh_movie' );

		$labels = array(
			'name'               => _x( 'Movies Items', 'post type general name', 'lh_movie' ),
			'singular_name'      => _x( 'Movie Item', 'post type singular name', 'lh_movie' ),
			'menu_name'          => _x( 'Movie', 'admin menu', 'lh_movie' ),
			'name_admin_bar'     => _x( 'Movie', 'add new on admin bar', 'lh_movie' ),
			'add_new'            => _x( 'Add New', 'menu', 'lh_movie' ),
			'add_new_item'       => __( 'Add New Movie', 'lh_movie' ),
			'new_item'           => __( 'New Movie', 'lh_movie' ),
			'edit_item'          => __( 'Edit Movie', 'lh_movie' ),
			'view_item'          => __( 'View Movie', 'lh_movie' ),
			'all_items'          => __( 'All Movie', 'lh_movie' ),
			'search_items'       => __( 'Search Movies', 'lh_movie' ),
			'parent_item_colon'  => __( 'Parent Movies:', 'lh_movie' ),
			'not_found'          => __( 'No movies found.', 'lh_movie' ),
			'not_found_in_trash' => __( 'No movies found in Trash.', 'lh_movie' ),
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Description.', 'lh_movie' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => $urlSlug ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 21,
			'menu_icon'          => 'dashicons-media-interactive',
			'supports'           => array( 'title', 'thumbnail', 'editor', 'excerpt' )
		);
		register_post_type( self::$postTypeName, $args );
	}

	public static function registerMovieCategory() {

		$categorySlug = apply_filters('lh_movie_category_url_slug', 'lh_categories');

		$CategoryLabels = array(
			'name'              => _x( 'Category', 'taxonomy general name', 'lh_movie' ),
			'singular_name'     => _x( 'Category', 'taxonomy singular name', 'lh_movie' ),
			'search_items'      => __( 'Search Category', 'lh_movie' ),
			'all_items'         => __( 'All Category', 'lh_movie' ),
			'parent_item'       => __( 'Parent Category', 'lh_movie' ),
			'parent_item_colon' => __( 'Parent Category:', 'lh_movie' ),
			'edit_item'         => __( 'Edit Category', 'lh_movie' ),
			'update_item'       => __( 'Update Category', 'lh_movie' ),
			'add_new_item'      => __( 'Add New Category', 'lh_movie' ),
			'new_item_name'     => __( 'New Category Name', 'lh_movie' ),
			'menu_name'         => __( 'Category', 'lh_movie' ),
		);

		$categoryArgs = array(
			'hierarchical'      => true,
			'labels'            => $CategoryLabels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => $categorySlug ),
		);
		
		register_taxonomy( self::$movieCategory, array( self::$postTypeName ), $categoryArgs );
	}

	public static function registerMovieType() {

		$typesSlug = apply_filters('lh_movie_category_url_slug', 'lh_movie_types');

		$TypesLabels = array(
			'name'              => _x( 'Movie Type', 'taxonomy general name', 'lh_movie' ),
			'singular_name'     => _x( 'Movie Type', 'taxonomy singular name', 'lh_movie' ),
			'search_items'      => __( 'Search Movie Type', 'lh_movie' ),
			'all_items'         => __( 'All Movie Type', 'lh_movie' ),
			'parent_item'       => __( 'Parent Movie Type', 'lh_movie' ),
			'parent_item_colon' => __( 'Parent Movie Type:', 'lh_movie' ),
			'edit_item'         => __( 'Edit Movie Type', 'lh_movie' ),
			'update_item'       => __( 'Update Movie Type', 'lh_movie' ),
			'add_new_item'      => __( 'Add New Movie Type', 'lh_movie' ),
			'new_item_name'     => __( 'New Movie Type Name', 'lh_movie' ),
			'menu_name'         => __( 'Movie Type', 'lh_movie' ),
		);

		$typesArgs = array(
			'hierarchical'      => true,
			'labels'            => $TypesLabels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => $typesSlug ),
		);

		register_taxonomy( self::$movieType, array( self::$postTypeName ), $typesArgs );
	}
}