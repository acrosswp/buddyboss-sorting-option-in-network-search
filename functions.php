<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/***************************** Add section in current settings ***************************************/
/**
 * Set up the my plugin integration.
 */
include_once( BUDDYBOSS_SORTING_OPTION_IN_NETWORK_SEARCH_PLUGIN_PATH . 'integration/buddyboss-intergrations-current-fields.php' );
new BuddyBoss_Sorting_Option_In_Network_Search_BuddyBoss_Integration_Current_Fields();

/**
 * Get the new sorting option for the netwrok search
 * 
 * return array $sorting_values
 */
function buddyboss_sorting_option_in_network_search_options() {

    /**
     * Defalut sorting from the BuddyBoss sorting page
     */
    $searchable_items = BP_Search::instance()->searchable_items;

    /**
     * Custom sorting array from the plugins
     */
    $sorting_values = get_option( 'buddyboss-sorting-option-in-network-search-enable', array() );

    /**
     * If sorting is runnning for the first time then copy the original value and save it here
     */
    $sorting_values = empty( $sorting_values ) ? $searchable_items : $sorting_values;

    /**
     * check if there is any new item added into main sorting list
     */
    $array_diff = array_diff( $searchable_items, $sorting_values );
    $sorting_values = empty( $array_diff ) ? $sorting_values : array_merge( $sorting_values, $array_diff );

    /**
     * check if there is any item is been removed
     */
    $array_diff = array_diff( $sorting_values, $searchable_items );
    $sorting_values = empty( $array_diff ) ? $sorting_values : array_diff( $sorting_values, $array_diff );

    return $sorting_values;
}


/**
 * Filter to overwrite the search filter
 */
function buddyboss_sorting_option_in_network_search_hook() {

    $network_search_options = buddyboss_sorting_option_in_network_search_options();
    if( ! empty( $network_search_options ) ) {
        BP_Search::instance()->searchable_items = array();
        BP_Search::instance()->searchable_items = $network_search_options;
    }
}

// create instances of helpers and associate them with types
add_action( 'init', 'buddyboss_sorting_option_in_network_search_hook', 81 );