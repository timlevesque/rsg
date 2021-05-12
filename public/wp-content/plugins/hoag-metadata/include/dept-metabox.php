<?php
/*
*/

// set post and page types that will have global tags.

/**
 * Plugin class
 **/
if ( ! class_exists( 'FC_DEPT_META' ) ) {

    class FC_DEPT_META {
    
      public function __construct() {
        //
      }
     
     /*
      * Initialize the class and start calling our hooks and filters
      * @since 1.0.0
     */
    public function init() {

        $prefix_taxonomies = array(
            'program',
            'institute',
            'practice',
        );
        foreach($prefix_taxonomies as $prefix_taxonomy){
            add_action( sprintf( '%s_add_form_fields', $prefix_taxonomy ), array ( $this, 'add_dept_phone' ), 10, 2 );
            add_action( sprintf( 'created_%s', $prefix_taxonomy ), array ( $this, 'save_dept_phone' ), 10, 2 );
            add_action( sprintf( '%s_edit_form_fields', $prefix_taxonomy ), array ( $this, 'update_dept_phone' ), 10, 2 );
            add_action( sprintf( 'edited_%s', $prefix_taxonomy ), array ( $this, 'updated_dept_phone' ), 10, 2 );
        }
        foreach($prefix_taxonomies as $prefix_taxonomy){
          add_action( sprintf( '%s_add_form_fields', $prefix_taxonomy ), array ( $this, 'add_dept_email' ), 10, 2 );
          add_action( sprintf( 'created_%s', $prefix_taxonomy ), array ( $this, 'save_dept_email' ), 10, 2 );
          add_action( sprintf( '%s_edit_form_fields', $prefix_taxonomy ), array ( $this, 'update_dept_email' ), 10, 2 );
          add_action( sprintf( 'edited_%s', $prefix_taxonomy ), array ( $this, 'updated_dept_email' ), 10, 2 );
        }
  
       
       /*tag support
       add_action('post_tag_edit_form_fields', array ( $this, 'update_dept_phone' ), 10, 2 );
       add_action( 'created_post_tag', array ( $this, 'save_dept_phone' ), 10, 2 );
       add_action( 'post_tag_add_form_fields', array ( $this, 'add_dept_phone' ), 10, 2 );
       add_action( 'edited_post_tag', array ( $this, 'updated_dept_phone' ), 10, 2 );
       */
       

    }
    
    public function load_media() {
     wp_enqueue_media();
    }
     
     /*
      * Add a form field in the new category page
      * @since 1.0.0
     */
     public function add_dept_phone ( $taxonomy ) { ?>
       <div class="form-field term-group">
         <label for="dept-phone-id"><?php _e('Phone', 'hero-theme'); ?></label>
         <input type="text" id="dept-phone-id" name="dept-phone-id" class="custom_media_url" value="">
     </div>
     <?php
     }

     
     /*
      * Save the form field
      * @since 1.0.0
     */
     public function save_dept_phone ( $term_id, $tt_id ) {
       if( isset( $_POST['dept-phone-id'] ) && '' !== $_POST['dept-phone-id'] ){
         $phone = $_POST['dept-phone-id'];
         add_term_meta( $term_id, 'dept-phone-id', $phone, true );
       }
     }
     
     /*
      * Edit the form field
      * @since 1.0.0
     */
    
     public function update_dept_phone ( $term, $taxonomy ) { ?>
        <tr class="form-field term-group-wrap">
          <th scope="row">
            <label for="dept-phone-id"><?php _e( 'Phone', 'hero-theme' ); ?></label>
          </th>
          <td>
            <?php $phone_id = get_term_meta ( $term -> term_id, 'dept-phone-id', true ); ?>
            <input type="text" id="dept-phone-id" name="dept-phone-id" value="<?php echo $phone_id; ?>">
          </td>
        </tr>
      <?php
    }
    
    /*
     * Update the form field value
     * @since 1.0.0
     */
     public function updated_dept_phone ( $term_id, $tt_id ) {
       if( isset( $_POST['dept-phone-id'] ) && '' !== $_POST['dept-phone-id'] ){
         $phone = $_POST['dept-phone-id'];
         update_term_meta ( $term_id, 'dept-phone-id', $phone );
       } else {
         update_term_meta ( $term_id, 'dept-phone-id', '' );
       }
     }

     /*
      * Add a form field in the new category page
      * @since 1.0.0
     */
    public function add_dept_email ( $taxonomy ) { ?>
      <div class="form-field term-group">
        <label for="dept-email-id"><?php _e('Emails (Comma Separated)', 'hero-theme'); ?></label>
        <input type="text" id="dept-email-id" name="dept-email-id" class="custom_media_url" value="">
    </div>
    <?php
    }

    
    /*
     * Save the form field
     * @since 1.0.0
    */
    public function save_dept_email ( $term_id, $tt_id ) {
      if( isset( $_POST['dept-email-id'] ) && '' !== $_POST['dept-email-id'] ){
        $email = $_POST['dept-email-id'];
        add_term_meta( $term_id, 'dept-phone-id', $email, true );
      }
    }
    
    /*
     * Edit the form field
     * @since 1.0.0
    */
   
    public function update_dept_email ( $term, $taxonomy ) { ?>
       <tr class="form-field term-group-wrap">
         <th scope="row">
           <label for="dept-email-id"><?php _e( 'Emails (Comma Separated)', 'hero-theme' ); ?></label>
         </th>
         <td>
           <?php $email_id = get_term_meta ( $term -> term_id, 'dept-email-id', true ); ?>
           <input type="text" id="dept-email-id" name="dept-email-id" value="<?php echo $email_id; ?>">
         </td>
       </tr>
     <?php
   }
   
   /*
    * Update the form field value
    * @since 1.0.0
    */
    public function updated_dept_email ( $term_id, $tt_id ) {
      if( isset( $_POST['dept-email-id'] ) && '' !== $_POST['dept-email-id'] ){
        $email = $_POST['dept-email-id'];
        update_term_meta ( $term_id, 'dept-email-id', $email );
      } else {
        update_term_meta ( $term_id, 'dept-email-id', '' );
      }
    }

    }// end public int
    
     
    $FC_DEPT_META = new FC_DEPT_META();
    $FC_DEPT_META -> init();
     
}