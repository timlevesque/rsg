<?php
/**
 * "card" layout for Display Posts Shortcode
**/
?>
<!--
	<a class="entry-image-link" href="<?php //echo get_permalink() ?>"><?php //echo get_the_post_thumbnail( get_the_ID(),'medium') ?></a>
    -->

<?php 
$link = get_permalink(); 
$title = get_the_title();

if(get_post_type() == 'hoag_locations'){

$hoag_local_fields = get_post_meta( get_the_ID(), 'hoag_local' )[0];
$display_name = $hoag_local_fields['display_name'];
$url = $hoag_local_fields['url'];

if($url !== ''){ $link = $url; }
if($display_name !== ''){$title = $display_name;}

}

?>
<div class="col px-2  post-list-item text-left">
    <a href="<?php echo $link; ?>">
    <div class="btn-link  slideup mx-2  ">
        <p class ="my-auto ml-0 mr-3"><?php echo $title; ?> &nbsp;&rarr;</p>
    </div>
    </a>
</div>
