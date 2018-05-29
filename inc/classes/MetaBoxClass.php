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

		add_meta_box( 'lh_movie_additional_info', __( 'Additional Info',  'lh_movie' ), array( self::class, 'addtionalInfoMetaCallback') );
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

	public static function addtionalInfoMetaCallback($post) {
		$data = array(
			'boxes' => HelperClass::getAdditionalInfo(),
			'info' => get_post_meta( $post->ID, '_lh_movie_additional_info', true)
		);
		HelperClass::renderView( 'metaBoxes.additionalInfo', $data );
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

		$additionalInfo = $_REQUEST['_lh_movie_additional_info'];
		$formattedAdditionalInfo = array();

		foreach ($additionalInfo as $infoIndex => $value) {
			$formattedAdditionalInfo[ $infoIndex] = sanitize_text_field($value); 
		}
		$metaData['_lh_movie_additional_info'] = $formattedAdditionalInfo;
		
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