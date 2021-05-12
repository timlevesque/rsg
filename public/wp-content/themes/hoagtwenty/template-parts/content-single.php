<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package freshclicks2016
 */
/* rewrite support for custom author
	$author_id = strip_tags(get_the_term_list( $post->ID, 'dr_author' )); 
	$author_raw = get_post($author_id);
    //print_r($author_raw);
    */

/* $pub = get_the_terms( $post->ID, 'publications' );
$prev = $pub[0]->name;
$prev == '' ? $prevUrl = 'articles/' : $prevUrl = 'publications/'.strtolower(str_replace(' ', '-', $prev));
$prev == '' ? $prev = 'articles' :null; */

$hero_wrapper = ' single-post-top post-content mx-auto w-100';
$hero_img_wrapper = 'img-16-90 order-2';
$header_wrapper = 'order-1 pt-4 px-3 px-md-0';
$header_class = '';	
$text_size='h2';
$container = ' container-sm';


if ( is_singular( array( 'hoag_treatments', 'hoag_clinical_trials', 'hoag_procedures', 'page') ) ) {
	$hero_wrapper = 'w-100 m-h250';
	$header_wrapper = 'bg-tertiary75 t-0 h-100 position-absolute d-flex l-0 r-0 ';
	$header_class = 'px-0  text-light align-self-center mx-auto single-post-top ';
	$hero_img_wrapper = 'px-0 m-h250 ';
	$text_size='h1';
}

if ( is_singular( array('page') ) ) {
	$container = ' container-lg';
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php if ( !is_singular( array( 'hoag_treatments', 'hoag_procedures', 'page', 'hoag_app_content'))):?>
<p class="container-sm  px-4 px-md-2 pt-4 mb-0"><a href="/<?php echo $prevUrl;?>">&larr; <?php echo ucfirst($prev);?></a></p>
<?php endif;?>
<?php if ( !is_singular('hoag_app_content')):?>
<div class="row h-100 mb-4 m-0 position-relative overflow-hidden p-0 <?php if ( is_singular( array('post'	) ) ) { echo $container; } ?>   <?php echo $hero_wrapper;?>">
<div class="col-12    <?php echo $hero_img_wrapper;?>">
<?php get_template_part( 'template-parts/featured-media' ); ?>
</div>

<div class="col-12 <?php echo $header_wrapper;?>  ">
<header class=" p-1 w-100 single-post-top-block entry-header container-sm <?php echo $header_class;?>">
			<?php
					$title = get_the_title();
					$titlelen = strlen($title);
             
                    the_title( '<h1 class="entry-title text-center">', '</h1>' );
            
			?>
            <?php
            /* rewrite support for custom author
                $slug = strip_tags(get_the_term_list( $post->ID, 'dr_author' ));
                $id = get_id_by_slug($slug);
				$author_id = strip_tags($id); 
				$author_raw = get_post($author_id); 
                if ( 'post' === get_post_type() && $author_id !='' ) : ?>
                    <div class="entry-meta white text-center">
					    By <?php print $author_raw->post_title; ?>
				    </div><!-- .entry-meta -->
            <?php endif; 
			*/
			
			/* do_author(); */
            ?>
		</header><!-- .entry-header -->
</div>
</div>
<?php endif;?>
	<div class="post-content m-auto font-reading <?php echo $container;?>  px-4 ">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'freshclicks2016' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text text-center">"', '"</span>', false )
			) );
			wp_link_pages( array(
				'before' => '<div class="page-links text-center">' . esc_html__( 'Pages:', 'freshclicks2016' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
    <?php 
    /* rewrite support for custom author
        $slug = strip_tags(get_the_term_list( $post->ID, 'dr_author' ));
        $id = get_id_by_slug($slug);
		$author_id = strip_tags($id); 
		$author_raw = get_post($author_id);
	    if ( 'post' === get_post_type() && $author_id !='' ) : ?>
		<footer class="entry-footer">
			<h2 class="font-ml lighter">Meet the Author</h2>
			<div class="author row no-gutters">
				<div class="col-sm-3">
				    <?php echo get_the_post_thumbnail($author_raw->ID, 'hoagp-profile', array('class' => 'article-author img-fluid flex-img w-100') ); ?>
				</div>
				<div class="col-sm-9 bg-light-right p-3 px-5">
					<div class="entry-content truncated_exercept">
						<h3 clas=""><a class="" href="<?php echo $author_raw->guid;?>"><?php print $author_raw->post_title; ?></a></h3>
						<div class="">
                            <?php 
                                echo substr($author_raw->post_content,0,255).'...';
                                wp_link_pages( array(
                                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'hoagtwenty' ),
                                    'after'  => '</div>',
                                ) );
                            ?>
						</div>
					</div> <!-- entry-content -->
					<a class="btn btn-outline-secondary my-5" href="<?php echo $author_raw->guid;?>">Contact <?php print $author_raw->post_title; ?></a>
				</div>
			</div>
		</footer><!-- .entry-footer -->
    <?php endif; */
    ?>
</article><!-- #post-## -->
