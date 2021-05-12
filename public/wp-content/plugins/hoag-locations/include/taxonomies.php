<?php
/**
 * Create custom taxonimies just for locations
 */

 //create custom taxonimes for filtering
// hook into the init action and call when it fires
add_action( 'init', 'create_local_cities_taxonomies' );

// create city taxonomy
function create_local_cities_taxonomies() {
	// Add new taxonomy, make it hierarchical (like location type)
	$labels = array(
		'name' => _x( 'Cities', 'taxonomy general name' ),
		'singular_name' => _x( 'City', 'taxonomy singular name' ),
		'search_items' => __( 'Search Cities' ),
		'all_items' => __( 'All Cities' ),
		'edit_item' => __( 'Edit City' ),
		'update_item' => __( 'Update City' ),
		'add_new_item' => __( 'Add New City' ),
		'new_item_name' => __( 'New City Name' ),
		'menu_name' => __( 'City' ),
	);

	register_taxonomy( 'location-city', array( 'hoag_locations' ), array(
		'hierarchical' => false,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
        'query_var' => true,
        'show_in_rest' => true,
		'rewrite' => array( 'slug' => 'location-city' ),
	) );
}

// hook into the init action and call when it fires
add_action( 'init', 'create_local_type_taxonomies' );

// create Location Type taxonomy
function create_local_type_taxonomies() {
	// Add new taxonomy
	$labels = array(
		'name' => _x( 'Location Type', 'taxonomy general name' ),
		'singular_name' => _x( 'Location Type', 'taxonomy singular name' ),
		'search_items' => __( 'Search Location Type' ),
		'all_items' => __( 'All Location Type' ),
		'edit_item' => __( 'Edit Location Type' ),
		'update_item' => __( 'Update Location Type' ),
		'add_new_item' => __( 'Add New Location Type' ),
		'new_item_name' => __( 'New Location Type Name' ),
		'menu_name' => __( 'Local Type' ),
	);

	register_taxonomy( 'location-type', array( 'hoag_locations' ), array(
		'hierarchical' => false,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
        'query_var' => true,
        'show_in_rest' => true,
		'rewrite' => array( 'slug' => 'location-type' ),
	) );
}