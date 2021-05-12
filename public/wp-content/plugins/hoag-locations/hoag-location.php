<?php
/*
Plugin Name: Hoag Listings
Plugin URI:
Description: create a custom post type called listing
Version: 1.0.1
Author: Lary Stucker
Author URI:
License: GPLv2 or later
*/

//create a the custom locaiton type
function create_post_type() {
	register_post_type( 'rsg_listings',
	  array(
		'labels' => array(
		  'name' => __( 'Listings' ),
		  'singular_name' => __( 'listing' )
		),
		'public' => true,
		'has_archive' => false,
		'publicaly_queryable' => false, 
		'query_var' => false,
		'show_in_rest' => true,
		'exclude_from_search' => true,
		'show_in_nav_menus' => false,
		'menu_icon' => 'dashicons-location',
		'supports' => array( 
			'title', 
			'editor', 
			//'excerpt', 
			//'custom-fields', 
			'thumbnail',
			'page-attributes', 
		),
		'rewrite' => array( 'slug' => 'listings' ),
		
	  )
	);
  }
  
  add_action( 'init', 'create_post_type' );

//loop in the metabox values
require_once(plugin_dir_path( __FILE__ ) . 'include/metabox.php');

//loop in the specific taxonomies
require_once(plugin_dir_path( __FILE__ ) . 'include/taxonomies.php');

//loop in the shortcode
require_once(plugin_dir_path( __FILE__ ) . 'include/shortcode.php');

/* TO-DO: should only load on pages with urgent care lisiting. */
function hoag_local_enqueue_script() {   
    wp_enqueue_script( 'clockwise_script', 'https://s3-us-west-1.amazonaws.com/clockwisepublic/clockwiseWaitTimes.min.js' );
}
add_action('wp_enqueue_scripts', 'hoag_local_enqueue_script');


/**
 * Add REST API support hoag-Listings
 */
add_filter( 'register_post_type_args', 'listing_args', 10, 2 );
 
function listing_args( $args, $post_type ) {
 
    if ( 'rsg_listings' === $post_type ) {
        $args['show_in_rest'] = true;
 
        // Optionally customize the rest_base or rest_controller_class
        $args['rest_base']             = 'rsg_listings';
        $args['rest_controller_class'] = 'WP_REST_Posts_Controller';
    }
 
    return $args;
}