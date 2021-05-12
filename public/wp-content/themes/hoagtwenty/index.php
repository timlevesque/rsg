<?php
/**
 * The main template file.
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package hoagtwenty
 */
$col=12;
if ( is_active_sidebar( 'sidebar-1' ) ) {
	$col = 8;
}
if ( is_front_page() || is_home() ) {
	$col=12;
}?>

<?php get_header(); ?>
<div id="content" class="site-content mx-auto row container">
	<div id="primary" class="content-area col-md-<?php print $col; ?> col-sm-12">
		<main id="main" class="site-main" role="main">
			<?php
				if ( have_posts() ) :
					if ( is_home() && ! is_front_page() ) : ?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</header>
					<?php
					endif;

					/* Start the Loop */
					while ( have_posts() ) : the_post();
						/*
						* Include the Post-Format-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Format name) and that will be used instead.
						*/
						get_template_part( 'template-parts/content-home', get_post_format() );
					endwhile;
					// Previous/next page navigation.
					the_posts_pagination( array(
						'prev_text'          => __( 'Previous page', 'twentysixteen' ),
						'next_text'          => __( 'Next page', 'twentysixteen' ),
						'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>',
					) );
				else :
					get_template_part( 'template-parts/content', 'none' );
				endif; 
			?>
		</main><!-- #main -->
		<?php if ($col!=12 ): ?>
			<div class="col-sm-4 d-none d-md-block">
				<?php get_sidebar(); ?>
			</div>
		<?php endif; ?>
	</div><!-- #primary -->
</div><!-- #content -->
<?php get_footer(); ?>
</body>
</html>
