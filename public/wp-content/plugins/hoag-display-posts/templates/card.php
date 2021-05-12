<?php
/**
 * "card" layout for Display Posts Shortcode
**/
?>
<article class="post-summary large">
<!--
	<a class="entry-image-link" href="<?php //echo get_permalink() ?>"><?php //echo get_the_post_thumbnail( get_the_ID(),'medium') ?></a>
	-->
	<h4 class="entry-title"><a href="<?php echo get_permalink() ?>"><?php echo get_the_title() ?></a></h4>
</article>