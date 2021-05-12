<?php
/**
 * layouts can be created and stored in the active theme directory under '/hoag-display-posts
 * @link              https://freshclicks.net
 * @since             1.0.0
 * @package           Hoag_Display_Posts
 *
 * @wordpress-plugin
 * Plugin Name:       Hoag Display Posts
 * Plugin URI:        https://freshclicks.net
 * Description:       Add a short code [display-posts] to display various post types with filters and layout options.
 * Version:           1.0.0
 * Author:            Lary Stucker
 * Author URI:        https://freshclicks.net
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       hoag-case-studies
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

 /**
 * Register Shortcode
 */
add_shortcode('display-posts', 'hoag_display_posts_shortcode');


function hoag_display_posts_shortcode($atts) {

	/**
	 * Short circuit filter.
	 */
	$output = apply_filters( 'pre_display_posts_shortcode_output', false, $atts );
	if ( false !== $output ) {
		return $output;
	}

	// Original attributes, for filters.
	$original_atts = $atts;

	// Pull in shortcode attributes and set defaults.
	$atts = shortcode_atts(
		array(
			'category'              => '',
			'category_display'      => '',
			'category_id'           => false,
			'category_label'        => 'Posted in: ',
			'content_class'         => 'content',
			'exclude'               => false,
			'exclude_current'       => false,
			'has_password'          => null,
            'id'                    => false,
			'ignore_sticky_posts'   => false,
			'image_size'            => 'medium',
			'include_content'       => false,
			'include_excerpt'       => true,
			'include_link'          => true,
            'include_title'         => true,
            'include_count'         => false,
			'layout'				=> '',
			'meta_key'              => '', // phpcs:ignore WordPress.VIP.SlowDBQuery.slow_db_query_meta_key
            'meta_value'            => '', // phpcs:ignore WordPress.VIP.SlowDBQuery.slow_db_query_meta_value
            'name'                  => '',
			'no_posts_message'      => '',
			'order'                 => 'DESC',
			'orderby'               => 'date',
			'post_status'           => 'publish',
			'post_type'             => 'post',
			'posts_per_page'        => '10',
			's'                     => false,
			'tag'                   => '',
			'tax_operator'          => 'IN',
			'tax_include_children'  => true,
			'tax_term'              => false,
			'taxonomy'              => false,
			'time'                  => '',
			'title'                 => '',
			'wrapper'               => 'div',
			'wrapper_class'         => 'display-posts-listing',
			'wrapper_id'            => false,
			'carousel'				=> false,
			'show_more'				=> false,
			'show_more_desktop'		=> false,
		),
		$atts,
		'display-posts'
	);

	$category              = sanitize_text_field( $atts['category'] );
	$category_display      = 'true' === $atts['category_display'] ? 'category' : sanitize_text_field( $atts['category_display'] );
	$category_id           = (int) $atts['category_id'];
	$category_label        = sanitize_text_field( $atts['category_label'] );
	$content_class         = array_map( 'sanitize_html_class', explode( ' ', $atts['content_class'] ) );
	$exclude               = $atts['exclude']; // Sanitized later as an array of integers.
	$exclude_current       = filter_var( $atts['exclude_current'], FILTER_VALIDATE_BOOLEAN );
	$has_password          = null !== $atts['has_password'] ? filter_var( $atts['has_password'], FILTER_VALIDATE_BOOLEAN ) : null;
	$id                    = $atts['id']; // Sanitized later as an array of integers.
	$ignore_sticky_posts   = filter_var( $atts['ignore_sticky_posts'], FILTER_VALIDATE_BOOLEAN );
	$image_size            = sanitize_key( $atts['image_size'] );
	$include_title         = filter_var( $atts['include_title'], FILTER_VALIDATE_BOOLEAN );
	$include_excerpt       = filter_var( $atts['include_excerpt'], FILTER_VALIDATE_BOOLEAN );
    $include_link          = filter_var( $atts['include_link'], FILTER_VALIDATE_BOOLEAN );
    $include_count         = filter_var( $atts['include_count'], FILTER_VALIDATE_BOOLEAN );
	$layout              = sanitize_text_field( $atts['layout'] );
	$meta_key              = sanitize_text_field( $atts['meta_key'] );
    $meta_value            = sanitize_text_field( $atts['meta_value'] );
    $name                  = sanitize_text_field( $atts['name'] );
	$order                 = sanitize_key( $atts['order'] );
	$orderby               = sanitize_key( $atts['orderby'] );
	$post_status           = $atts['post_status']; // Validated later as one of a few values.
	$post_type             = sanitize_text_field( $atts['post_type'] );
	$posts_per_page        = (int) $atts['posts_per_page'];
	$tag                   = sanitize_text_field( $atts['tag'] );
	$tax_operator          = $atts['tax_operator']; // Validated later as one of a few values.
	$tax_include_children  = filter_var( $atts['tax_include_children'], FILTER_VALIDATE_BOOLEAN );
	$tax_term              = sanitize_text_field( $atts['tax_term'] );
	$taxonomy              = sanitize_key( $atts['taxonomy'] );
	$time                  = sanitize_text_field( $atts['time'] );
	$shortcode_title       = sanitize_text_field( $atts['title'] );
	$wrapper               = sanitize_text_field( $atts['wrapper'] );
	$wrapper_class         = array_map( 'sanitize_html_class', explode( ' ', $atts['wrapper_class'] ) );
	$carousel         	   = filter_var( $atts['carousel'], FILTER_VALIDATE_BOOLEAN );
	$show_more         	   = filter_var( $atts['show_more'], FILTER_VALIDATE_BOOLEAN );
	$show_more_desktop     = filter_var( $atts['show_more_desktop'], FILTER_VALIDATE_BOOLEAN );

	//Custom class and show_more
	$show_more_class = '';
	$content_overflow_desktop = '';
	if ($show_more == true){ $show_more_class = ' content-overflow content-fade ';}

	if( $show_more_desktop == true){ $content_overflow_desktop = ' content-overflow-desktop content-fade-desktop '; }

	if ( ! empty( $wrapper_class )) {
		$wrapper_class = ' class="' . implode( ' ', $wrapper_class ) . $show_more_class .  $content_overflow_desktop .'"';
	}
	
	if($carousel == true){
		$wrapper_class = ' class="card-carousel-wrapper px-0 "';
	}

	$wrapper_id = sanitize_html_class( $atts['wrapper_id'] );
	if ( ! empty( $wrapper_id ) ) {
		$wrapper_id = ' id="' . $wrapper_id . '"';
	}

	// Set up initial query for post.
	$args = array(
		'perm' => 'readable',
	);

	// Add args if they aren't empty.
	if ( ! empty( $category_id ) ) {
		$args['cat'] = $category_id;
	}
	if ( ! empty( $category ) ) {
		$args['category_name'] = $category;
	}
	if ( ! empty( $order ) ) {
		$args['order'] = $order;
	}
	if ( ! empty( $orderby ) ) {
		$args['orderby'] = $orderby;
	}
	if ( ! empty( $post_type ) ) {
		$args['post_type'] = be_dps_explode( $post_type );
	}
	if ( ! empty( $posts_per_page ) ) {
		$args['posts_per_page'] = $posts_per_page;
	}
	
	if ( ! empty( $tag ) ) {
		$args['tag'] = $tag;
	}

	// Ignore Sticky Posts.
	if ( $ignore_sticky_posts ) {
		$args['ignore_sticky_posts'] = true;
	}

	// Password protected content.
	if ( null !== $has_password ) {
		$args['has_password'] = $has_password;
	}

	// Meta key (for ordering).
	if ( ! empty( $meta_key ) ) {
		$args['meta_key'] = $meta_key; // phpcs:ignore WordPress.VIP.SlowDBQuery.slow_db_query_meta_key
	}

	// Meta value (for simple meta queries).
	if ( ! empty( $meta_value ) ) {
		$args['meta_value'] = $meta_value; // phpcs:ignore WordPress.VIP.SlowDBQuery.slow_db_query_meta_value
    }
    
    // If post slug name
	if ( ! empty( $name ) ) {
		$args['name'] = $name;
	}

	// If Post IDs.
	if ( $id ) {
		$posts_in         = array_map( 'intval', be_dps_explode( $id ) );
		$args['post__in'] = $posts_in;
	}

	// If Exclude.
	$post__not_in = array();
	if ( ! empty( $exclude ) ) {
		$post__not_in = array_map( 'intval', be_dps_explode( $exclude ) );
	}
	if ( is_singular() && $exclude_current ) {
		$post__not_in[] = get_the_ID();
	}
	if ( ! empty( $post__not_in ) ) {
		$args['post__not_in'] = $post__not_in; // phpcs:ignore WordPressVIPMinimum.VIP.WPQueryParams.post__not_in
	}

	// Post Status.
	$post_status = be_dps_explode( $post_status );
	$validated   = array();
	$available   = array( 'publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash', 'any' );
	foreach ( $post_status as $unvalidated ) {
		if ( in_array( $unvalidated, $available, true ) ) {
			$validated[] = $unvalidated;
		}
	}
	if ( ! empty( $validated ) ) {
		$args['post_status'] = $validated;
	}

	// If taxonomy attributes, create a taxonomy query.
	if ( ! empty( $taxonomy ) && ! empty( $tax_term ) ) {

		if ( 'current' === $tax_term ) {
			global $post;
			$terms    = wp_get_post_terms( get_the_ID(), $taxonomy );
			$tax_term = array();
			foreach ( $terms as $term ) {
				$tax_term[] = $term->slug;
			}
		} else {
			// Term string to array.
			$tax_term = be_dps_explode( $tax_term );
		}

		// Validate operator.
		if ( ! in_array( $tax_operator, array( 'IN', 'NOT IN', 'AND' ), true ) ) {
			$tax_operator = 'IN';
		}

		$tax_args = array(
			'tax_query' => array( // phpcs:ignore WordPress.VIP.SlowDBQuery.slow_db_query_tax_query
				array(
					'taxonomy'         => $taxonomy,
					'field'            => 'slug',
					'terms'            => $tax_term,
					'operator'         => $tax_operator,
					'include_children' => $tax_include_children,
				),
			),
		);

		// Check for multiple taxonomy queries.
		$tax_count            = 2;
		$more_tax_queries = false;
		while (
			isset( $original_atts[ 'taxonomy_' . $tax_count ] ) && ! empty( $original_atts[ 'taxonomy_' . $tax_count ] ) &&
			isset( $original_atts[ 'tax_' . $tax_count . '_term' ] ) && ! empty( $original_atts[ 'tax_' . $tax_count . '_term' ] )
		) :

			// Sanitize values.
			$more_tax_queries     = true;
			$taxonomy             = sanitize_key( $original_atts[ 'taxonomy_' . $tax_count ] );
			$terms                = be_dps_explode( sanitize_text_field( $original_atts[ 'tax_' . $tax_count . '_term' ] ) );
			$tax_operator         = isset( $original_atts[ 'tax_' . $tax_count . '_operator' ] ) ? $original_atts[ 'tax_' . $tax_count . '_operator' ] : 'IN';
			$tax_operator         = in_array( $tax_operator, array( 'IN', 'NOT IN', 'AND' ), true ) ? $tax_operator : 'IN';
			$tax_include_children = isset( $original_atts[ 'tax_' . $tax_count . '_include_children' ] ) ? filter_var( $atts[ 'tax_' . $tax_count . '_include_children' ], FILTER_VALIDATE_BOOLEAN ) : true;

			$tax_args['tax_query'][] = array(
				'taxonomy'         => $taxonomy,
				'field'            => 'slug',
				'terms'            => $terms,
				'operator'         => $tax_operator,
				'include_children' => $tax_include_children,
			);

			$tax_count++;

		endwhile;

		if ( $more_tax_queries ) :
			$tax_relation = 'AND';
			if ( isset( $original_atts['tax_relation'] ) && in_array( $original_atts['tax_relation'], array( 'AND', 'OR' ), true ) ) {
				$tax_relation = $original_atts['tax_relation'];
			}
			$args['tax_query']['relation'] = $tax_relation;
		endif;

		$args = array_merge_recursive( $args, $tax_args );
	}

	// Set up html elements used to wrap the posts.
	// Default is ul/li, but can also be ol/li and div/div.
	$wrapper_options = array( 'ul', 'ol', 'div' );
	if ( ! in_array( $wrapper, $wrapper_options, true ) ) {
		$wrapper = 'div';
	}
	$inner_wrapper = 'div' === $wrapper ? 'div' : 'li';

	/**
	 * Filter the arguments passed to WP_Query.
	 *
	 * @since 1.7
	 *
	 * @param array $args          Parsed arguments to pass to WP_Query.
	 * @param array $original_atts Original attributes passed to the shortcode.
	 */
	global $dps_listing;
	$dps_listing = new WP_Query( apply_filters( 'display_posts_shortcode_args', $args, $original_atts ) );
	if ( ! $dps_listing->have_posts() ) {
		/**
		 * Filter content to display if no posts match the current query.
		 *
		 * @since 1.8
		 *
		 * @param string $no_posts_message Content to display, returned via {@see wpautop()}.
		 */
		return apply_filters( 'display_posts_shortcode_no_results', wpautop( 'no content' ) );
	}

	//use to manipulate certain cards depending on order
	global $postCount;
	$postCount = '';

	$inner = '';
	while ( $dps_listing->have_posts() ) :
		$postCount++;
		$dps_listing->the_post();
		global $post;
		$image   = '';
        $excerpt = '';
		// add count logic
		global $count;
        $count = $dps_listing->post_count;

		if ( $include_title && $include_link ) {
			/** This filter is documented in wp-includes/link-template.php */
			$title = '<a class="title" href="' . apply_filters( 'the_permalink', get_permalink() ) . '">' . get_the_title() . '</a>';

		} elseif ( $include_title ) {
			$title = '<span class="title">' . get_the_title() . '</span>';

		} else {
			$title = '';
        }
        if ($include_count){
            $count_display = ' <span class="badge badge-secondary">' . $count . '</span> ';
        }

		if ( $image_size && has_post_thumbnail() && $include_link ) {
			$image = '<a class="image" href="' . get_permalink() . '">' . get_the_post_thumbnail( get_the_ID(), $image_size ) . '</a> ';

		} elseif ( $image_size && has_post_thumbnail() ) {
			$image = '<span class="image">' . get_the_post_thumbnail( get_the_ID(), $image_size ) . '</span> ';

		}

		if ( $include_excerpt ) {
			$excerpt = get_the_excerpt();
		}
        
		$class = array( 'listing-item' );

		/**
		 * Filter the post classes for the inner wrapper element of the current post.
		 *
		 * @since 2.2
		 *
		 * @param array    $class         Post classes.
		 * @param WP_Post  $post          Post object.
		 * @param WP_Query $dps_listing       WP_Query object for the posts listing.
		 * @param array    $original_atts Original attributes passed to the shortcode.
		 */
		$class  = array_map( 'sanitize_html_class', apply_filters( 'display_posts_shortcode_post_class', $class, $post, $dps_listing  ) );
		$output = '<' . $inner_wrapper . ' class="' . implode( ' ', $class ) . '">' . $image . $title . $excerpt . '</' . $inner_wrapper . '>';

		/**
		 * Filter the HTML markup for output via the shortcode.
		 *
		 * @since 0.1.5
		 *
		 * @param string $output        The shortcode's HTML output.
		 * @param array  $original_atts Original attributes passed to the shortcode.
		 * @param string $image         HTML markup for the post's featured image element.
		 * @param string $title         HTML markup for the post's title element.
		 * @param string $excerpt       HTML markup for the post's excerpt element.
		 * @param string $inner_wrapper Type of container to use for the post's inner wrapper element.
		 * @param string $class         Space-separated list of post classes to supply to the $inner_wrapper element.
         * @param string $count         a count of the number of itmes displayed in the output. Typically used for display logic.
		 * @param string $category_display_text
		 */
		$inner .= apply_filters( 'display_posts_shortcode_output', $output, $original_atts, $image, $title, $excerpt, $inner_wrapper, $class);

	endwhile;
	wp_reset_postdata();

	/**
	 * Filter the shortcode output's opening outer wrapper element.
	 *
	 * @since 1.7
	 *
	 * @param string $wrapper_open  HTML markup for the opening outer wrapper element.
	 * @param array  $original_atts Original attributes passed to the shortcode.
	 * @param object $dps_listing, WP Query object
	 */
	$open = apply_filters( 'display_posts_shortcode_wrapper_open', '<' . $wrapper . $wrapper_class . $wrapper_id . '>', $original_atts, $dps_listing );

	/**
	 * Filter the shortcode output's closing outer wrapper element.
	 *
	 * @since 1.7
	 *
	 * @param string $wrapper_close HTML markup for the closing outer wrapper element.
	 * @param array  $original_atts Original attributes passed to the shortcode.
	 * @param object $dps_listing, WP Query object
	 */
	$close = apply_filters( 'display_posts_shortcode_wrapper_close', '</' . $wrapper . '>', $original_atts, $dps_listing );

	$showMoreButton = '';
	if ($show_more_desktop == true){ 
		$showMoreButton = ' show-more-desktop '; 
	}

	if($show_more == true){
		$close .= '<div class="pb-5 pt-3 text-center btn-overflow-container ' . $showMoreButton .'"><button class=" btn text-secondary btn-overflow font-weight-bold px-4" href="#">Show more &darr;</button></div>';
	}

	$return = '';

	if ( $shortcode_title ) {

		/**
		 * Filter the shortcode output title tag element.
		 *
		 * @since 2.3
		 *
		 * @param string $tag           Type of element to use for the output title tag. Default 'h2'.
		 * @param array  $original_atts Original attributes passed to the shortcode.
		 */
        $title_tag = apply_filters( 'display_posts_shortcode_title_tag', 'h2', $original_atts );
        
        if ($include_count){
            $return .= '<' . $title_tag . ' class="display-posts-title">'. $count_display . ' ' . $shortcode_title . '</' . $title_tag . '>' . "\n";
        }else{
            $return .= '<' . $title_tag . ' class="display-posts-title">'. $shortcode_title . '</' . $title_tag . '>' . "\n";
        }
        /*
        // add carousel rule here
        if ($carousel){
            $return .= '<>'. "\n";
        }
        */
	}

	$return .= $open . $inner . $close;

	return $return;
}

function be_dps_explode( $string = '' ) {
	$string = str_replace( ', ', ',', $string );
	return explode( ',', $string );
}

/**
 * Template Parts with Display Posts Shortcode
 */

function display_posts_locate_template( $template_name, $template_path = '', $default_path = '' ) {
	// Set variable to search in the templates folder of theme.
	if ( ! $template_path ) :
	  $template_path = 'template-parts/';
	endif;
	// Set default plugin templates path.
	if ( ! $default_path ) :
	  $default_path = plugin_dir_path( __FILE__ ) . 'templates/'; // Path to the template folder
	endif;
	// Search template file in theme folder.
	$template_theme = locate_template( array(
	  $template_path . $template_name .'.php',
	  $template_name.'.php'
	) );
	// Get plugins template file.
    if ( ! $template_theme ) :
        $template_plugin = locate_template( array( $default_path . $template_name .'.php') );
        if ( ! $template_plugin ) :
            $template = $default_path . 'card.php';
        endif;
    else:
        $template = $template_theme;
	endif;
	return apply_filters( 'display_posts_locate_template', $template, $template_name, $template_path, $default_path );
  }



function display_posts_template_part( $output, $original_atts ) {

	// Return early if our "layout" attribute is not specified
	if( empty( $original_atts['layout'] ) )
		return $output;
	ob_start();
	//get_template_part( 'partials/test', $original_atts['layout'] );
	require display_posts_locate_template( $original_atts['layout'] );
	$new_output = ob_get_clean();
	if( !empty( $new_output ) )
		$output = $new_output;
	return $output;
}
add_action( 'display_posts_shortcode_output', 'display_posts_template_part', 10, 2 );
