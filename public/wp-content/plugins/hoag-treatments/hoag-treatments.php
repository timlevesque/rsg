<?php

/**
 * The plugin bootstrap file
 *
 * @link              https://freshclicks.net
 * @since             1.0.0
 * @package           Hoag_Treatments
 *
 * @wordpress-plugin
 * Plugin Name:       Hoag Treatements
 * Plugin URI:        https://freshclicks.net
 * Description:       Add a custom type of Treatements and a supported shortcode [display-posts post_type='hoag_treatments']
 * Version:           1.0.0
 * Author:            Lary Stucker
 * Author URI:        https://freshclicks.net
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       hoag-treatments
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

function create_post_type_hoag_treatments() {
	register_post_type( 'hoag_treatments',
	  array(
		'labels' => array(
		  'name' => __( 'Team' ),
		  'singular_name' => __( 'Member' )
		),
		'public' => true,
		'has_archive' => true,
		'publicaly_queryable' => true, 
		'query_var' => true,
		'exclude_from_search' => false,
		'show_in_rest' => true,
		'show_in_nav_menus' => false,
		'menu_icon' => 'dashicons-media-default',
		'supports' => array( 
			'title', 
			'editor', 
			'excerpt', 
			//'custom-fields', 
			'thumbnail',
			//'page-attributes', 
		),
		'rewrite' => array( 'slug' => 'team' ),
		
	  )
	);
  }
  
  add_action( 'init', 'create_post_type_hoag_treatments' );