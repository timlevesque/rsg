<?php

/**
 * The plugin bootstrap file
 *
 * @link              https://freshclicks.net
 * @since             1.0.1
 * @package           Hoag_Procedures
 *
 * @wordpress-plugin
 * Plugin Name:       Hoag Procedures
 * Plugin URI:        https://freshclicks.net
 * Description:       Add a custom type of Services/Procedures and a supported shortcode [display-posts post_type='hoag_procedures']. We changed the URL to /service/ so don't get confussed.
 * Version:           1.0.1
 * Author:            Lary Stucker
 * Author URI:        https://freshclicks.net
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       hoag-procedures
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

function create_post_type_hoag_procedures() {
	register_post_type( 'hoag_procedures',
	  array(
		'labels' => array(
		  'name' => __( 'Practice Areas' ),
		  'singular_name' => __( 'Practice Area' )
		),
		'public' => true,
		'has_archive' => true,
		'publicaly_queryable' => true, 
		'query_var' => true,
		'exclude_from_search' => false,
		'show_in_nav_menus' => false,
		'show_in_rest' => true,
		'menu_icon' => 'dashicons-admin-customizer',
		'supports' => array( 
			'title', 
			'editor', 
			'excerpt', 
			//'custom-fields', 
			'thumbnail',
			//'page-attributes', 
		),
		'rewrite' => array( 'slug' => 'service' ),
		
	  )
	);
  }
  
  add_action( 'init', 'create_post_type_hoag_procedures' );