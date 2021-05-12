<?php
/**
 * Main physician search template.
 */

use HoagPhysicians\TemplateTags as Tags;

$search_query = Tags\get_search_query();

get_header(); ?>


<div id="content" class="nav-padding site-content row mx-auto m-0 max-container no-gutters iphone-container"> 
    <div id="primary" class="content-area col-12">
		<div class="max-container d-none d-md-block">
			<?php
				if ( ! is_home() ){
					if (function_exists('get_breadcrumb')) {get_breadcrumb();}
				}
			?>
		</div>
		<main id="main" class="site-main doctors position-relative" role="main">
		<div class="max-container position-relative">
		
			<div class="search-results row w-100 mx-0 px-0">
			<div class="w-100">
				<?php if ( Tags\show_search_area() ) : ?>
						<div class="search-results-header col-12 col-lg-9">
							<?php //require( HOAGP_TEMPLATES . '/partials/search-header.php' );
								require (HDR_locate_template('partials/search-header.php'));
							?>
						</div>
						</div>
						<div class="row m-0 p-0 w-100">
					<div class="col-12 col-lg-9 m-0">
						<div class="fad-search-results search-results__row">
							<?php if ( $search_query->have_posts() ) :?>
							<div class="h-100">
								<div class="row">
									<?php	while ( $search_query->have_posts() ) {
											$search_query->the_post();
											//include 'physician-card.php';
											$i = $i + 1;
											include HDR_locate_template('physician-card.php');
										}
										wp_reset_postdata();
									?>
									<?php if($i===3):?>
										<div class="w-100"></div>
									<?php endif;?>
								</div><!-- card-deck -->
								<?php else :?>
									<?php 
										printf(
											'<p class="search-result__empty >%s <a href="%s">%s</a></p>',
											esc_html__( 'No results available. Please refine your search or', HOAGP_LANG ),
											esc_url( HOAGP_ROOT_URL ),
											esc_html__( 'start over.', HOAGP_LANG )
										);
									?>
							<?php endif; ?>
						</div>
						</div>

						<div class="search-results__footer">
							<div class="search-results__footer-top">
								<p class="viewing">
									<?php Tags\the_results_count( $search_query ); ?>
								</p>
							<!--
								<nav class="search-pagination" role="navigation">
									<h2 class="screen-reader-text">
										<?php esc_html_e( 'Physician Navigation', HOAGP_LANG ); ?>
									</h2>
									<?php Tags\the_pagination( $search_query ); ?>
								</nav>
									-->
							</div>

							<!-- div class="search-results__footer__cta">
								<p>
									<?php // esc_html_e( 'Not finding what you\'re looking for?', HOAGP_LANG ); ?>
								</p>
								<a href="https://www.hoag.org/find-a-doctor/"><?php // esc_html_e( 'Search all of HOAG', HOAGP_LANG ); ?></a>
							</div> -->
						</div>
					</div>

					<div class="mt-1 pb-5 mb-5 pr-3 pr-xl-0 col-3 d-none d-lg-block sticky-container">
 					<div id="snaptarget" class="shadow-lg sidebar-sticky">
						 <?php 
							//require( HOAGP_TEMPLATES . '/partials/filters.php' ); 
							require( HDR_locate_template( '/partials/filters.php' ));
						?></div>
					</div>
					</div>
				
										<!--Not finding what your looking for?-->
			<div class="w-100">
			<div class="search-results__footer__cta col-12">
				<p><?php esc_html_e( 'Not finding what you\'re looking for?', HOAGP_LANG ); ?></p>
						<a class="mb-3" href="https://www.hoag.org/find-a-doctor/"><?php esc_html_e( 'Search all of Hoag', HOAGP_LANG ); ?></a>
			
					</div>
					</div>
					
				<?php else : ?>
				<div class="search-page bg-light">
					<div class="search-page-block padding-5 pt-5 mt-3 col-sm-8">
						<h1 class="font-lg lighter pb-4">
							<?php esc_html_e( 'Find a Doctor', HOAGP_LANG ); ?>
						</h1>
						<form action="<?php echo esc_url( HOAGP_ROOT_URL ); ?>" method="GET" id="top-form">
							<div class="input-group search-header__form">
								<label class="sr-only" for="js-search-autocomplete">Physician Search</label>
								<div class="input-group">
									<input type="text" id="js-search-autocomplete" class="form-control form-control-lg search-header__bar font-ms" name="fullname"
										aria-label="Search"
										value="<?php Tags\get_filter_setting( 'fullname' ); ?>"
										placeholder="<?php esc_html_e( 'Search by Name', HOAGP_LANG ); ?>">
									<div class="input-group-append">
										<span id="search-submit" class="btn btn-primary px-4 search-header__submit"><?php esc_html_e( 'Submit', HOAGP_LANG ); ?></span>
									</div>
								</div>
							</div>
							<div class="pl-3 pt-1" ></div>
							<div class="form-control custom-select search-header__specialty h-100">
								<select id="top-specialty" name="specialty" class="search-header__select">
									<option value=""><?php esc_html_e( 'Search by Specialty', HOAGP_LANG ); ?></option>
									<?php Tags\the_specialty_options(); ?>
								</select>
							</div>
						</form>
						<span><br>
							Need assistance? Please call <a href="tel:877-423-0183">877-423-0183</a>
						</span>
					</div><!-- search-page-block -->
					<div class="search-page-img">
						<?php echo wp_get_attachment_image(4466,'large', array('class' => 'img-fluid'));//2463 3703 ?>
					</div>
				</div><!-- search-page -->
				<?php endif; ?>
			</div><!-- /.search-results -->

			</div>
		</main>
						
	</div>				
</div>

<!--bottom filter bar-->
<?php if ( Tags\show_search_area()) : ?>
<div class="fad-footer">
	<?php get_footer();?>
</div>
<div class="container-fluid m-0 mt-10 fixed-bottom text-center d-sm-block d-lg-none filter-bottom">
	<div class="filter-results_bottom p-3"><a class="drop w-100" href="javascript:void(0);"><span class="white font-ms spacing-lg light p-4 m-auto ">Filter <span class="down-caret"></span></span></a></div>
	<div class="">
		<div class="search-results__filters w-100 pb-2 m-0 p-0 container-fluid">
			<?php //require( HOAGP_TEMPLATES . '/partials/filters.php' ); 
				require( HDR_locate_template( '/partials/filters.php' ));?>
		</div>
	</div>
<!--normal footer before search-->
<?php else:?>
	<?php get_footer();?>
<?php endif; ?>
