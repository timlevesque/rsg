<?php
/*
*/
/**
 * Plugin class
 **/
if ( ! class_exists( 'FC_PUB_META' ) ) {

    class FC_PUB_META {
    
      public function __construct() {
        //
      }
     
     /*
      * Initialize the class and start calling our hooks and filters
      * @since 1.0.0
     */
    public function init() {

        $prefix_taxonomies = array(
            'publications'
        );
        foreach($prefix_taxonomies as $prefix_taxonomy){
            add_action( sprintf( '%s_add_form_fields', $prefix_taxonomy ), array ( $this, 'add_publication_date' ), 10, 2 );
            add_action( sprintf( 'created_%s', $prefix_taxonomy ), array ( $this, 'save_publication_date' ), 10, 2 );
            add_action( sprintf( '%s_edit_form_fields', $prefix_taxonomy ), array ( $this, 'update_publication_date' ), 10, 2 );
            add_action( sprintf( 'edited_%s', $prefix_taxonomy ), array ( $this, 'updated_publication_date' ), 10, 2 );
        }
        
  
       
       /*tag support
       add_action('post_tag_edit_form_fields', array ( $this, 'update_dept_phone' ), 10, 2 );
       add_action( 'created_post_tag', array ( $this, 'save_dept_phone' ), 10, 2 );
       add_action( 'post_tag_add_form_fields', array ( $this, 'add_dept_phone' ), 10, 2 );
       add_action( 'edited_post_tag', array ( $this, 'updated_dept_phone' ), 10, 2 );
       */
       

    }
    
     
     /*
      * Add a form field in the new category page
      * @since 1.0.0
     */
     public function add_publication_date ( $taxonomy ) { ?>
       <div class="form-field term-group">
         <label for="publication-date"><?php _e('Publication Date', 'hero-theme'); ?></label>
         <input type="text" id="publication-date" placeholder="YYYY-MM-DD" name="publication-date" class="custom_media_url" value="">
     </div>
     <?php
     }

     
     /*
      * Save the form field
      * @since 1.0.0
     */
     public function save_publication_date ( $term_id, $tt_id ) {
       if( isset( $_POST['publication-date'] ) && '' !== $_POST['publication-date'] ){
        $publication_Date = $_POST['publication-date'];
         add_term_meta( $term_id, 'publication-date', $publication_Date, true );
       }
     }
     
     /*
      * Edit the form field
      * @since 1.0.0
     */
    
     public function update_publication_date ( $term, $taxonomy ) { ?>
        <tr class="form-field term-group-wrap">
          <th scope="row">
            <label for="publication-date"><?php _e( 'Publication Date', 'hero-theme' ); ?></label>
          </th>
          <td>
            <?php $publication_Date = get_term_meta ( $term -> term_id, 'publication-date', true ); ?>
            <input type="text" id="publication-date" placeholder="YYYY-MM-DD" name="publication-date" value="<?php echo $publication_Date; ?>">
          </td>
        </tr>
      <?php
    }
    
    /*
     * Update the form field value
     * @since 1.0.0
     */
     public function updated_publication_date ( $term_id, $tt_id ) {
       if( isset( $_POST['publication-date'] ) && '' !== $_POST['publication-date'] ){
         $phone = $_POST['publication-date'];
         update_term_meta ( $term_id, 'publication-date', $phone );
       } else {
         update_term_meta ( $term_id, 'publication-date', '' );
       }
     }
    }// end public int
    
     
    $FC_PUB_META = new FC_PUB_META();
    $FC_PUB_META -> init();
     
}