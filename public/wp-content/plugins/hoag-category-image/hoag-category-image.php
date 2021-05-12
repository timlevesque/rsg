<?php
/*
Plugin Name: Hoag category and tag image
Plugin URI:
Description: support featured images in the category and tags
Version: 0.0.2
Author: Lary Stucker
Author URI:
License: GPLv2 or later
*/

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
);

/**
 * Plugin class
 **/
if ( ! class_exists( 'FC_TAX_META' ) ) {

    class FC_TAX_META {
    
      public function __construct() {
        //
      }
     
     /*
      * Initialize the class and start calling our hooks and filters
      * @since 1.0.0
     */
    public function init() {

        $prefix_taxonomies = array(
            'category',
            'post_tag',
            'app-module-tax',
            'publications',
            'article-types',
        );
        foreach($prefix_taxonomies as $prefix_taxonomy){
            add_action( sprintf( '%s_add_form_fields', $prefix_taxonomy ), array ( $this, 'add_category_image' ), 10, 2 );
            add_action( sprintf( 'created_%s', $prefix_taxonomy ), array ( $this, 'save_category_image' ), 10, 2 );
            add_action( sprintf( '%s_edit_form_fields', $prefix_taxonomy ), array ( $this, 'update_category_image' ), 10, 2 );
            add_action( sprintf( 'edited_%s', $prefix_taxonomy ), array ( $this, 'updated_category_image' ), 10, 2 );
        }

       add_action( 'admin_enqueue_scripts', array( $this, 'load_media' ) );
       add_action( 'admin_footer', array ( $this, 'add_script' ) );
       add_action( 'rest_api_init',  array ( $this, 'featured_image_register_rest' ) );
  
       
       /*tag support
       add_action('post_tag_edit_form_fields', array ( $this, 'update_category_image' ), 10, 2 );
       add_action( 'created_post_tag', array ( $this, 'save_category_image' ), 10, 2 );
       add_action( 'post_tag_add_form_fields', array ( $this, 'add_category_image' ), 10, 2 );
       add_action( 'edited_post_tag', array ( $this, 'updated_category_image' ), 10, 2 );
       */
       

    }
    
    public function load_media() {
     wp_enqueue_media();
    }
     
     /*
      * Add a form field in the new category page
      * @since 1.0.0
     */
     public function add_category_image ( $taxonomy ) { ?>
       <div class="form-field term-group">
         <label for="category-image-id"><?php _e('Image', 'hero-theme'); ?></label>
         <input type="hidden" id="category-image-id" name="category-image-id" class="custom_media_url" value="">
         <div id="category-image-wrapper"></div>
         <p>
           <input type="button" class="button button-secondary FC_TAX_media_button" id="FC_TAX_media_button" name="FC_TAX_media_button" value="<?php _e( 'Add Image', 'hero-theme' ); ?>" />
           <input type="button" class="button button-secondary FC_TAX_media_remove" id="FC_TAX_media_remove" name="FC_TAX_media_remove" value="<?php _e( 'Remove Image', 'hero-theme' ); ?>" />
        </p>
       </div>
     <?php
     }

     
     /*
      * Save the form field
      * @since 1.0.0
     */
     public function save_category_image ( $term_id, $tt_id ) {
       if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
         $image = $_POST['category-image-id'];
         add_term_meta( $term_id, 'category-image-id', $image, true );
       }
     }
     
     /*
      * Edit the form field
      * @since 1.0.0
     */
    
     public function update_category_image ( $term, $taxonomy ) { ?>
        <tr class="form-field term-group-wrap">
          <th scope="row">
            <label for="category-image-id"><?php _e( 'Image', 'hero-theme' ); ?></label>
          </th>
          <td>
            <?php $image_id = get_term_meta ( $term -> term_id, 'category-image-id', true ); ?>
            <input type="hidden" id="category-image-id" name="category-image-id" value="<?php echo $image_id; ?>">
            <div id="category-image-wrapper">
              <?php if ( $image_id ) { ?>
                <?php echo wp_get_attachment_image ( $image_id, 'thumbnail' ); ?>
              <?php } ?>
            </div>
            <p>
              <input type="button" class="button button-secondary FC_TAX_media_button" id="FC_TAX_media_button" name="FC_TAX_media_button" value="<?php _e( 'Add Image', 'hero-theme' ); ?>" />
              <input type="button" class="button button-secondary FC_TAX_media_remove" id="FC_TAX_media_remove" name="FC_TAX_media_remove" value="<?php _e( 'Remove Image', 'hero-theme' ); ?>" />
            </p>
          </td>
        </tr>
      <?php
      }
    
    /*
     * Update the form field value
     * @since 1.0.0
     */
     public function updated_category_image ( $term_id, $tt_id ) {
       if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
         $image = $_POST['category-image-id'];
         update_term_meta ( $term_id, 'category-image-id', $image );
       } else {
         update_term_meta ( $term_id, 'category-image-id', '' );
       }
     }

  
     /**
      * Add to API
      */
     public function featured_image_register_rest(){

      $terms = get_terms([
        'taxonomy' => [
          'app-module-tax',
          'post_tag',
          'category',
        ],
        'hide_empty' => true,
      ]);

      //tag as object_type worked for for adding to tags route, not post_tag
      $object_types = ['category', 'tag', 'app-module-tax'];

      $args =  [
        //Callback function used to retrieve the field value
        'get_callback' => function($terms) {
          //Sizes to retreive
          $get_sizes = ['thumbnail', 'medium', 'medium_large', 'large'];
          $featured_images = [];

          //Get the image ID from the term meta
          $image_id = get_term_meta( $terms['id'], 'category-image-id', true );
          
          //Get URLs for each size
          foreach ($get_sizes as $size){
            $image = wp_get_attachment_image_src($image_id, $size);
            $featured_images[$size] = $image[0];
          }
          //Add full size image
          $full = wp_get_attachment_url($image_id);
          $featured_images["full"] = $full;
          
          return $featured_images;
        },
      ];

      register_rest_field( $object_types, 'featured_images', $args );
  }


    /*
     * Add script
     * @since 1.0.0
     */
     public function add_script() { ?>
       <script>
         jQuery(document).ready( function($) {
           function fc_media_upload(button_class) {
             var _custom_media = true,
             _orig_send_attachment = wp.media.editor.send.attachment;
             $('body').on('click', button_class, function(e) {
               var button_id = '#'+$(this).attr('id');
               var send_attachment_bkp = wp.media.editor.send.attachment;
               var button = $(button_id);
               _custom_media = true;
               wp.media.editor.send.attachment = function(props, attachment){
                 if ( _custom_media ) {
                   $('#category-image-id').val(attachment.id);
                   $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
                   $('#category-image-wrapper .custom_media_image').attr('src',attachment.url).css('display','block');
                 } else {
                   return _orig_send_attachment.apply( button_id, [props, attachment] );
                 }
                }
             wp.media.editor.open(button);
             return false;
           });
         }
         fc_media_upload('.FC_TAX_media_button.button'); 
         $('body').on('click','.FC_TAX_media_remove',function(){
           $('#category-image-id').val('');
           $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
         });
         // Thanks: http://stackoverflow.com/questions/15281995/wordpress-create-category-ajax-response
         $(document).ajaxComplete(function(event, xhr, settings) {
           var queryStringArr = settings.data.split('&');
           if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
             var xml = xhr.responseXML;
             $response = $(xml).find('term_id').text();
             if($response!=""){
               // Clear the thumb image
               $('#category-image-wrapper').html('');
             }
           }
         });
       });
     </script>
     <?php }
    
      }// end public int
     
    $FC_TAX_META = new FC_TAX_META();
    $FC_TAX_META -> init();
     
}