<?php 
use HoagPeople\TemplateTags as Tags;
the_post();
$post = get_post();
$options = get_post_meta( get_the_ID(), 'post_options', true);

function is_exec( $post = null ) : bool {
	$exec = get_the_terms( get_the_ID() , 'people_types' );
	if (is_array($exec)){
	if ( array_search('Executives', array_column($exec, 'name')) ) {return true;
	}elseif($exec[0]->name == 'Executives' ){
		return true;
	}
	return false;
}
}

function has_private_practice( $post = null ) : bool {
    $post = get_post( $post );
	if ( ! $post ) {
		return false;
	}
	if ( $post->hoagp_providermedicalgroupname ) {
		return true;
	}
	return false;
}

function has_content( $post = null ) : bool {
    $post = get_post( $post );
	if ( ! $post ) {
		return false;
	}
	if ( !empty($post->post_content ) || Tags\has_video()) {
		return true;
	}
	return false;
}
