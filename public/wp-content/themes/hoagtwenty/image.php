<?php 
// prevent images from having their own URLs
wp_redirect(get_permalink($post->post_parent)) ; 