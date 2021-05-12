<?php 
/**
 * metabox data exclusively for app
 */

function app_options_metabox_defaults() {
    return array(
        'baby_size' => '',
        'baby_weight' => '',
    );
}


function app_options_metabox() {
        add_meta_box(
            'app_options_metabox', // Metabox ID
            'App Options', // Title to display
            'app_options_render_metabox', // Function to call that contains the metabox content
            'hoag_app_content', // Post type
            'side', // Where to put it (normal = main colum, side = sidebar, etc.)
            'default' // Priority relative to other metaboxes
        );
}
add_action( 'add_meta_boxes', 'app_options_metabox');
    
// This is the function to display the metabox on the admin page.
function app_options_render_metabox() {
    
        // Variables
        global $post; // Get the current post data
        $saved = get_post_meta( $post->ID, 'app_options', true ); // Get the saved values
        $defaults = app_options_metabox_defaults(); // Get the default values 
        $details = wp_parse_args( $saved, $defaults ); // Merge the two in case any fields don't exist in the saved data
    ?>
    <fieldset>
        <p>    
            <label for="app_options_custom_metabox">
                <?php _e( 'Baby size', 'app_options' );?>
            </label>
            <br><small>baby size in Inches</small>
            <input
                style="width:100%;"
                type="text"
                name="app_options_custom_metabox[baby_size]"
                id="app_options_custom_metabox_baby_size"
                value="<?php echo esc_attr( $details['baby_size'] ); ?>"
            >
        </p>
    </fieldset>   
    <fieldset>
        <p>    
            <label for="app_options_custom_metabox">
                <?php _e( 'Baby Weight', 'app_options' );?>
            </label>
            <br><small>baby Weight in ounces and pounds</small>
            <input
                style="width:100%;"
                type="text"
                name="app_options_custom_metabox[baby_weight]"
                id="app_options_custom_metabox_baby_weight"
                value="<?php echo esc_attr( $details['baby_weight'] ); ?>"
            >
        </p>
    </fieldset>       
    <?php
    // Security field
    // This validates that submission came from the
    // actual dashboard and not the front end or
    // a remote server.
    wp_nonce_field( 'app_options_form_metabox_nonce', 'app_options_form_metabox_process' );
}
// Save the metabox
function app_options_save_metabox( $post_id, $post ) {
    // Verify that our security field exists. If not, bail.
    if ( !isset( $_POST['app_options_form_metabox_process'] ) ) return;
    // Verify data came from edit/dashboard screen
    if ( !wp_verify_nonce( $_POST['app_options_form_metabox_process'], 'app_options_form_metabox_nonce' ) ) {
        return $post->ID;
    }
    // Verify user has permission to edit post
    if ( !current_user_can( 'edit_post', $post->ID )) {
        return $post->ID;
    }
    // Check that our custom fields are being passed along
    // This is the `name` value array. We can grab all
    // of the fields and their values at once.
    if ( !isset( $_POST['app_options_custom_metabox'] ) ) {
        return $post->ID;
    }
        
    // Sanitize all data
    // Set up an empty array
    $sanitized = array();
    // Loop through each of our fields
    foreach ( $_POST['app_options_custom_metabox'] as $key => $detail ) {
        // Sanitize the data and push it to our new array
        // `wp_filter_post_kses` strips our dangerous server values
        // and allows through anything you can include a post.
        $sanitized[$key] = wp_filter_post_kses( $detail );
    }
        
    update_post_meta($post->ID, 'app_options', $sanitized);

}
add_action( 'save_post', 'app_options_save_metabox', 1, 2 );

//API support
function app_metadata_content_register_rest(){
            register_rest_field( 'hoag_app_content', 'app_options',  [
                //Callback function used to retrieve the field value
                'get_callback' => function( $post ) {
                    return get_post_meta( $post['id'], 'app_options', true );
                },
            ]);
}
add_action( 'rest_api_init', 'app_metadata_content_register_rest');