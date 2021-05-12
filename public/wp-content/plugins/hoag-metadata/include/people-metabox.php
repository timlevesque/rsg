<?php 
/**
 * metabox data exclusively for People
 */

function people_options_metabox_defaults() {
    return array(
        'distinct_title' => '',
        'public_specialiy' => '',
        'endowed_chair' => '',
        'people-hero-img' => '',
        'facebook',
        'linkedin',
        'instagram',
        'twitter'
    );
}

function people_options_metabox() {
        add_meta_box(
            'people_options_metabox', // Metabox ID
            'Additional People Titles', // Title to display
            'people_options_render_metabox', // Function to call that contains the metabox content
            'hoag_treatments', // Post type
            'side', // Where to put it (normal = main colum, side = sidebar, etc.)
            'default' // Priority relative to other metaboxes
        );
}
add_action( 'add_meta_boxes', 'people_options_metabox');
    
// This is the function to display the metabox on the admin page.
function people_options_render_metabox() {
    
        // Variables
        global $post; // Get the current post data
        $saved = get_post_meta( $post->ID, 'post_options', true ); // Get the saved values
        $defaults = people_options_metabox_defaults(); // Get the default values 
        $details = wp_parse_args( $saved, $defaults ); // Merge the two in case any fields don't exist in the saved data
    ?>
    <fieldset>
        <p>    
            <label for="post_options_custom_metabox">
                <?php _e( 'Distinct Title', 'post_options' );?>
            </label>
            <br><small>Distinct Title given to this person at Hoag. i.e. - Program Manger.</small>
            <input
                style="width:100%;"
                type="text"
                name="post_options_custom_metabox[distinct_title]"
                id="post_options_custom_metabox_distinct_title"
                value="<?php echo esc_attr( $details['distinct_title'] ); ?>"
            >
        </p>
        <p>    
            <label for="post_options_custom_metabox">
                <?php _e( 'What I love', 'post_options' );?>
            </label>
            <input
                style="width:100%;"
                type="text"
                name="post_options_custom_metabox[public_specialty]"
                id="post_options_custom_metabox_public_specialiy"
                value="<?php echo esc_attr( $details['public_specialty'] ); ?>"
            >
        </p>
        <p>
            <input 
                type="checkbox" 
                id="post_options_custom_metabox_no_link" 
                name="post_options_custom_metabox[no_link]" 
                value="1"
                <?php
                    checked( $details['no_link'], '1' );
                ?>
            >
            <label for="post_options_custom_metabox">
                <?php _e( 'Remove Link', 'post_options' );?>
            </label>
        </p>
        <p>    
            <label for="post_options_custom_metabox">
                <?php _e( 'Focus Areas', 'post_options' );?>
            </label>
            <input
                style="width:100%;"
                type="text"
                name="post_options_custom_metabox[endowed_chair]"
                id="post_options_custom_metabox_endowed_chair"
                value="<?php echo esc_attr( $details['endowed_chair'] ); ?>"
            >
        </p>
        <p>    
            <label for="post_options_custom_metabox">
                <?php _e( 'Facebook', 'post_options' );?>
            </label>
            <input
                style="width:100%;"
                type="text"
                name="post_options_custom_metabox[facebook]"
                id="post_options_custom_metabox_facebook"
                value="<?php echo esc_attr( $details['facebook'] ); ?>"
            >
        </p>
        <p>    
            <label for="post_options_custom_metabox">
                <?php _e( 'Instagram', 'post_options' );?>
            </label>
            <input
                style="width:100%;"
                type="text"
                name="post_options_custom_metabox[instagram]"
                id="post_options_custom_metabox_instagram"
                value="<?php echo esc_attr( $details['instagram'] ); ?>"
            >
        </p>

        <p>    
            <label for="post_options_custom_metabox">
                <?php _e( 'Linkedin', 'post_options' );?>
            </label>
            <input
                style="width:100%;"
                type="text"
                name="post_options_custom_metabox[linkedin]"
                id="post_options_custom_metabox_linkedin"
                value="<?php echo esc_attr( $details['linkedin'] ); ?>"
            >
        </p>

        <p>    
            <label for="post_options_custom_metabox">
                <?php _e( 'Twitter', 'post_options' );?>
            </label>
            <input
                style="width:100%;"
                type="text"
                name="post_options_custom_metabox[twitter]"
                id="post_options_custom_metabox_twitter"
                value="<?php echo esc_attr( $details['twitter'] ); ?>"
            >
        </p>
        
        <p>    
            <label for="post_options_custom_metabox">
                <?php _e( 'People Hero Image', 'post_options' );?>
            </label>
            <br><small>Hero image for executives.</small>
            <input
                style="width:100%;"
                type="text"
                name="post_options_custom_metabox[people-hero-img]"
                id="post_options_custom_metabox_people-hero-img"
                value="<?php echo esc_attr( $details['people-hero-img'] ); ?>"
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
function people_options_save_metabox( $post_id, $post ) {
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
add_action( 'save_post', 'people_options_save_metabox', 1, 2 );

//API support
function people_metadata_content_register_rest(){
            register_rest_field( 'post', 'post_options',  [
                //Callback function used to retrieve the field value
                'get_callback' => function( $post ) {
                    return get_post_meta( $post['id'], 'post_options', true );
                },
            ]);
}
//add_action( 'rest_api_init', 'people_metadata_content_register_rest');
add_action( 'rest_api_init', 'people_metadata_content_register_rest');