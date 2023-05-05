<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://acrosswp.com
 * @since      1.0.0
 *
 * @package    Sorting_Option_In_Network_Search_For_BuddyBoss
 * @subpackage Sorting_Option_In_Network_Search_For_BuddyBoss/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Sorting_Option_In_Network_Search_For_BuddyBoss
 * @subpackage Sorting_Option_In_Network_Search_For_BuddyBoss/public
 * @author     AcrossWP <contact@acrosswp.com>
 */
class Sorting_Option_In_Network_Search_For_BuddyBoss_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Filter to overwrite the search filter
	 * 
	 * @since    1.0.0
	 */
	function sorting_option_in_network_search_for_buddyboss_hook() {

		$network_search_options = sorting_option_in_network_search_for_buddyboss_options();
		if( ! empty( $network_search_options ) ) {
			BP_Search::instance()->searchable_items = array();
			BP_Search::instance()->searchable_items = $network_search_options;
		}
	}
}
