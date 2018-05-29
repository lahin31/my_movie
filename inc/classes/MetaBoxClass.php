<?php

/**
 * @package My Movie
 * USE: Create Meta Box
 * DESCRIPTION: Creating meta box for lh_movie cpt
 */

namespace MyMovie\Classes;

class MetaBoxClass {

	public static function addMetaBoxes() {
		add_meta_box( 'lh_movie_custom_meta', __( 'Movie Details', 'lh_movie' ), array( self::class, 'customMetaBoxCallback') );
	}

	public static function customMetaBoxCallback($post) {
		$data = array(
			'_lh_movie_director' => get_post_meta( $post->ID, '_lh_movie_director', true ),
			'_lh_movie_writter' => get_post_meta( $post->ID, '_lh_movie_writter', true ),
			'_lh_movie_stars' => get_post_meta( $post->ID, '_lh_movie_stars', true ),
			'_lh_movie_runtime' => get_post_meta( $post->ID, '_lh_movie_runtime', true)
		);

		HelperClass::renderView( 'metaBoxes.movie_details', $data);
	}

	public static function saveMeta($postID) {

		if ( !isset($_REQUEST['has_movie_meta_info']) ) {
			return;
		}

		$metaData = array(
			'_lh_movie_director' => sanitize_text_field( $_REQUEST['_lh_movie_director'] ),
			'_lh_movie_writter' => sanitize_text_field( $_REQUEST['_lh_movie_writter'] ),
			'_lh_movie_stars' => sanitize_text_field( $_REQUEST['_lh_movie_stars'] ),
			'_lh_movie_runtime' => sanitize_text_field( $_REQUEST['_lh_movie_runtime'] )
		);


		foreach($metaData as $meta_key => $metaValue) {
			update_post_meta(
				$postID,
				$meta_key,
				$metaValue
			);
		}

		return;
	}
}