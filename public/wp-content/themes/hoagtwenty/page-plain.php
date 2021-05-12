<?php
/**
* Template Name: Plain
*
* @package WordPress
* @subpackage hoag_twenty
*/
get_header(); ?>
<div id="content" class="location-related mx-auto row"> 
    <div id="primary" class="container-lg">
		<main id="main" class="site-main" role="main">
            <?php while ( have_posts() ) : the_post(); 
                    the_content();
         endwhile; // end of the loop. ?>
        </main><!-- #main -->
    </div><!-- #primary -->
</div><!-- #content -->
<?php get_footer(); ?>