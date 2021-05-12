<?php
/**
* Template Name: Focused
*
* @package WordPress
* @subpackage hoag_twenty
*/
get_header('headless'); ?>
 <?php get_template_part( 'template-parts/hero' ); ?>
<div id="content" class="pt-0 site-content content mx-auto row m-auto"> 
    <div id="primary" class="content-area col-12 p-0 mt-0">
        <?php // get_template_part( 'template-parts/breadcrumbs' ); ?>
		<main id="main" class="site-main" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( '/template-parts/content', 'home' ); ?>
			<?php endwhile; // end of the loop. ?>
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- #content -->
<?php get_footer('footerless'); ?>
</body>
</html>