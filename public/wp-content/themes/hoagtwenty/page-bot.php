<?php
/**
 * The template for displaying all single pages.
 * Template Name: bot enabled
 * Template Post Type: hoag_app_content
 * @package hoagtwenty
*/
get_header('headless'); ?>
<div id="content" class="location-related pt-0 site-content content mx-auto row m-auto"> 
    <div id="primary" class="content-area mt-0 col-12">
        <div class="bg-faded">
            <main id="main" class="site-main" role="main">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( '/template-parts/content', 'page' ); ?>
                <?php endwhile; // end of the loop. ?>
            </main><!-- #main -->
        </div>
	</div><!-- #primary -->
</div><!-- #content -->
<!-- Start of ChatBot (www.chatbot.com) code -->
<script type="text/javascript">
    window.__be = window.__be || {};
    window.__be.id = "5e7f7666c08ba5000717192b";
    (function() {
        var be = document.createElement('script'); be.type = 'text/javascript'; be.async = true;
        be.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.chatbot.com/widget/plugin.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(be, s);
    })();
</script>
<!-- End of ChatBot code -->