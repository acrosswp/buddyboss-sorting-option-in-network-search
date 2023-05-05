<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Get the new sorting option for the netwrok search
 * 
 * return array $sorting_values
 */
function sorting_option_in_network_search_for_buddyboss_options() {

    /**
     * Defalut sorting from the BuddyBoss sorting page
     */
    $searchable_items = BP_Search::instance()->searchable_items;

    /**
     * Custom sorting array from the plugins
     */
    $sorting_values = get_option( 'sorting-option-in-network-search-for-buddyboss-enable', array() );

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