<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package hoagtwenty
 */

?>
<div class="card h-100">
<article id="post-<?php the_ID(); ?>" <?php post_class('excerpt hoag-articles'); ?> class="hoag-articles card">
	<!-- <div class="card py-0 mb-0 mx-0 mx-sm-3 bg-light-grey"> -->
		<div class="card-top">
			<a href="<?php the_permalink();?>">
				<?php the_post_thumbnail('medium-large', ['class' => 'card-img-top img-fluid overflow-hidden img-flex m-h180', 'alt'=>get_the_title(), 'title' => get_the_title() ]); ?>
			</a>
		</div>
		<div class="card-body">
            <?php 
                if ( is_single() ) {
                        $title_header = 'h1';
                    }else{
                        $title_header = 'h2';
                    } 
            ?>
            <?php 
                $categories = get_the_category();
                if ( ! empty( $categories ) ) {
                    echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '" class="small excerpt-category text-muted">' . esc_html( $categories[0]->name ) . '</a>';
                }
            ?>
            <div class="card-title"
                <?php print $title_header;?> class="text-left font-ms initial-weight"><a href="<?php the_permalink();?>" rel="bookmark"><?php print get_the_title();?></a></<?php print $title_header;?>
            </div>
        </div><!-- card-body -->
</article>
</div><!-- card -->