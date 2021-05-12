<?php 
/**
 * metabox data that both pages and posts
 */
function mixed_options_metabox_defaults() {
    return array(
        'featured_video' => '',
    );
}
$screens = array('post', 'page', 'hoag_app_content');

function mixed_options_metabox($screens) {
    foreach ($screens as $screen) {
        add_meta_box(
            'mixed_options_metabox', // Metabox ID
            'Additional Options', // Title to display
            'mixed_options_render_metabox', // Function to call that contains the metabox content
            $screen, // Post type
            'side', // Where to put it (normal = main colum, side = sidebar, etc.)
            'default' // Priority relative to other metaboxes
        );
   }
}
add_action( 'add_meta_boxes', function() use ( $screens ) { 
    mixed_options_metabox( $screens ); });
    
// This is the function to display the metabox on the admin page.
function mixed_options_render_metabox() {
    
        // Variables
        global $post; // Get the current post data
        $saved = get_post_meta( $post->ID, 'post_options', true ); // Get the saved values
        $defaults = mixed_options_metabox_defaults(); // Get the default values
        $details = wp_parse_args( $saved, $defaults ); // Merge the two in case any fields don't exist in the saved data
    ?>
    <fieldset>
        <p>
            <label for="post_options_custom_metabox">
                <?php _e( 'Featured Video', 'post_options' );?>
            </label>
            <br><small>Link to a YouTube or Vimeo video. If used for a class, it must be a YouTube link.</small>
            <input
                style="width:100%;"
                type="text"
                name="post_options_custom_metabox[featured_video]"
                id="post_options_custom_metabox_featured_"
                value="<?php echo esc_attr( $details['featured_video'] ); ?>"
             >
        </p> 
    </fieldset>        
    <?php
    // Security field
    // This validates that submission came from the
    // actual dashboard and not the front end or
    // a remote server.
    wp_nonce_field( 'post_options_form_metabox_nonce', 'post_options_form_metabox_process' );
}
// Save the metabox
function mixed_options_save_metabox( $post_id, $post ) {
    // Verify that our security field exists. If not, bail.
    if ( !isset( $_POST['post_options_form_metabox_process'] ) ) return;
    // Verify data came from edit/dashboard screen
    if ( !wp_verify_nonce( $_POST['post_options_form_metabox_process'], 'post_options_form_metabox_nonce' ) ) {
        return $post->ID;
    }
    // Verify user has permission to edit post
    if ( !current_user_can( 'edit_post', $post->ID )) {
        return $post->ID;
    }
    // Check that our custom fields are being passed along
    // This is the `name` value array. We can grab all
    // of the fields and their values at once.
    if ( !isset( $_POST['post_options_custom_metabox'] ) ) {
        return $post->ID;
    }
        
    // Sanitize all data
    // Set up an empty array
    $sanitized = array();
    // Loop through each of our fields
    foreach ( $_POST['post_options_custom_metabox'] as $key => $detail ) {
        // Sanitize the data and push it to our new array
        // `wp_filter_post_kses` strips our dangerous server values
        // and allows through anything you can include a post.
        $sanitized[$key] = wp_filter_post_kses( $detail );
    }
        
    update_post_meta($post->ID, 'post_options', $sanitized);

}
add_action( 'save_post', 'mixed_options_save_metabox', 1, 2 );

//API support
function mixed_metadata_content_register_rest($screens){
        foreach ($screens as $screen) {
            register_rest_field( $screen, 'post_options',  [
                //Callback function used to retrieve the field value
                'get_callback' => function( $post ) {
                    return get_post_meta( $post['id'], 'post_options', true );
                },
            ]);
        }
}
//add_action( 'rest_api_init', 'mixed_metadata_content_register_rest');
add_action( 'rest_api_init', function() use ( $screens ) { 
    mixed_metadata_content_register_rest( $screens ); });