<?php

/**
 * @package My Movie
 * USE: Interface of class
 * DESCRIPTION: Making Interfaces of Classes
 */

namespace MyMovie\Classes;

class HelperClass {

	public static function makeView($file, $data = array()) {
		$file = sanitize_file_name($file);
		$file = str_replace('.', DIRECTORY_SEPARATOR, $file);
		extract($data);
		$filePath = LH_MOVIE_PATH . 'inc/templates/' . $file . '.php';
		if(!file_exists($filePath)) {
			return '';
		} 
		ob_start();
			include $filePath;
		return ob_get_clean();
	}

	public static function renderView($file, $data) {
		echo self::makeView($file, $data);
	}
}