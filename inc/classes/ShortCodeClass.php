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
			
		));
	}
}