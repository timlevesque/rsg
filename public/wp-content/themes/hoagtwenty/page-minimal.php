<?php
/**
* Template Name: Minimal
*
* @package WordPress
* @subpackage hoag_twenty
*/
get_header('logo'); ?>
<div id="content" class="mx-auto row m-auto"> 
    <div id="primary" class="img-screen75 content-area col-12 mt-5 bg-white  px-0 ">
        <?php // get_template_part( 'template-parts/breadcrumbs' ); ?>
		<main id="main" class="site-main" role="main">
			<?php while ( have_posts() ) : the_post(); 
                get_template_part( '/template-parts/content', 'single' ); ?>
			<?php endwhile; // end of the loop. ?>
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- #content -->
<?php get_footer('footerless'); ?>
</body>
</html>