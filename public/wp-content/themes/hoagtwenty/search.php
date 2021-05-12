<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package hoagtwenty
 */

get_header(); 
$names = ['hoag_locations', 'hoag_clinical_trials', 'hoag_procedures', 'post', 'hoag-person', 'hoag_treatments'];
$types = get_post_types( '', 'objects' );
$search_term = $_GET['s'];
$search_type = $_GET['post_type'];
?>

<section id="primary" class="content-area container-lg mx-0 px-0 mb-5">
	<main id="main" class="site-main" role="main">
		<div class="row">
			<div id="" class="col-12 col-lg-4 px-0 pl-lg-4  position-sticky t-0 align-self-start  z-3 ">
				<header class="page-header pb-2 d-none d-lg-block pt-4 px-3">
					<h1 class="page-title text-ms text-tertiary sans-serif px-2 ">Filter</h1>
				</header><!-- .page-header -->
			<ul class="overflow-scroll-md text-center bg-white text-md-left py-3 px-3 z-4 mb-0 list-unstyled ">
			<li class="px-2 rounded <?php if ($search_type == ''){echo('bg-tertiary link-white');}else{echo 'bg-transparent';}?>"><a href="?s=<?php echo $search_term;?>">All</a></li>
			<?php
			foreach($types as $type){
				if(in_array($type->name, $names)):?>
					<li class="px-2 rounded <?php if ($search_type == $type->name){echo('bg-tertiary link-white');}?>"><a href="?s=<?php echo $search_term;?>&post_type=<?php echo ($type->name);?>"><?php echo $type->labels->name;?></a></li>
				<?php endif; 
			}
			?>
			</ul>
			</div>
			<div class="col-12 col-lg-8">
			<header class="page-header pt-4 pb-2">
				<h1 class="page-title text-md text-tertiary sans-serif"><?php printf( esc_html__( 'Results for: %s', 'hoagtwenty' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->
	
		<?php
		if ( have_posts() ) : ?>
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', 'search' );
	

			endwhile;

			the_posts_navigation();


		else :

			get_template_part( 'template-parts/content', 'none' );
		endif; ?>

		</div>
		</main><!-- #main -->
	</section><!-- #primary -->


<?php
get_footer();
