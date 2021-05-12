<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package freshclicks2016
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="row mx-auto img-overlay container-sm">
        <header class="entry-header text-light pt-2 pt-md-5 pl-3 pl-md-0 col-9">
                <?php
                if ( is_single() ) {
                        the_title( '<h1 class="entry-title pt-5">', '</h1>' );
                }else{
                    print '<a class="" href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
                    the_title( '<h1 class="'.$text_size.'entry-title ">', '</h1>' );
                    print '</a>';
                }
                ?>
        </header><!-- .entry-header -->
    </div>
    <?php the_post_thumbnail( 'large',array('class' => 'img-fluid img-flex ie-flexfix') ); ?>
	<div class="container-fluid mx-auto py-5">
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
</article><!-- #post-## -->
