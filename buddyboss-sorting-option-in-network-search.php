<?php
/**
 * Plugin Name: BuddyBoss Sorting Option In Network Search
 * Plugin URI:  https://buddyboss.com/
 * Description: Giving Admin user to Sorting section in Network Search
 * Author:      BuddyBoss
 * Author URI:  https://buddyboss.com/
 * Version:     1.0.0
 * Text Domain: buddyboss-sorting-option-in-network-search
 * Domain Path: /languages/
 * License:     GPLv3 or later (license.txt)
 */

/**
 * This file should always remain compatible with the minimum version of
 * PHP supported by WordPress.
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'BuddyBoss_Sorting_Option_In_Network_Search' ) ) {

	/**
	 * Main BuddyBoss_Sorting_Option_In_Network_Search class
	 *
	 * @class BuddyBoss_Sorting_Option_In_Network_Search
	 * @version	1.0.0
	 */
	final class BuddyBoss_Sorting_Option_In_Network_Search {

		/**
		 * @var BuddyBoss_Sorting_Option_In_Network_Search The single instance of the class
		 * @since 1.0.0
		 */
		protected static $_instance = null;

		/**
		 * Main BuddyBoss_Sorting_Option_In_Network_Search Instance
		 *
		 * Ensures only one instance of BuddyBoss_Sorting_Option_In_Network_Search is loaded or can be loaded.
		 *
		 * @since 1.0.0
		 * @static
		 * @see BuddyBoss_Sorting_Option_In_Network_Search()
		 * @return BuddyBoss_Sorting_Option_In_Network_Search - Main instance
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * Cloning is forbidden.
		 * @since 1.0.0
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'buddyboss-sorting-option-in-network-search' ), '1.0.0' );
		}
		/**
		 * Unserializing instances of this class is forbidden.
		 * @since 1.0.0
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'buddyboss-sorting-option-in-network-search' ), '1.0.0' );
		}

		/**
		 * BuddyBoss_Sorting_Option_In_Network_Search Constructor.
		 */
		public function __construct() {

			// Set up localisation.
			$this->load_plugin_textdomain();

			add_action( 'plugins_loaded', array( $this, 'bp_init' ) );
			add_action( 'bp_loaded', array( $this, 'bp_init' ) );
		}

		/**
		 * Load this function when the BuddyBoss Platform Plugin is loaded
		 */
		public function bp_init() {

			$this->define_constants();

			/**
			 * For BuddyBoss Platform
			 */
			if ( ! defined( 'BP_PLATFORM_VERSION' ) ) {

				if ( defined( 'WP_CLI' ) ) {
					WP_CLI::warning( $this->install_bb_platform_notice() );
				} else {
					add_action( 'admin_notices', array( $this, 'install_bb_platform_notice' ) );
					add_action( 'network_admin_notices', array( $this, 'install_bb_platform_notice' ) );
				}
				return;
			}

			if ( empty( $this->platform_is_active() ) ) {
				if ( defined( 'WP_CLI' ) ) {
					WP_CLI::warning( $this->update_bb_platform_notice() );
				} else {
					add_action( 'admin_notices', array( $this, 'update_bb_platform_notice' ) );
					add_action( 'network_admin_notices', array( $this, 'update_bb_platform_notice' ) );
				}
				return;
			}

			$this->includes();
			$this->scripts();
		}

		/**
		 * Load the script in the frountend and the backend
		 */
		public function scripts() {
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_script' ) );

		}

		/**
		 * Load the script into the backend
		 */
		public function admin_enqueue_script() {

			wp_register_script( 'buddyboss-sorting-option-in-network-search-admin-js', BUDDYBOSS_SORTING_OPTION_IN_NETWORK_SEARCH_PLUGIN_URL . 'assets/dist/js/backend-script.js', array( 'jquery-ui-sortable' ), $this->asset_version() );

			// wp_register_style( 'buddyboss-sorting-option-in-network-search-admin-css', BUDDYBOSS_SORTING_OPTION_IN_NETWORK_SEARCH_PLUGIN_URL . 'dist/js/backend.css', array(), $this->asset_version(), 'all' );
			// wp_enqueue_style( 'buddyboss-sorting-option-in-network-search-admin-css' );
		}

		/**
		 * Return the current version of the plugin.
		 *
		 * @return mixed
		 */
		public function version() {
			$args = [
				'Version' => 'Version',
			];
			$meta = get_file_data( BUDDYBOSS_SORTING_OPTION_IN_NETWORK_SEARCH_PLUGIN_FILE . '/buddyboss-sorting-option-in-network-search.php', $args );

			return isset( $meta['Version'] ) ? $meta['Version'] : time();
		}

		/**
		 * Sync the plugin version with the asset version.
		 *
		 * @return string
		 */
		public function asset_version() {
			if ( $this->is_debug() || $this->is_script_debug() ) {
				return time();
			}

			return $this->version();
		}

		/**
		 * Is WP debug mode enabled.
		 *
		 * @return boolean
		 */
		public function is_debug() {
			return ( defined( '\WP_DEBUG' ) && \WP_DEBUG );
		}

		/**
		 * Is WP script debug mode enabled.
		 *
		 * @return boolean
		 */
		public function is_script_debug() {
			return ( defined( '\SCRIPT_DEBUG' ) && \SCRIPT_DEBUG );
		}


		/**
		 * Define WCE Constants
		 */
		private function define_constants() {
			$this->define( 'BUDDYBOSS_SORTING_OPTION_IN_NETWORK_SEARCH_PLUGIN_FILE', __FILE__ );
			$this->define( 'BUDDYBOSS_SORTING_OPTION_IN_NETWORK_SEARCH_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
			$this->define( 'BUDDYBOSS_SORTING_OPTION_IN_NETWORK_SEARCH_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
			$this->define( 'BUDDYBOSS_SORTING_OPTION_IN_NETWORK_SEARCH_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
			$this->define( 'BP_PLATFORM_VERSION_MINI_VERSION', '2.2.9.1' );
		}

		/**
		 * Define constant if not already set
		 * @param  string $name
		 * @param  string|bool $value
		 */
		private function define( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}

		/**
		 * Include required core files used in admin and on the frontend.
		 */
		public function includes() {
			include_once( BUDDYBOSS_SORTING_OPTION_IN_NETWORK_SEARCH_PLUGIN_PATH . 'functions.php' );
		}

		/**
		 * Get the plugin url.
		 * @return string
		 */
		public function plugin_url() {
			return untrailingslashit( plugins_url( '/', __FILE__ ) );
		}

		/**
		 * Get the plugin path.
		 * @return string
		 */
		public function plugin_path() {
			return untrailingslashit( plugin_dir_path( __FILE__ ) );
		}

		/**
		 * Load Localisation files.
		 *
		 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
		 */
		public function load_plugin_textdomain() {
			$locale = is_admin() && function_exists( 'get_user_locale' ) ? get_user_locale() : get_locale();
			$locale = apply_filters( 'plugin_locale', $locale, 'buddyboss-sorting-option-in-network-search' );

			unload_textdomain( 'buddyboss-sorting-option-in-network-search' );
			load_textdomain( 'buddyboss-sorting-option-in-network-search', WP_LANG_DIR . '/' . plugin_basename( dirname( __FILE__ ) ) . '/' . plugin_basename( dirname( __FILE__ ) ) . '-' . $locale . '.mo' );
			load_plugin_textdomain( 'buddyboss-sorting-option-in-network-search', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
		}

		/**
		 * Disable the plugin load and show the notices to the admin
		 */
		public function install_bb_platform_notice() {
			echo '<div class="error fade"><p>';
			_e('<strong>BuddyBoss Sorting Option In Network Search</strong></a> requires the BuddyBoss Platform plugin to work. Please <a href="https://buddyboss.com/platform/" target="_blank">install BuddyBoss Platform</a> first.', 'buddyboss-sorting-option-in-network-search');
			echo '</p></div>';
		}
	
		/**
		 * Disable the plugin load and show the notices to the admin
		 */
		public function update_bb_platform_notice() {
			echo '<div class="error fade"><p>';
			printf( __('<strong>BuddyBoss Sorting Option In Network Search</strong></a> requires BuddyBoss Platform plugin version %s or higher to work. Please update BuddyBoss Platform.', 'buddyboss-sorting-option-in-network-search'), BP_PLATFORM_VERSION_MINI_VERSION );
			echo '</p></div>';
		}

		/**
		 * Check if the platform is acitve or not
		 * User: BuddyBoss_Sorting_Option_In_Network_Search::instance->platform_is_active();
		 * 
		 * return Bool True if the Platform is active and has the mini version requre or else false
		 */

		public function platform_is_active() {
			if ( defined( 'BP_PLATFORM_VERSION' ) && version_compare( BP_PLATFORM_VERSION, BP_PLATFORM_VERSION_MINI_VERSION , '>=' ) ) {
				return true;
			}
			return false;
		}
	}
}


if ( ! function_exists( 'buddyboss_sorting_option_in_network_search' ) ) {
	/**
	 * Returns the main instance of BuddyBoss_Sorting_Option_In_Network_Search to prevent the need to use globals.
	 *
	 * @since  1.0.0
	 * @return BuddyBoss_Sorting_Option_In_Network_Search
	 */
	function buddyboss_sorting_option_in_network_search() {
		return BuddyBoss_Sorting_Option_In_Network_Search::instance();
	}

	/**
	 * Call the main function to load the plugin
	 */
	buddyboss_sorting_option_in_network_search();
}


