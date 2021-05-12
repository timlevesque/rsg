<?php 
    $options = get_post_meta( get_the_ID(), 'post_options', true);
    if (isset($options['header_dark_mode'])){
        $link_color = 'text-white border-white';
    }else{$link_color = 'text-grey border-grey';}
?>
<div class=" d-flex pl-2 pl-md-4 justify-content-left">	
<a class="title slideleft" title="<?php get_bloginfo('name'); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>">
    <?php require_once get_template_directory() . '/inc/svg-logo.php';?>  
    <img class="header-logo"  alt="<?php get_bloginfo('name'); ?>" src="<?php echo $svg_logo ;?>">
</a>
    <?php 

//Show taxonomy phone if set in meta field
//select top level tax
$taxonomy = null;
if (has_term('', 'institute')) {
    $taxonomy = 'institute'; 
}		
if (has_term('', 'program')) {
    $taxonomy = 'program'; 
}
if (has_term('', 'practice')) {
    $taxonomy = 'practice'; 
}

//Get ID of Primary Program from SEO Framework
$post_id = get_the_ID();
$terms = wp_get_post_terms($post_id, $taxonomy, ['fields' => 'all']);
$primary_term = intval(get_post_meta( $post_id, '_primary_term_' . $taxonomy, true ));
$selected_primary = null;

foreach($terms as $term) {
    if( $primary_term == $term->term_id ) {
    //assign ID of primary program
    $selected_primary = $primary_term;
    }
}	

$term = get_term($selected_primary);
$logo_name = $term->name;



    if ( $logo_name != '' && !is_front_page() && is_singular('page')):?>
    <div class=" border-left ml-2  mr-3 ml-sm-3 pl-2 pl-sm-3 d-flex  <?php echo $link_color;?>">
        <span class="slideright stagger text-left line-1 text-sm  my-auto"><?php echo wordwrap($logo_name, 29, "<br />\n");?></span>
    </div>
    <?php endif;?>
    </div>
