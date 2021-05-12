<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hoagtwenty
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<?php
	if ( $post->post_parent ) {
		$children = wp_list_pages( array(
			'title_li' => '',
			'sort_column' => 'menu_order',
			'child_of' => $post->post_parent,
			'echo'     => 0
		) );
	} else {
		$children = wp_list_pages( array(
			'title_li' => '',
			'sort_column' => 'menu_order',
			'child_of' => $post->ID,
			'echo'     => 0
		) );
	}

	if ( $children ) : ?>
		<ul class="nav nav-pills nav-stacked">
			<?php echo $children; ?>
		</ul>
<?php endif; ?>
<?php dynamic_sidebar( 'sidebar-1' ); ?>
