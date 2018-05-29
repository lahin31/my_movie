<?php

/**
 * @package My Movie
 * USE: Settings Api
 * DESCRIPTION: Settings Api for lh_movie cpt
 */

namespace MyMovie\Classes;

class SettingsClass {

	public static function addSettingsMenu() {
		add_submenu_page('edit.php?post_type=lh_movie', __('Lahin Movie Settings', 'lh_movie'), __('Settings', 'lh_movie'), 'manage_options', 'lh_movie_settings', array(self::class, 'renderSettings'));
	}

	public static function renderSettings() {
		HelperClass::renderView('settings.settings', array());
	} 

}