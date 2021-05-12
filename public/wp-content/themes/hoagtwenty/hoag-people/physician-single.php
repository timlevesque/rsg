<?php
/**
 * Single physician template.
 *
 * @package hoag-physicans
 * @since 1.0.0
 */


include('components/functions.php');

/* if(is_exec() && has_private_practice()){
    include('templates/exec-practice.php');
}elseif(is_exec()){
    include('templates/exec.php');
}elseif(!has_content() && has_private_practice()){
	include('templates/no-content-practice.php');
}elseif(has_content() && has_private_practice()){
	include('templates/content-practice.php');
}else{ */
	include('templates/default.php');
/* } */
get_footer();
