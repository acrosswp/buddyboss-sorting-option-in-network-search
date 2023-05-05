<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://acrosswp.com
 * @since             1.0.0
 * @package           Sorting_Option_In_Network_Search_For_BuddyBoss
 *
 * @wordpress-plugin
 * Plugin Name:       Sorting Option In Network Search For BuddyBoss
 * Plugin URI:        https://acrosswp.com
 * Description:       Sorting Option In Network Search For BuddyBoss by AcrossWP
 * Version:           1.0.0
 * Author:            AcrossWP
 * Author URI:        https://acrosswp.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       sorting-option-in-network-search-for-buddyboss
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'SORTING_OPTION_IN_NETWORK_SEARCH_FOR_BUDDYBOSS_FILES', __FILE__ );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-sorting-option-in-network-search-for-buddyboss-activator.php
 */
function activate_sorting_option_in_network_search_for_buddyboss() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sorting-option-in-network-search-for-buddyboss-activator.php';
	Sorting_Option_In_Network_Search_For_BuddyBoss_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-sorting-option-in-network-search-for-buddyboss-deactivator.php
 */
function deactivate_sorting_option_in_network_search_for_buddyboss() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sorting-option-in-network-search-for-buddyboss-deactivator.php';
	Sorting_Option_In_Network_Search_For_BuddyBoss_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_sorting_option_in_network_search_for_buddyboss' );
register_deactivation_hook( __FILE__, 'deactivate_sorting_option_in_network_search_for_buddyboss' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-sorting-option-in-network-search-for-buddyboss.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_sorting_option_in_network_search_for_buddyboss() {

	$plugin = new Sorting_Option_In_Network_Search_For_BuddyBoss();
	$plugin->run();

}
run_sorting_option_in_network_search_for_buddyboss();
