<?php

/**
 * @package My Movie
 * USE: ShortCode for lh_movie
 * DESCRIPTION: Making shortcode for lh_movie cpt
 */

namespace MyMovie\Classes;

class ShortCodeClass {

	public static function register($atts) {

		$defaults = apply_filters('lh_movie_shortcode_defaults', array(
			'display' => 'default',
			'limit' => -1,
			'category' => false,
			'movie_type' => false,
			'disable_modal' => false,
			'items_ids' => false,
			'relation' => 'OR',
			'per_grid' => 2,
			'offset' => 0, 
			'excerpt_length' => null
		));

		$attributes = shortcode_atts($defaults, $atts);
		$attributes['view_file'] = self::getViewNameByDisplay($attributes['display']);
		$attributes['excerptLength'] = self::getExcerptLength($attributes);
		$attributes = apply_filters('lh_movie_shortcode_atts', $attributes);

		return lahinMovieRenderMenuItems($attributes);
	}

	public static function getExcerptLength($attributes) {

		if($attributes['excerpt_length']) {
			return intval($attributes['excerpt_length']);
		}

		if($attributes['display'] == 'grid') {
			return 90 / $attributes['per_grid'];
		}

		return 90;
	}

	public static function getViewNameByDisplay( $display ) {
		$displayArray = array(
			'simple' => 'simple_movie_menu',
			'centered_aligned' => 'centered_aligned_menu',
			'grid' => 'grid_items'
		);
		$return = 'default';
		if(isset($displayArray[$display])) {
			$return = $displayArray[$display];
		}
		return apply_filters('lh_menu_get_view_name_by_display', $return, $display);
	}

	public static function saveFlagOnShortCode( $post_id ) {

		if( isset( $_POST['post_content'] ) ) {
			$post_content = $_POST['post_content'];
		} else {
			$post = get_post( $post_id );
			$post_content = $post->post_content;
		}

		if( has_shortcode( $post_content, 'lh_menu')) {
			update_post_meta( $post_id, '_has_lh_menu_shortcode', 1);
		} else if( get_post_meta( $post_id, '_has_lh_menu_shortcode', true)) {
			update_post_meta( $post_id, '_has_lh_menu_shortcode', 0);
		}
	}
}