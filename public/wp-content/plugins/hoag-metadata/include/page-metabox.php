<?php 
/**
 * metabox data that is exclusive to pages
 */
$screens = array('page');

function page_options_metabox_defaults() {
    return array(
        'header_dark_mode' => '',
        'hero_title' => '',
        'hero_subtext' => '',
        'hero_cta' => '',
        'hero_link' => '',
        'hero_btn_wrapper_class' => '',
        'hero_wrapper_class' => '',
        'hero_image_anchor_top' => '',
    );
}

function page_options_metabox($screens) {
    foreach ($screens as $screen) {
        add_meta_box(
            'page_options_metabox', // Metabox ID
            'Page Options', // Title to display
            'page_options_render_metabox', // Function to call that contains the metabox content
            $screen, // Post type
            'side', // Where to put it (normal = main colum, side = sidebar, etc.)
            'default' // Priority relative to other metaboxes
        );
   }
}
add_action( 'add_meta_boxes', function() use ( $screens ) { 
    page_options_metabox( $screens ); });
    
// This is the function to display the metabox on the admin page.
function page_options_render_metabox() {
    
        // Variables
        global $post; // Get the current post data
        $saved = get_post_meta( $post->ID, 'post_options', true ); // Get the saved values
        $defaults = page_options_metabox_defaults(); // Get the default values
        $details = wp_parse_args( $saved, $defaults ); // Merge the two in case any fields don't exist in the saved data
    ?>
    <fieldset>
        <p>
            <input 
                type="checkbox" 
                id="post_options_custom_metabox_header_dark_mode" 
                name="post_options_custom_metabox[header_dark_mode]" 
                value="1"
                <?php
                    checked( $details['header_dark_mode'], '1' );
                ?>
            >
            <label for="post_options_custom_metabox">
                <?php _e( 'White Header Icons', 'post_options' );?>
            </label>
        </p>

        <p>
            <input 
                type="checkbox" 
                id="post_options_custom_metabox_hero_image_anchor_top" 
                name="post_options_custom_metabox[hero_image_anchor_top]" 
                value="1"
                <?php
                    checked( $details['hero_image_anchor_top'], '1' );
                ?>
            >
            <label for="post_options_custom_metabox">
                <?php _e( 'Anchor Hero Image to Top', 'post_options' );?>
            </label>
        </p>
        <p>
            <label for="post_options_custom_metabox">
                <?php _e( 'Hero Title', 'post_options' );?>
            </label>
            <input
                style="width:100%;"
                type="text"
                name="post_options_custom_metabox[hero_title]"
                id="post_options_custom_metabox_hero_title"
                value="<?php echo esc_attr( $details['hero_title'] ); ?>"
            >
        </p>
        <p>
            <label for="post_options_custom_metabox">
                <?php _e( 'Hero Subtext', 'post_options' );?>
            </label>
            <input
                style="width:100%;"
                type="text"
                name="post_options_custom_metabox[hero_subtext]"
                id="post_options_custom_metabox_hero_subtext"
                value="<?php echo esc_attr( $details['hero_subtext'] ); ?>"
            >
        </p>
        <p>
            <label for="post_options_custom_metabox">
                <?php _e( 'Hero CTA', 'post_options' );?>
            </label>
            <input
                style="width:100%;"
                type="text"
                name="post_options_custom_metabox[hero_cta]"
                id="post_options_custom_metabox_hero_cta"
                value="<?php echo esc_attr( $details['hero_cta'] ); ?>"
            >
        </p>
        <p>
            <label for="post_options_custom_metabox">
                <?php _e( 'Hero Link', 'post_options' );?>
            </label>
            <input
                style="width:100%;"
                type="text"
                name="post_options_custom_metabox[hero_link]"
                id="post_options_custom_metabox_hero_link"
                value="<?php echo esc_attr( $details['hero_link'] ); ?>"
            >
        </p>
        <p>
            <label for="post_options_custom_metabox">
                <?php _e( 'Hero Wrapper Class', 'post_options' );?>
            </label>
            <input
                style="width:100%;"
                type="text"
                name="post_options_custom_metabox[hero_wrapper_class]"
                id="post_options_custom_metabox_hero_wrapper_class"
                value="<?php echo esc_attr( $details['hero_wrapper_class'] ); ?>"
            >
        </p>
        <p>
            <label for="post_options_custom_metabox">
                <?php _e( 'Hero Button Wrapper Class', 'post_options' );?>
            </label>
            <input
                style="width:100%;"
                type="text"
                name="post_options_custom_metabox[hero_btn_wrapper_class]"
                id="post_options_custom_metabox_hero_btn_wrapper_class"
                value="<?php echo esc_attr( $details['hero_btn_wrapper_class'] ); ?>"
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
function page_options_save_metabox( $post_id, $post ) {
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
add_action( 'save_post', 'page_options_save_metabox', 1, 2 );

//API support
function page_metadata_content_register_rest($screens){
        foreach ($screens as $screen) {
            register_rest_field( $screen, 'post_options',  [
                //Callback function used to retrieve the field value
                'get_callback' => function( $post ) {
                    return get_post_meta( $post['id'], 'post_options', true );
                },
            ]);
        }
}
//add_action( 'rest_api_init', 'page_metadata_content_register_rest');
add_action( 'rest_api_init', function() use ( $screens ) { 
    page_metadata_content_register_rest( $screens ); });