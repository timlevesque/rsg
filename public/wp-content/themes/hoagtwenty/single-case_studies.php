<?php get_header(); 

$city= '';

$options = get_post_meta( get_the_ID(), 'case_studies_options', true);
if($options){
 $city =  $options['city'];
}

?>

<div id="content" class="mx-auto row px-4 py-4 py-md-5"> 
    <div id="primary" class="content-area col-12 p-0">
		<main id="main" class="site-main" role="main">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<div class="row h-100 mb-4 m-0 position-relative overflow-hidden p-0">
<div class="col-12   px-0">
<header class="px-0 w-100 single-post-top-block entry-header container-sm >">
            
			<?php
                    ucwords(the_title( '<h1 class="entry-title text-secondary">', '</h1>' ));
			?>
            <span class="text-primary"><strong><?php echo $city;?></strong></span>
            <?php 
            if(has_post_thumbnail( )):?>
            <div class="img-16-90 my-4"><?php the_post_thumbnail('large', array('class' => 'img-fluid img-flex')); ?> </div>
            <?php endif; ?>
            
		</header><!-- .entry-header -->
</div>
</div>

	<div class="post-content m-auto font-reading container-sm px-0 ">
		<?php
		if (have_posts()) {
            while (have_posts()) {
                the_post();
             
                the_content();
         
        } // end while
        } // end if
      
		?>
	</div><!-- .entry-content -->
   
</article><!-- #post-## -->

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- #content -->
<?php get_footer(); ?>