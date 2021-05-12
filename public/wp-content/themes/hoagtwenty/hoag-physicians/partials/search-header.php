<?php
/**
 * Search result header.
 *
 * @package hoag-physicians
 * @since 1.0.0
 */

use HoagPhysicians\TemplateTags as Tags;

?>
<div class="search-results-title row pt-3">
	<div class="col-12 col-md-7"><h2 class="font-lg lighter"><?php esc_html_e( 'Doctor search results', HOAGP_LANG ); ?></h2></div>
	<div class="col-12 col-md-5">
		<p class="results-message">
			<?php
			$count = Tags\get_total_results_count( $search_query );
			printf(
				'<strong>%d %s</strong> %s',
				absint( $count ),
				esc_html( _n( 'doctor', 'doctors', $count, HOAGP_LANG ) ),
				esc_html__( 'found for', HOAGP_LANG )
			);
			Tags\the_results_text();
			?>
		</p>
	</div>
</div>
<!--
<div class="search-results__order custom-select">
	<?php $order = Tags\get_filter_setting( 'sort' ); ?>
	<select id="results-order">
		<option value="relevance">Relevant</option>
		<option value="name-asc" <?php selected( $order, 'name-asc' ); ?>>Name (A-Z)</option>
		<option value="name-desc" <?php selected( $order, 'name-desc' ); ?>>Name (Z-A)</option>
		<option value="dist" <?php selected( $order, 'dist' ); ?>>Distance</option>
	</select>
	<p class="search-results__order__error">
		<?php esc_html_e( 'Please choose a location first.', HOAGP_LANG ); ?>
	</p>
</div>
-->
