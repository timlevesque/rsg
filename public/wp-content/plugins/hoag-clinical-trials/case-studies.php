<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://freshclicks.net
 * @since             1.0.0
 * @package           Case_Studies
 *
 * @wordpress-plugin
 * Plugin Name:       Case Studies
 * Plugin URI:        https://freshclicks.net
 * Description:       Add a custom type of case studies and a support for display posts with [display-posts post_type='case_studies']
 * Version:           1.0.0
 * Author:            Lary Stucker
 * Author URI:        https://freshclicks.net
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       hoag-case-studies
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

function create_post_type_case_studies() {
	register_post_type( 'case_studies',
	  array(
		'labels' => array(
		  'name' => __( 'Case Studies' ),
		  'singular_name' => __( 'Case Study' )
		),
		'public' => true,
		'has_archive' => true,
		'publicaly_queryable' => false, 
		'query_var' => false,
		'exclude_from_search' => true,
		'show_in_nav_menus' => false,
		'show_in_rest' => true,
		'menu_icon' => 'dashicons-welcome-learn-more',
		'supports' => array( 
			'title', 
			'editor', 
			'excerpt', 
			//'custom-fields', 
			'thumbnail',
			//'page-attributes', 
		),
		'rewrite' => array( 'slug' => 'case-studies' ),
		
	  )
	);
  }
  
  add_action( 'init', 'create_post_type_case_studies' );