<?php
/**
 * The template for displaying all single pages.
 *
 * @package hoagtwenty
*/
get_header(); ?>
<div id="content" class="location-related mx-auto row"> 
    <div id="primary" class="content-area col-12 p-0">
		<main id="main" class="site-main" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
			
				<?php get_template_part( '/template-parts/content', 'single' ); ?>
		
			<?php endwhile; // end of the loop. ?>
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- #content -->
<?php get_footer(); ?>