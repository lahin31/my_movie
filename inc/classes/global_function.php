<?php
/**
 * @package My Movie
 */

function lahinMovieRenderMenuItems($attributes) {

	extract($attributes);
	if($item_ids) {
		$attributes['item_ids'] = explode( ',', $item_ids );
	}

	$taxonomies = array(
		\MyMovie\Classes\PostTypeClass::$movieCategory     => ( $movie_category ) ? explode( ',', $movie_category ) : array(),
		\MyMovie\Classes\PostTypeClass::$movieType     => ( $movie_type ) ? explode( ',', $movie_type ) : array()
	);

	$menuItems = lahinMovieMenuGetMenuItems( $taxonomies, $limit, $relation, $attributes );

	$modalClass = '';
	if ( !$disable_modal ) {
		$modalClass = 'movie_item_modal';
	}

	if(!$display) {
		$display = 'default';
	}

	return MyMovie\Classes\HelperClass::makeView($view_file, array(
		'items' => $menuItems,
		'display' => $display,
		'currency' => \MyMovie\Classes\HelperClass::getCurrency(),
		'disable_modal' => $disable_modal,
		'modalClass' => $modalClass,
		'per_grid' => $per_grid,
		'excerptLength' => $excerptLength
	));
}

function lahinMovieMenuGetMenuItems( $taxonomies, $limit = - 1, $tax_relation = 'AND', $attributes ) {

	$taxQuery = array(
		'relation' => $tax_relation,
	);
	foreach ($taxonomies as $tax_name => $cat_taxonomies) {
		if($cat_taxonomies) {
			$taxQuery[] = array(
				'taxonomy' => $tax_name,
				'field'    => 'slug',
				'terms'    => $cat_taxonomies,
			);
		}
	}

	if($limit == -1) {
		$limit = 9999;
	}

	$queryArgs = array(
		'posts_per_page' => $limit,
		'post_type' => \MyMovie\Classes\PostTypeClass::$postTypeName,
		'offset' => intval($attributes['offset'])
	);
	
	if($attributes['item_ids']) {
		$queryArgs['post__in'] = $attributes['item_ids'];
	} else if(count($taxQuery) > 1) {
		$queryArgs['tax_query'] = $taxQuery;
	}
	
	$queryArgs = apply_filters('lh_movie_post_query_args', $queryArgs, $attributes);
	
	$items =  get_posts($queryArgs);
	
	return $items;


}

function lhMovieMenuWordExcerpt( $post, $length, $item_type = 'default', $end='....')
{
	if($post->post_exceprt) {
		$string = $post->post_exceprt;
	} else {
		$string = $post->post_content;
	}
	$string = strip_tags($string);
	
	if (strlen($string) > $length) {

		// truncate string
		$stringCut = substr($string, 0, $length);

		// make sure it ends in a word so assassinate doesn't become ass...
		$string = substr($stringCut, 0, strrpos($stringCut, ' ')).$end;
	}
	return apply_filters('lh_movie_get_item_except', $string, $post, $item_type);
}