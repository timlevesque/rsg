<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package hoagtwenty
 */

get_header();
$term_image = get_term_meta( get_queried_object_id(), 'category-image-id', true);
if ( ! empty($term_image)){

}else{
    
}
   
?>

<?php if(is_post_type_archive() || get_the_archive_title() == 'Articles'):
	$headingCol = 'col-9 col-md-7 ';
else:
	$headingCol = 'col-12 ';
endif;?>

<div id="content" class="pt-3 site-content content mx-auto row m-auto"> 
    <div id="primary" class=" content-area col-12 p-0 mt-0">
		<main id="main" class="pt-2 site-main" role="main">
			<div class="wp-block-group position-relative my-5">
				<div class="wp-block-group__inner-container">
					<div class="wp-block-group mb-n5 col-10 h-50 bg-tertiary25 position-absolute b-0 l-0" style="">
						<div class="wp-block-group__inner-container">
						</div>
					</div>
					<div class="wp-block-group overflow-hidden h-50">
						<div class="wp-block-group__inner-container">
							<div class="wp-block-cover m-h300-sm position-absolute col-10 col-md-9 t-0 r-0 h-75" style="background-image: url(&quot;https://rsg.trlevesque.com/wp-content/uploads/blog-hero.jpg&quot;); background-position: 79% 39%;">
								<div class="wp-block-cover__inner-container">
									<p class="has-text-align-center has-large-font-size">
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="wp-block-group pb-50-sm pt-200-sm col-12 col-md-9 col-xl-7 p-3 p-lg-5" style="">
						<div class="wp-block-group__inner-container">
							<div class="wp-block-group d-flex bg-white p-5 shadow align-self-center" style="height:318px">
								<div class="wp-block-group__inner-container row">
									<div class="wp-block-group text-tertiary align-self-center">
										<div class="wp-block-group__inner-container">
											<h1>OUR BLOG</h1>
											<p class="has-text-align-left my-3">Learn more about recent news, legislation updates, and RSG featured projects, company culture, and team members below.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container-lg p-0 pt-5">
			<?php
	/* 			$uri = $_SERVER['REQUEST_URI'];
				$uri_arr = explode('/',$uri);
				$child = $uri_arr[2];
				$parent = $uri_arr[1]; */
				if ( have_posts() ) : ?>	
					<header class="page-header row pt-5">
						<div class="col p-3">
						<h1 class="page-title text-tertiary  text-ml">Articles</h1>
						<?php
							/* if($child !== '' ):?>
								<p><a href="/<?php echo $parent;?>">&larr; <?php echo ucfirst($parent);?></a></p>
							<?php endif; */
						//Get post type  
					/* 	if(!is_post_type_archive() || get_the_archive_title() == 'Articles'){
							single_term_title('<h1 class="page-title text-tertiary  text-ml">', '</h1>' );
						}else{
							post_type_archive_title( '<h1 class="page-title text-tertiary text-ml">', '</h1>' );
						}
						 the_archive_description( '<div class="taxonomy-description sans-serif text-grey ">', '</div>' ); */
						 ?>
						</div>

						<?php if(is_post_type_archive() || get_the_archive_title() == 'Articles'):?>
						
						<!--filter icon-->
					
						<div class="col col-md-5 text-left text-md-right pb-4 mt-auto hide-sm">
						<!-- <a class=" dropdown-toggle article-toggle" data-toggle="dropdown" href="#">Categories -->
							<!-- <span class="caret"></span></a> -->
							
							<ul class="mt-4 dropdown-menu mobile-carat-articles dropdown-articles">
							</ul>
						</div>
						<?php endif;?>
						
						<?php if(!is_post_type_archive() && get_the_archive_title() != 'Articles' && wp_attachment_is_image($term_image) ):?>
						<div class="m-h200-sm m-h350 overflow-hidden pb-3 w-100">
						<div class="dropdown-toggle d-none" data-post="<?php echo get_post_type();?>"></div>
							<?php
                            echo wp_get_attachment_image( $term_image, 'large', "", array( "class" => "img-fluid img-flex ie-flexfix h-100" ) );  
							?>
							</div>
						<?php endif;?>
						<?php endif;?>
						<div class="col p-3">
						<?php
								$cat = '';

								if(isset($_GET["cat"])){
									$cat = $_GET["cat"];
								}

								$categories = get_categories();
								$url = explode('?', $_SERVER['REQUEST_URI'], 2);
								$uri = $url[0];

								if(get_post_type() == 'post'){
								echo '<select class="px-3 py-2 rounded float-right" onChange="window.location.href=this.value">';
								echo '<option selected value="'.$uri.'">All Articles</option>';
								foreach($categories as $category) {
									if($category->slug !== 'blog'){
										$sel = '';
										if($cat == $category->slug ){
											$sel = 'selected';
										}

										echo '<option '.$sel.' class="" value="'.$uri.'?cat='.$category->slug. '">' . $category->name . '</option>';
									}
								}
								echo '</select>';
							}

						?>
						</div>
					</header><!-- .page-header -->
					<div class="dropdown-toggle d-none" data-post="<?php echo get_post_type();?>"></div>
					<div id="post-list" class="p-2 row row-cols-1 row-cols-sm-2 row-cols-md-4">
						 



<?php 
	$args = [
		'post_type' => get_post_type(),
		'post_status'=>'publish', 
		'posts_per_page'=> -1,
		'category_name' => $cat
	];
	$query = new WP_Query( $args ); 

	if ( $query->have_posts() ) : 
		while ( $query->have_posts() ) : $query->the_post(); 
			// Display post content
			get_template_part( '/template-parts/card-media', get_post_format() );
		endwhile; 
	endif; ?>

</div>
<?php   //hoagtwenty_paging_nav(); ?>
            </div>
		</main><!-- #main -->	
	</div> <!-- #primary-->
</div><!-- content -->
<?php get_footer(); ?>