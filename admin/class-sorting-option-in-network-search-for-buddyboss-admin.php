<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://acrosswp.com
 * @since      1.0.0
 *
 * @package    Sorting_Option_In_Network_Search_For_BuddyBoss
 * @subpackage Sorting_Option_In_Network_Search_For_BuddyBoss/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Sorting_Option_In_Network_Search_For_BuddyBoss
 * @subpackage Sorting_Option_In_Network_Search_For_BuddyBoss/admin
 * @author     AcrossWP <contact@acrosswp.com>
 */
class Sorting_Option_In_Network_Search_For_BuddyBoss_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sorting_Option_In_Network_Search_For_BuddyBoss_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sorting_Option_In_Network_Search_For_BuddyBoss_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_register_script( $this->plugin_name, SORTING_OPTION_IN_NETWORK_SEARCH_FOR_BUDDYBOSS_PLUGIN_URL . 'assets/dist/js/backend-script.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the Setting in BuddyBoss General settings Area
	 *
	 * @since    1.0.0
	 */
	public function admin_setting_general_register_fields( $setting ) {

        $section_id = 'sorting-option-in-network-search-for-buddyboss-enable';
        // Main General Settings Section
	    $setting->add_section( 
            $id,
            __( 'BuddyBoss Sorting Option In Network Search', 'sorting-option-in-network-search-for-buddyboss' ),
            array( $this, 'admin_general_setting_main_callback' )
        );

	    $args          = array();
	    $setting->add_field( $section_id, __( 'Sorting', 'sorting-option-in-network-search-for-buddyboss' ), array( $this, 'admin_general_setting_callback' ), '', $args );
    }

    public function admin_general_setting_callback() {

		
        $sorting_values = sorting_option_in_network_search_for_buddyboss_options();

        wp_enqueue_script( 'jquery-ui-sortable' );
        wp_enqueue_script( $this->plugin_name );

        if( ! empty( $sorting_values ) ) {
            echo '<ul id="buddyboss-sorting-main">';
            foreach( $sorting_values as $sorting_value ) {
                $sorting_item = apply_filters( 'bp_search_label_search_type', $sorting_value );
                printf( '<li class="buddyboss-sorting-content">%s <input type="checkbox" checked name="sorting-option-in-network-search-for-buddyboss-enable[]" value="%s"/></li>', $sorting_item, $sorting_value );
            }
            echo '</ul>';
        }
	}

    public function admin_general_setting_main_callback() {
        ?>
        <p>
            <?php esc_html_e( 'Giving Admin user to Sorting section in Network Search', 'sorting-option-in-network-search-for-buddyboss' ); ?>
        </p>
        <?php
	}

}