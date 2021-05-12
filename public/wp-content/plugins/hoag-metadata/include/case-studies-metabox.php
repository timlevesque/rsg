<?php 
/**
 * metabox data exclusively for posts
 */

function case_studies_options_metabox_defaults() {
    return array(
        'city' => ''
    );
}


function case_studies_options_metabox() {
        add_meta_box(
            'case_studies_options_metabox', // Metabox ID
            'Post Options', // Title to display
            'case_studies_options_render_metabox', // Function to call that contains the metabox content
            'case_studies', // Post type
            'side', // Where to put it (normal = main colum, side = sidebar, etc.)
            'default' // Priority relative to other metaboxes
        );
}
add_action( 'add_meta_boxes', 'case_studies_options_metabox');
    
// This is the function to display the metabox on the admin page.
function case_studies_options_render_metabox() {
    
        // Variables
        global $post; // Get the current post data
        $saved = get_post_meta( $post->ID, 'case_studies_options', true ); // Get the saved values
        $defaults = case_studies_options_metabox_defaults(); // Get the default values 
        $details = wp_parse_args( $saved, $defaults ); // Merge the two in case any fields don't exist in the saved data
    ?>
    <fieldset>
        <p>    
            <label for="case_studies_options_custom_metabox">
                <?php _e( 'City or Area', 'case_studies_options' );?>
            </label>
            <br>
            <input
                style="width:100%;"
                type="text"
                name="case_studies_options_custom_metabox[city]"
                id="case_studies_options_custom_metabox_city"
                value="<?php echo esc_attr( $details['city'] ); ?>"
            >
        </p>
    </fieldset>        
    <?php
    // Security field
    // This validates that submission came from the
    // actual dashboard and not the front end or
    // a remote server.
    wp_nonce_field( 'case_studies_options_form_metabox_nonce', 'case_studies_options_form_metabox_process' );
}
// Save the metabox
function case_studies_options_save_metabox( $post_id, $post ) {
    // Verify that our security field exists. If not, bail.
    if ( !isset( $_POST['case_studies_options_form_metabox_process'] ) ) return;
    // Verify data came from edit/dashboard screen
    if ( !wp_verify_nonce( $_POST['case_studies_options_form_metabox_process'], 'case_studies_options_form_metabox_nonce' ) ) {
        return $post->ID;
    }
    // Verify user has permission to edit post
    if ( !current_user_can( 'edit_post', $post->ID )) {
        return $post->ID;
    }
    // Check that our custom fields are being passed along
    // This is the `name` value array. We can grab all
    // of the fields and their values at once.
    if ( !isset( $_POST['case_studies_options_custom_metabox'] ) ) {
        return $post->ID;
    }
        
    // Sanitize all data
    // Set up an empty array
    $sanitized = array();
    // Loop through each of our fields
    foreach ( $_POST['case_studies_options_custom_metabox'] as $key => $detail ) {
        // Sanitize the data and push it to our new array
        // `wp_filter_post_kses` strips our dangerous server values
        // and allows through anything you can include a post.
        $sanitized[$key] = wp_filter_post_kses( $detail );
    }
        
    update_post_meta($post->ID, 'case_studies_options', $sanitized);

}
add_action( 'save_post', 'case_studies_options_save_metabox', 1, 2 );

//API support
function case_studies_metadata_content_register_rest(){
            register_rest_field( 'post', 'case_studies_options',  [
                //Callback function used to retrieve the field value
                'get_callback' => function( $post ) {
                    return get_post_meta( $post['id'], 'case_studies_options', true );
                },
            ]);
}
//add_action( 'rest_api_init', 'case_studies_metadata_content_register_rest');
add_action( 'rest_api_init', 'case_studies_metadata_content_register_rest');