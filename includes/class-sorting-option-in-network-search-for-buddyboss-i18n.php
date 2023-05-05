<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://acrosswp.com
 * @since      1.0.0
 *
 * @package    Sorting_Option_In_Network_Search_For_BuddyBoss
 * @subpackage Sorting_Option_In_Network_Search_For_BuddyBoss/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Sorting_Option_In_Network_Search_For_BuddyBoss
 * @subpackage Sorting_Option_In_Network_Search_For_BuddyBoss/includes
 * @author     AcrossWP <contact@acrosswp.com>
 */
class Sorting_Option_In_Network_Search_For_BuddyBoss_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'sorting-option-in-network-search-for-buddyboss',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
