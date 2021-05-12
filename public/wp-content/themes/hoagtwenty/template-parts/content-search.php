<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package hoagtwenty
 */

?>

<article id="post-<?php the_ID(); ?>"  class="container-sm mx-0 shadow-sm hover-grow border rounded pt-3 px-3 my-1 my-md-2">
	<header class="entry-header mb-2">
		<?php the_title( sprintf( '<h2 class="entry-title text-ms mb-0"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php /* if ( 'post' === get_post_type() ) :  */?>
		<!-- <div class="entry-meta"> -->
			<?php /* hoagtwenty_posted_on();  */?>
		<!-- </div> --><!-- .entry-meta -->
		<?php /* endif;  */?>
		<?php
		$postType = get_post_type_object(get_post_type());
		if ($postType):?>
			<small class="text-muted"><?php echo esc_html($postType->labels->name);?></small>
		<?php endif;?>
	</header><!-- .entry-header -->

	<div class="entry-summary text-sm-sm">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<!-- <footer class="entry-footer"> -->
		<?php /* hoagtwenty_entry_footer(); */ ?>
	<!-- </footer> --><!-- .entry-footer -->
</article><!-- #post-## -->

