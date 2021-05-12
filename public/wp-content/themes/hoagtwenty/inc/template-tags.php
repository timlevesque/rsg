<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package hoagtwenty
 */

if ( ! function_exists( 'hoagtwenty_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function hoagtwenty_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'hoagtwenty' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

/*  	$byline = sprintf(
		esc_html_x( '%s', 'post author', 'hoagtwenty' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);  */

	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'hoagtwenty' ) );
		if ( $categories_list && hoagtwenty_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( '%1$s ', 'hoagtwenty' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/*
		REMOVED
		* translators: used between list items, there is a space after the comma
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'hoagtwenty' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'hoagtwenty' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}*/
	}

	echo '<span class="posted-on"><span class="glyphicon glyphicon-time" ></span> ' . $posted_on . '</span>  <span class="byline"><span class="glyphicon glyphicon-user"> </span> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'hoagtwenty_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function hoagtwenty_entry_footer() {
	/* hide comment count for now
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'hoagtwenty' ), esc_html__( '1 Comment', 'hoagtwenty' ), esc_html__( '% Comments', 'hoagtwenty' ) );
		echo '</span>';
	}
	*/
	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'hoagtwenty' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function hoagtwenty_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'hoagtwenty_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'hoagtwenty_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so hoagtwenty_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so hoagtwenty_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in hoagtwenty_categorized_blog.
 */
function hoagtwenty_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'hoagtwenty_categories' );
}
add_action( 'edit_category', 'hoagtwenty_category_transient_flusher' );
add_action( 'save_post',     'hoagtwenty_category_transient_flusher' );

function hoagtwenty_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
		?>

		<div class="post-thumbnail center-cropped">
			<?php
			if ( ( ! is_active_sidebar( 'sidebar-2' ) || is_page_template( 'full-width.php' ) ) ) {
				the_post_thumbnail( 'large' );
			} else {
				the_post_thumbnail('large');
			}
			?>
		</div>

	<?php else : ?>

		<a class="post-thumbnail center-cropped" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php
			if ( ( ! is_active_sidebar( 'sidebar-2' ) || is_page_template( 'full-width.php' ) ) ) {
				the_post_thumbnail( 'large' );
			} else {
				the_post_thumbnail( 'large', array( 'alt' => get_the_title() ) );
			}
			?>
		</a>

	<?php endif; // End is_singular()
}
if ( ! function_exists( 'hoagtwenty_paging_nav' ) ) :
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */
	function hoagtwenty_paging_nav() {
		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}
		?>
		<nav class="row navigation paging-navigation text-center mx-auto justify-content-md-center" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'hoagtwenty' ); ?></h1>
			<div class="nav-links">

				<?php if ( get_next_posts_link() ) : ?>
					<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'hoagtwenty' ) ); ?></div>
				<?php endif; ?>

				<?php if ( get_previous_posts_link() ) : ?>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'hoagtwenty' ) ); ?></div>
				<?php endif; ?>

			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
endif;


if ( ! function_exists( 'hoagtwenty_post_nav' ) ) :
	/**
	 * Display navigation to next/previous post when applicable.
	 */
	 
	function hoagtwenty_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="navigation post-navigation row p-5 mt-4 line-15" role="navigation">
			<h2 class="screen-reader-text"><?php _e( 'Additional Articles', 'hoagtwenty' ); ?></h2>
			<div class="nav-links row">
				<?php
				next_post_link(     '<div class="col-md-6 nav-next">%link</div>',     _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Next post link',     'hoagtwenty' ) );
				previous_post_link( '<div class="col-md-6 nav-previous">%link</div>', _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Previous post link', 'hoagtwenty' ) );
				?>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
endif;
