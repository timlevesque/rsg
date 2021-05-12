<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package hoagtwenty
 */

get_header('white'); ?>

<div id="content" class="pt-5 site-content content mx-auto row m-auto"> 
    <div id="primary" class="content-area col-12 p-0 mt-0">
		<main id="main" class="site-main" role="main">
			<div class="container-fluid max-container">
				<?php if ( have_posts() ) : ?>	
					<header class="page-header row">
						<div class="col-6 p-3">
						<?php the_archive_title( '<h1 class="page-title font-lg">', '</h1>' );
							//the_archive_description( '<div class="taxonomy-description">', '</div>' );
						?>
						</div>
						<div class="col-6 d-block d-md-none text-right pt-4 mt-0 mt-sm-4">
						<a class=" dropdown-toggle article-toggle" data-toggle="dropdown" href="#">Categories
							<span class="caret"></span></a>
							<ul class="mt-4 dropdown-menu mobile-carat-articles dropdown-articles">
								<?php wp_list_categories( array(
									'title_li' => '',
									'orderby'            => 'name',
									'show_count'         => false,
									'use_desc_for_title' => false,
									'child_of'           => 1
								) ); ?>
							</ul>
						</div>
					</header><!-- .page-header -->
					<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 no-gutters px-3">
							<?php while ( have_posts() ) : the_post(); ?>
								<?php // $i = $i + 1;?>
								
									<?php
												/* Include the Post-Format-specific template for the content.
												* If you want to override this in a child theme, then include a file
												* called content-___.php (where ___ is the Post Format name) and that will be used instead.
												*/
												get_template_part( '/template-parts/card-media', get_post_format() );
									?>
							<?php endwhile; ?>
						<?php  /* hoagtwenty_paging_nav(); */ ?>
					</div>
				<?php else : ?>
					<?php get_template_part( '/template-parts/content', 'none' ); ?>
				<?php endif; ?>
            </div>
		</main><!-- #main -->	
	</div> <!-- #primary-->
</div><!-- content -->
<?php get_footer(); ?>


