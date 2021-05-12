<?php 
global $post;
function do_backButton(){
    
    $uri = explode('/', $_SERVER['REQUEST_URI']);
    $parent = '/'.$uri[1];
    $parentId = $post->post_parent;
    if($uri[2]){
        if ( $parentId != 0 ) {
            $parenttitle = get_the_title($parentId);
        }else{
            $parenttitle = ucfirst(str_replace("-", " ", $uri[1]));

        }
        echo('<a href="'.$parent.'" class="text-white position-absolute t-0 l-0 p-3 z-3">&larr;&nbsp;'.$parenttitle.'</a>');
    }
}
//TO-DO: Move to people plugin
//get physician slug
function get_id_by_slug($page_slug) {
    $locations  = get_page_by_path($page_slug, OBJECT, 'hoag_locations');
    $physicians = get_page_by_path($page_slug, OBJECT, 'hoag-person');
    $post = get_page_by_path($page_slug, OBJECT, 'post');

	if ($locations) {
		return $locations->ID;
	}elseif($physicians){
        return $physicians->ID;
    }  else {
		return null;
	}
}

//read time
function read_time(){
    $post = get_post();
    $content = get_post_field( 'post_content', $post->ID );
    $word_count = str_word_count( strip_tags( $content ) );
    $readingtime = ceil($word_count / 200);
    echo $readingtime;
}

function is_odd($num){
    if(($num % 2) == 0){  
       return false;
    }else{  
        return true;  
    }  
}


function x_custom_excerpt_more( $excerpt ) {
	if( !is_home() ){
		return str_replace( 'Read Full Article', '</br></br>Read&nbsp;More&nbsp;&rarr;', $excerpt );
	} else {
		return $excerpt;
	}
}
add_filter( 'wp_trim_excerpt', 'x_custom_excerpt_more' );

add_filter( 'wp_unique_post_slug_is_bad_attachment_slug', '__return_true' );

//chooses from a list of random images in
function randomImg(){
    $imagesDir = 'images/';
    $images = glob($imagesDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
    $randomImage = '/'.$images[array_rand($images)];
   echo $randomImage;
}

//displays attributted author
function do_author(){
    $attributed_authors = get_the_terms( $post->ID, 'attributed-authors' );
    if(! empty($attributed_authors)){

        foreach($attributed_authors as $author){
        $auth_name = $author->name;
        $auth_slug = $author->slug;
        $auth_id = get_id_by_slug($auth_slug);
        $auth_type_id = get_post_meta( $auth_id, '_primary_term_people_types', true );
        $auth_type_term = get_term($auth_type_id);
        $auth_type = $auth_type_term ->slug;
        $auth_img = wp_get_attachment_image_src( get_post_thumbnail_id($auth_id), 'thumbnail_size' )[0];
        $auth_url = '/'.$auth_type.'/'.$auth_slug;
        $auth_spec_list = get_post_meta( $auth_id , 'hoagp_providerspecialties')[0][0];
        $auth_spec = ($auth_spec_list['specialtyName']);
    

        $options = get_post_meta($auth_id, 'post_options', true);

        if($options['distinct_title'] !=='' ){
            $auth_title = $options['distinct_title'];
        }
        elseif($options['endowed_chair'] !==''){
            $auth_title = $options['endowed_chair'];
        }
        elseif($options['public_specialty']!==''){
            $auth_title = $options['public_specialty'];
        }else{
            $auth_title = $auth_spec;
        }


        $auth_block = '<a href='.$auth_url.'><div class=" pl-1 pr-3 line-1 d-inline-flex py-1">';
        $auth_block .= '<img  class=" p-1 align-self-center physician__card__photo-suggest img-flex mr-2" src="'.$auth_img.'" class="">';
        $auth_block .= '<div class=" m-0 align-self-center">'.$auth_name;
        $auth_block .= '<p class=" m-0 small text-muted">'.$auth_title.'</p></div></div></a>';

        echo $auth_block;
        

        

    }}
}
