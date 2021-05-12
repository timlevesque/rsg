<?php
/*
* Create a metabox with multiple fields.
*/

/**
 * Create the metabox
 * @link https://developer.wordpress.org/reference/functions/add_meta_box/
*/
function rsg_listing_create_metabox() {
	// Can only be used on a single post type (ie. page or post or a custom post type).
	// Must be repeated for each post type you want the metabox to appear on.
	add_meta_box(
			'rsg_listing_metabox', // Metabox ID
			'Listing Meta Data', // Title to display
			'rsg_listing_render_metabox', // Function to call that contains the metabox content
			'rsg_listings', // Post type to display metabox on
			'normal', // Where to put it (normal = main colum, side = sidebar, etc.)
			'default' // Priority relative to other metaboxes
		);
}
add_action( 'add_meta_boxes', 'rsg_listing_create_metabox' );

// Create the metabox default values
// This allows us to save multiple values in an array, reducing the size of our database.
// Setting defaults helps avoid "array key doesn't exit" issues.
function rsg_listing_metabox_defaults() {
	return array(
        'listing_type' => '', 
        'listing_size'   => '',
       	'listing_status' => '',
        'listing_zone' => '',
        'listing_link' => '',
        'address1' => '',
        'address2' => '',
        'city' => '',
        'state' => '',
        'zip' => ''

	);
}
// Render the metabox markup
// This is the function called in `rsg_listing_create_metabox()`
function rsg_listing_render_metabox() {

	// Variables
	global $post; // Get the current post data
	$saved = get_post_meta( $post->ID, 'rsg_listing', true ); // Get the saved values
	$defaults = rsg_listing_metabox_defaults(); // Get the default values
	$details = wp_parse_args( $saved, $defaults ); // Merge the two in case any fields don't exist in the saved data
	?>
		<fieldset>
		<div>
				<label for="rsg_listing_custom_metabox_listing_type">
					<?php _e( 'Listing Type', 'rsg_listing' );?>
				</label>
				<input
					type="text"
					name="rsg_listing_custom_metabox[listing_type]"
					id="rsg_listing_custom_metabox_listing_type"
					value="<?php echo esc_attr( $details['listing_type'] ); ?>"
					size="50"
				>
			</div>
			<div>
				<label for="rsg_listing_custom_metabox_listing_size">
					<?php _e( 'Size', 'rsg_listing' );?>
				</label>
				<input
					type="text"
					name="rsg_listing_custom_metabox[listing_size]"
					id="rsg_listing_custom_metabox_listing_size"
					value="<?php echo esc_attr( $details['listing_size'] ); ?>"
					size="50"
				>
			</div>
		 <div>
				<label for="rsg_listing_custom_metabox_listing_status">
					<?php  _e( 'Status', 'rsg_listing' ); ?>
				</label>
				<input
					type="text"
					name="rsg_listing_custom_metabox[listing_status]"
					id="rsg_listing_custom_metabox_listing_status"
					value="<?php  echo esc_attr( $details['listing_status'] ); ?>"
					size="50"
				>
			</div>
			<div>
				<label for="rsg_listing_custom_metabox_listing_zone">
					<?php _e( 'Zone', 'rsg_listing' );?>
				</label>
				<input
					type="text"
					name="rsg_listing_custom_metabox[listing_zone]"
					id="rsg_listing_custom_metabox_listing_zone"
					value="<?php echo esc_attr( $details['listing_zone'] ); ?>"
					size="20"
				>
			</div>
			<div>
				<label for="rsg_listing_custom_metabox_listing_link">
					<?php _e( 'External link', 'rsg_listing' );?>
				</label>
				<input
					type="text"
					name="rsg_listing_custom_metabox[listing_link]"
					id="rsg_listing_custom_metabox_listing_link"
					value="<?php echo esc_attr( $details['listing_link'] ); ?>"
					size="50"
				>
			</div>

			
			<hr>
			<h4>Address</h4>
			<div>
				<label for="rsg_listing_custom_metabox_address1">
					<?php _e( 'Address 1', 'rsg_listing' );?>
				</label>
				<input
					type="text"
					name="rsg_listing_custom_metabox[address1]"
					id="rsg_listing_custom_metabox_address1"
					value="<?php echo esc_attr( $details['address1'] ); ?>"
					size="30"
				>
			</div>
			<div>
				<label for="rsg_listing_custom_metabox_address2">
					<?php _e( 'Address 2', 'rsg_listing' );?>
				</label>
				<input
					type="text"
					name="rsg_listing_custom_metabox[address2]"
					id="rsg_listing_custom_metabox_address2"
					value="<?php echo esc_attr( $details['address2'] ); ?>"
					size="30"
				>
			</div>
			<div>
				<label for="rsg_listing_custom_metabox_city">
					<?php _e( 'City', 'rsg_listing' );?>
				</label>
				<input
					type="text"
					name="rsg_listing_custom_metabox[city]"
					id="rsg_listing_custom_metabox_city"
					value="<?php echo esc_attr( $details['city'] ); ?>"
					size="30"
				>
			</div>
			<div>
				<label for="rsg_listing_custom_metabox_state">
					<?php _e( 'State Abbreviation', 'rsg_listing' );?>
				</label>
				<input
					type="text"
					name="rsg_listing_custom_metabox[state]"
					id="rsg_listing_custom_metabox_state"
					value="<?php echo esc_attr( $details['state'] ); ?>"
					size="2"
				>
			</div>
			<div>
				<label for="rsg_listing_custom_metabox_zip">
					<?php _e( 'zip', 'rsg_listing' );?>
				</label>
				<input
					type="text"
					name="rsg_listing_custom_metabox[zip]"
					id="rsg_listing_custom_metabox_zip"
					value="<?php echo esc_attr( $details['zip'] ); ?>"
					size="10"
				>
			</div>
		</fieldset>
	<?php
	// Security field
	// This validates that submission came from the
	// actual dashboard and not the front end or
	// a remote server.
	wp_nonce_field( 'rsg_listing_form_metabox_nonce', 'rsg_listing_form_metabox_process' );
}
// Save the metabox
function rsg_listing_save_metabox( $post_id, $post ) {
	// Verify that our security field exists. If not, bail.
	if ( !isset( $_POST['rsg_listing_form_metabox_process'] ) ) return;
	// Verify data came from edit/dashboard screen
	if ( !wp_verify_nonce( $_POST['rsg_listing_form_metabox_process'], 'rsg_listing_form_metabox_nonce' ) ) {
		return $post->ID;
	}
	// Verify user has permission to edit post
	if ( !current_user_can( 'edit_post', $post->ID )) {
		return $post->ID;
	}
	// Check that our custom fields are being passed along
	// This is the `name` value array. We can grab all
	// of the fields and their values at once.
	if ( !isset( $_POST['rsg_listing_custom_metabox'] ) ) {
		return $post->ID;
	}
	
	// Sanitize all data
	// Set up an empty array
	$sanitized = array();
	// Loop through each of our fields
	foreach ( $_POST['rsg_listing_custom_metabox'] as $key => $detail ) {
		// Sanitize the data and push it to our new array
		// `wp_filter_post_kses` strips our dangerous server values
		// and allows through anything you can include a post.
		$sanitized[$key] = wp_filter_post_kses( $detail );
	}
	// Save our submissions to the database
	update_post_meta( $post->ID, 'rsg_listing', $sanitized );
}
add_action( 'save_post', 'rsg_listing_save_metabox', 1, 2 );

// Save a copy to our revision history
// This is optional, and potentially undesireable for certain data types.
// Restoring a a post to an old version will also update the metabox.

function rsg_listing_save_revisions( $post_id ) {
	// Check if it's a revision
	$parent_id = wp_is_post_revision( $post_id );
	// If is revision
	if ( $parent_id ) {
		// Get the saved data
		$parent = get_post( $parent_id );
		$details = get_post_meta( $parent->ID, 'rsg_listing', true );
		// If data exists and is an array, add to revision
		if ( !empty( $details ) && is_array( $details ) ) {
			// Get the defaults
			$defaults = rsg_listing_metabox_defaults();
			// For each default item
			foreach ( $defaults as $key => $value ) {
				// If there's a saved value for the field, save it to the version history
				if ( array_key_exists( $key, $details ) ) {
					add_metadata( 'post', $post_id, 'rsg_listing_' . $key, $details[$key] );
				}
			}
		}
	}
}
add_action( 'save_post', 'rsg_listing_save_revisions' );

// Restore events data with post revisions
function rsg_listing_restore_revisions( $post_id, $revision_id ) {
	// Variables
	$post = get_post( $post_id ); // The post
	$revision = get_post( $revision_id ); // The revision
	$defaults = rsg_listing_metabox_defaults(); // The default values
	$details = array(); // An empty array for our new metadata values
	// Update content
	// For each field
	foreach ( $defaults as $key => $value ) {
		// Get the revision history version
		$detail_revision = get_metadata( 'post', $revision->ID, 'rsg_listing_' . $key, true );
		// If a historic version exists, add it to our new data
		if ( isset( $detail_revision ) ) {
			$details[$key] = $detail_revision;
		}
	}
	// Replace our saved data with the old version
	update_post_meta( $post_id, 'rsg_listing', $details );
}
add_action( 'wp_restore_post_revision', 'rsg_listing_restore_revisions', 10, 2 );

//Get the data to display on the revisions page
function rsg_listing_get_revisions_fields( $fields ) {
	// Get our default values
	$defaults = rsg_listing_metabox_defaults();
	// For each field, use the key as the title
	foreach ( $defaults as $key => $value ) {
		$fields['rsg_listing_' . $key] = ucfirst( $key );
	}
	return $fields;
}
add_filter( '_wp_post_revision_fields', 'rsg_listing_get_revisions_fields' );

// Display the data on the revisions page
function rsg_listing_display_revisions_fields( $value, $field ) {
	global $revision;
	return get_metadata( 'post', $revision->ID, $field, true );
}
add_filter( '_wp_post_revision_field_hoag_meta', 'rsg_listing_display_revisions_fields', 10, 2 );