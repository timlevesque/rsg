<?php
/*
Plugin Name: Hoag global & custom tags
Plugin URI:
Description: create custom tags for all global pages
Version: 1.0.2
Author: Lary Stucker
Author URI:
License: GPLv2 or later
*/

use HoagPeople\People;

// set post and page types that will have global tags.
$global_types = array(
    'post', 
    'page', 
    'hoag_locations', 
    'case_studies', 
    'hoag_treatments', 
    'hoag_procedures',
    'hoag_app_content',
    'hoag_merch_content',
	'event',
	'hoag-person',
);

/*
 * Institute taxonomy * 
 */

/* // create Institute taxonomy
function create_institute_taxonomies($global_types) {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name' => _x( 'Institutes', 'taxonomy general name' ),
		'singular_name' => _x( 'Institute', 'taxonomy singular name' ),
		'search_items' => __( 'Search Institutes' ),
		'all_items' => __( 'All Institutes' ),
		'edit_item' => __( 'Edit Institute' ),
		'update_item' => __( 'Update Institute' ),
		'add_new_item' => __( 'Add New Institute' ),
		'new_item_name' => __( 'New Institute Name' ),
		'menu_name' => __( 'Institute' ),
	);

	$args = array(
		'hierarchical' => true, //displays as picklist or as a freeform field
		'labels' => $labels,
		'show_ui' => true,
		'show_in_rest' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'institute' ),
	);

	register_taxonomy( 'institute', $global_types, $args);
} */

/*
 * Program taxonomy * 
 */

// create Program taxonomy
/* function create_program_taxonomies($global_types) {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name' => _x( 'Programs', 'taxonomy general name' ),
		'singular_name' => _x( 'Program', 'taxonomy singular name' ),
		'search_items' => __( 'Search Programs' ),
		'all_items' => __( 'All Programs' ),
		'edit_item' => __( 'Edit Program' ),
		'update_item' => __( 'Update Program' ),
		'add_new_item' => __( 'Add New Program' ),
		'new_item_name' => __( 'New Program Name' ),
		'menu_name' => __( 'Program' ),
	);

	$args = array(
		'hierarchical' => true, //displays as picklist or as a freeform field
		'labels' => $labels,
		'show_ui' => true,
		'show_in_rest' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'program' ),
	);

	register_taxonomy( 'program', $global_types, $args);
} */

/*
 * Practice taxonomy * 
 */

// create Practice taxonomy
function create_practice_taxonomies($global_types) {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name' => _x( 'Practice Areas', 'taxonomy general name' ),
		'singular_name' => _x( 'Practice Area', 'taxonomy singular name' ),
		'search_items' => __( 'Search Practice Areas' ),
		'all_items' => __( 'All Practice Areas' ),
		'edit_item' => __( 'Edit Practice Area' ),
		'update_item' => __( 'Update Practice Area' ),
		'add_new_item' => __( 'Add New Practice Area' ),
		'new_item_name' => __( 'New Practice Area Name' ),
		'menu_name' => __( 'Practice Area' ),
	);

	$args = array(
		'hierarchical' => true, //displays as picklist or as a freeform field
		'labels' => $labels,
		'show_ui' => true,
		'show_in_rest' => true,
		'show_admin_column' => false,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'practice-areas' ),
	);

	register_taxonomy( 'practice-area', $global_types, $args);
}

/*
 * App taxonomy * 
 */

// create App taxonomy
/* function create_app_taxonomies($global_types) {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name' => _x( 'App Modules', 'taxonomy general name' ),
		'singular_name' => _x( 'App Module', 'taxonomy singular name' ),
		'search_items' => __( 'Search App Modules' ),
		'all_items' => __( 'All App Modules' ),
		'edit_item' => __( 'Edit App Module' ),
		'update_item' => __( 'Update App Module' ),
		'add_new_item' => __( 'Add New App Module' ),
		'new_item_name' => __( 'New App Module Name' ),
		'menu_name' => __( 'App Modules' ),
	);

	$args = array(
		'hierarchical' => true, //displays as picklist or as a freeform field
		'labels' => $labels,
		'show_ui' => true,
		'show_in_rest' => true,
		'show_admin_column' => false,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'app-module-tax' ),
	);

	register_taxonomy( 'app-module-tax', $global_types, $args);
}
 */
/*
 * Marketing Owner * 
 */

 /* // create Marketing Owner taxonomy
function create_marketing_owner_taxonomies($global_types) {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name' => _x( 'Marketing Owners', 'taxonomy general name' ),
		'singular_name' => _x( 'Marketing Owner', 'taxonomy singular name' ),
		'search_items' => __( 'Search Marketing Owners' ),
		'all_items' => __( 'All Marketing Owners' ),
		'edit_item' => __( 'Edit Marketing Owner' ),
		'update_item' => __( 'Update Marketing Owner' ),
		'add_new_item' => __( 'Add Marketing Owner' ),
		'new_item_name' => __( 'New Marketing Owner' ),
		'menu_name' => __( 'Marketing Owner' ),
	);

	$args = array(
		'hierarchical' => true, //displays as picklist or as a freeform field
		'labels' => $labels,
		'show_ui' => true,
		'show_in_rest' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'marketing-owner-tag' ),
		'capabilities' => array(
			'manage_terms' => true,
			'edit_terms' => true,
			'delete_terms' => true,
			'assign_terms' => true,
		)
	);

	register_taxonomy( 'marketing-owner-tag', $global_types, $args);
} */

//create custom taxonimes for filtering
add_action('init', 
    function() use ( $global_types ) { 
        /* create_institute_taxonomies( $global_types ); 
        create_program_taxonomies( $global_types ); */
        create_practice_taxonomies( $global_types );
/*         create_marketing_owner_taxonomies( $global_types );
        create_app_taxonomies( $global_types );       */  
    }
);

function hoag_global_tags_enqueue($hook) {
	wp_enqueue_script('autocomplete', plugin_dir_url(__FILE__).'assets/jquery.auto-complete.min.js', array('jquery'));
	wp_enqueue_script('hoag-global-tag.js', plugin_dir_url(__FILE__).'assets/hoag-global-tag.js', array('jquery', 'autocomplete'));
	wp_enqueue_style('autocomplete.css', plugin_dir_url(__FILE__).'assets/jquery.auto-complete.css');
}

add_action('admin_enqueue_scripts', 'hoag_global_tags_enqueue');

//get listings for 'works at' on submit listing page
add_action('wp_ajax_nopriv_get_listing_names', 'hoag_global_tags_ajax_user_listings');
add_action('wp_ajax_get_listing_names', 'hoag_global_tags_ajax_user_listings');

function hoag_global_tags_ajax_user_listings() {
	global $wpdb; //get access to the WordPress database object variable

	//get names of all businesses
	$name = $wpdb->esc_like(stripslashes($_POST['name'])).'%'; //escape for use in LIKE statement
	$sql = "select display_name 
		from $wpdb->users 
		where display_name like %s";

	$sql = $wpdb->prepare($sql, $name);
	
	$results = $wpdb->get_results($sql);

	//copy the business titles to a simple array
	$titles = array();
	foreach( $results as $r )
		$titles[] = addslashes($r->display_name);
		
	echo json_encode($titles); //encode into JSON format and output

	die(); //stop "0" from being output
}

/*
 * post Type in posts only * 
 */

 //create custom taxonimes for posts only
 add_action( 'init', 'create_post_type_taxonomies' );

 // create post type taxonomy
function create_post_type_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name' => _x( 'Article Types', 'taxonomy general name' ),
		'singular_name' => _x( 'Article Type', 'taxonomy singular name' ),
		'search_items' => __( 'Search Article Types' ),
		'all_items' => __( 'All Article Types' ),
		'edit_item' => __( 'Edit Article Type' ),
		'update_item' => __( 'Update Article Type' ),
		'add_new_item' => __( 'Add Article Type' ),
		'new_item_name' => __( 'New Article Type' ),
		'menu_name' => __( 'Article Types' ),
	);

	$args = array(
		'hierarchical' => true, //displays as picklist or as a freeform field
		'labels' => $labels,
		'show_ui' => true,
		'show_in_rest' => true,
		'show_admin_column' => false,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'articles/types' ),
		'capabilities' => array(
			'manage_terms' => true,
			'edit_terms' => true,
			'delete_terms' => true,
			'assign_terms' => true,
		)
	);

	register_taxonomy( 'article-types', 'post', $args);
}

/*
 * Publications in posts only * 
 */

 //create custom taxonimes for posts only
 /* add_action( 'init', 'create_pubs_taxonomies' );

 // create pubs taxonomy
function create_pubs_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name' => _x( 'Post Publications', 'taxonomy general name' ),
		'singular_name' => _x( 'Publication', 'taxonomy singular name' ),
		'search_items' => __( 'Search Publications' ),
		'all_items' => __( 'All Publications' ),
		'edit_item' => __( 'Edit Publications' ),
		'update_item' => __( 'Update Publication' ),
		'add_new_item' => __( 'Add Publication' ),
		'new_item_name' => __( 'New Publication' ),
		'menu_name' => __( 'Publications' ),
	);

	$args = array(
		'hierarchical' => true, //displays as picklist or as a freeform field
		'labels' => $labels,
		'show_ui' => true,
		'show_in_rest' => true,
		'show_admin_column' => false,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'publications' ),
		'capabilities' => array(
			'manage_terms' => true,
			'edit_terms' => true,
			'delete_terms' => true,
			'assign_terms' => true,
		)
	);

	register_taxonomy( 'publications', 'post', $args);
} */

/*
 * Attributed Author in posts only * 
 */

 //create custom taxonimes for posts only
 add_action( 'init', 'create_attributed_author_taxonomies' );

 // create People Mentioned taxonomy
function create_attributed_author_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name' => _x( 'Attributed Authors', 'taxonomy general name' ),
		'singular_name' => _x( 'Attributed Author', 'taxonomy singular name' ),
		'search_items' => __( 'Attributed Authors' ),
		'all_items' => __( 'All Attributed Authors' ),
		'edit_item' => __( 'Edit Attributed Author' ),
		'update_item' => __( 'Update Attributed Author' ),
		'add_new_item' => __( 'Add Attributed Author' ),
		'new_item_name' => __( 'New Attributed Author' ),
		'menu_name' => __( 'Attributed Authors' ),
	);

	$args = array(
		'hierarchical' => false, //displays as picklist or as a freeform field
		'labels' => $labels,
		'show_ui' => true,
		'show_in_rest' => true,
		'show_admin_column' => false,
		'query_var' => true,
		'capabilities' => array(
			'manage_terms' => true,
			'edit_terms' => true,
			'delete_terms' => true,
			'assign_terms' => true,
		)
	);

	register_taxonomy( 'attributed-authors', 'post', $args);
}

/*
 * People Mentioned in posts only * 
 */

 //create custom taxonimes for posts only
 /* add_action( 'init', 'create_people_mentioned_taxonomies' );

 // create People Mentioned taxonomy
function create_people_mentioned_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name' => _x( 'People Menetioned', 'taxonomy general name' ),
		'singular_name' => _x( 'Person', 'taxonomy singular name' ),
		'search_items' => __( 'Search People' ),
		'all_items' => __( 'All People' ),
		'edit_item' => __( 'Edit People' ),
		'update_item' => __( 'Update People' ),
		'add_new_item' => __( 'Add People' ),
		'new_item_name' => __( 'New People Mentioned' ),
		'menu_name' => __( 'People Mentioned' ),
	);

	$args = array(
		'hierarchical' => false, //displays as picklist or as a freeform field
		'labels' => $labels,
		'show_ui' => true,
		'show_in_rest' => true,
		'show_admin_column' => false,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'people-mentioned-tag' ),
		'capabilities' => array(
			'manage_terms' => true,
			'edit_terms' => true,
			'delete_terms' => true,
			'assign_terms' => true,
		)
	);

	register_taxonomy( 'people-mentioned-tag', 'post', $args);
} */

add_action( 'init', 'register_locations_tax_for_people' , 11);

function register_locations_tax_for_people() {
            
	register_taxonomy('location-tag', 'hoag-person', [
		'public'                => true,
		'hierarchical'          => true,
		'show_in_rest' 			=> true,
		'show_admin_column'     => false,
		'show_in_nav_menus'     => true,
		'show_ui' 				=> true,
		'labels'                => [
			'name'  => 'Locations', 'location-tag',
		],
		'capabilities' => [
			'manage_terms' => true,
			'edit_terms' => true,
			'delete_terms' => true,
			'assign_terms' => true,
		]
	]);
	
	//get all location posts
	$args = [
		'post_type'     => 'hoag_locations',
		'posts_per_page'=> -1,
	];
	$wp_query = new WP_Query($args);

	$locations = [];
	$posts = $wp_query->posts;
	foreach( $posts as $post ){
		$locations[] = $post->post_title;
	}

	//insert post names as terms
	foreach ($locations as $location){
		wp_insert_term($location, 'location-tag');
	}
}

add_action( 'delete_post', 'delete_location_tag_term' );
function delete_location_tag_term( $post_id ){
	$post_type = get_post_type( $post_id );
	$post_status = get_post_status( $post_id );
	$slug = get_post_field( 'post_name', $post_id );
	$term_id = 0;

	if ($post_type == 'hoag_locations' && $post_status == 'trash') {
		$terms = get_terms([
			'taxonomy' => 'location-tag',
			'hide_empty' => false,
			]);
		foreach( $terms as $term ){	
			//__trashed is appended to slug on delete action	
			if ($term->slug . '__trashed' == $slug){
				$term_id = $term->term_id;
				wp_delete_term($term_id, 'location-tag');
			}
		}
	} 
	elseif ($post_type == 'hoag-person' && $post_status == 'trash') {
		$terms = get_terms([
			'taxonomy' => [
				/* 'people-mentioned-tag', */
				'attributed-authors'
			],
			'hide_empty' => false,
			]);
		foreach( $terms as $term ){	
			//__trashed is appended to slug on delete action	
			if ($term->slug . '__trashed' == $slug){
				$term_id = $term->term_id;
				/* wp_delete_term($term_id, 'people-mentioned-tag'); */
				wp_delete_term($term_id, 'attributed-authors');
			}
		}
	}
 }



register_activation_hook(  __FILE__ , 'register_people_as_terms');

function register_people_as_terms() {
	//ensure taxonomies and posts are created first
	/* create_people_mentioned_taxonomies(); */
	create_attributed_author_taxonomies();
	People::setup();

	$args = [
		'post_type'     => 'hoag-person',
		'posts_per_page'=> -1,
	];
	$wp_query = new WP_Query($args);

	$people = [];
	$posts = $wp_query->posts;
	foreach( $posts as $post ){
		$people[] = $post->post_title;
	}

	//insert post names as terms
	foreach ($people as $person){
		/* if (get_term_by('name', $person, 'people-mentioned-tag') === false ){
			wp_insert_term($person, 'people-mentioned-tag');
		} */
		if (get_term_by('name', $person, 'attributed-authors') === false ){ 
		wp_insert_term($person, 'attributed-authors');
		}
	}
}


add_action( 'save_post_hoag-person', 'people_post_creation', 11, 3 );

function people_post_creation( $post_id, $post, $update ) {
	if ( wp_is_post_revision( $post_id ) ){
		return;
	}
	$name = get_the_title($post_id);
	if (isset($name)) {
	/* 	if ( get_term_by('name', $name, 'people-mentioned-tag') === false ){
			wp_insert_term($name, 'people-mentioned-tag');
		} */
		if (get_term_by('name', $name, 'attributed-authors') === false ){ 
			wp_insert_term($name, 'attributed-authors');
		}
	}
}