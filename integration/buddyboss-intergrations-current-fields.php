<?php
/**
 * BuddyBoss Compatibility Integration Class.
 *
 * @since BuddyBoss_Sorting_Option_In_Network_Search  1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Setup the bp compatibility class.
 *
 * @since BuddyBoss_Sorting_Option_In_Network_Search  1.0.0
 */
class BuddyBoss_Sorting_Option_In_Network_Search_BuddyBoss_Integration_Current_Fields{

    public function __construct() {

        /**
         * Register fields for settings hooks
         */
        add_action( 'bp_admin_setting_search_register_fields', array( $this, 'admin_setting_general_register_fields' ) );
    }

    public function admin_setting_general_register_fields( $setting ) {

        $section_id = 'buddyboss-sorting-option-in-network-search-enable';
        // Main General Settings Section
	    $setting->add_section( 
            $id,
            __( 'BuddyBoss Sorting Option In Network Search', 'buddyboss-sorting-option-in-network-search' ),
            array( $this, 'admin_general_setting_main_callback' )
        );

	    $args          = array();
	    $setting->add_field( $section_id, __( 'Sorting', 'buddyboss-sorting-option-in-network-search' ), array( $this, 'admin_general_setting_callback' ), '', $args );
    }

    public function admin_general_setting_callback() {

        $sorting_values = buddyboss_sorting_option_in_network_search_options();

        wp_enqueue_script( 'jquery-ui-sortable' );
        wp_enqueue_script( 'buddyboss-sorting-option-in-network-search-admin-js' );

        if( ! empty( $sorting_values ) ) {
            echo '<ul id="buddyboss-sorting-main">';
            foreach( $sorting_values as $sorting_value ) {
                $sorting_item = apply_filters( 'bp_search_label_search_type', $sorting_value );
                printf( '<li class="buddyboss-sorting-content">%s <input type="checkbox" checked name="buddyboss-sorting-option-in-network-search-enable[]" value="%s"/></li>', $sorting_item, $sorting_value );
            }
            echo '</ul>';
        }
	}

    public function admin_general_setting_main_callback() {
        ?>
        <p>
            <?php esc_html_e( 'Giving Admin user to Sorting section in Network Search', 'buddyboss' ); ?>
        </p>
        <?php
	}
}