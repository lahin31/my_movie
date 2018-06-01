<?php

/**
 * @package My Movie
 */

namespace MyMovie\Classes;

class MenuContentClass {

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

}