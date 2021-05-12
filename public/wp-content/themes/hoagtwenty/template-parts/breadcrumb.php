<?php
/**
 * Breadcrumbs
 * 
 *
 * @package WordPress
 * @subpackage Hoag_Twenty
 * @since 1.0.0
 */
?>
<div class="max-container d-none d-md-block">
	<?php
		if ( is_front_page() || is_home() ) {
			//home logic
		}else{
			if (function_exists('get_breadcrumb')) {
                get_breadcrumb();
            }
		}
	?>
</div>