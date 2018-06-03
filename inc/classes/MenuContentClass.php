<?php

/**
 * @package My Movie
 */

namespace MyMovie\Classes;

class MenuContentClass {

	public function handleAjax() {
		$route = sanitize_text_field( $_REQUEST['route'] );
		$validEndpoints = array(
			'get_item' => 'getMovieModal'
		);
		if( isset($validEndpoints[$route])) {
			$this-> {
				$validEndpoints[$route]
			}();
			exit();
		}
	}

	public function getItemModal() {
		$postId = intval( $_REQUEST['item_id']);
		$post = get_post( $post_id );

		$itemData = array(
			'postID' => $postId,
			'post' => $post,
			'additionalInfo' => HelperClass::getAdditionalInfo()
		);

		HelperClass::renderView('modal', $itemData);
	}

	public function filterSingleMenuContent() {
		
	}

}