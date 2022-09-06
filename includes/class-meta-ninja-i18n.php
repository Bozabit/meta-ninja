<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://luckyseed.io/people/bozabit
 * @since      1.0.0
 *
 * @package    Meta_Ninja
 * @subpackage Meta_Ninja/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Meta_Ninja
 * @subpackage Meta_Ninja/includes
 * @author     Bozabit <bozabit@luckyseed.com>
 */
class Meta_Ninja_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'meta-ninja',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
