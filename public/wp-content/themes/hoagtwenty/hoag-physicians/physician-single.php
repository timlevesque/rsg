<?php
/**
 * Single physician template.
 *
 * @package hoag-physicans
 * @since 1.0.0
 */

use HoagPeople\TemplateTags as Tags;
the_post();
$post = get_post();
$dr_id = $post->ID;
$other_offices = Tags\get_offices();
get_header();
?>
<div id="content" class="nav-padding site-content mx-auto row  m-0 max-container no-gutters overflow-hidden"> 
	<div id="primary" class="content-area col-12">
		<div class="max-container physician-block">
			<?php
                if ( ! is_home() ) {
                   // if (function_exists('get_breadcrumb')) {get_breadcrumb();}
                }
			?>
			<a href="<?php Tags\the_search_link(); ?>" class="btn">
				<?php esc_html_e( '< Another Search', HOAGP_LANG ); ?>
			</a>
		</div>
			
		<main id="main" class="site-main max-container" role="main">
			<div class="physician-top-block">
				<div class="row no-gutters physician-single">
					<div class="col-5 col-md-3 physician-pic">
						<?php Tags\the_image( 'hoagp-profile', [ 'class' => 'img-fluid flex-img' ] ); ?>
					</div>
					<div class="col-7 col-lg-3 order-2 order-lg-3">
					<div class="physician-block py-lg-5 pl-md-5">
					<?php if ( Tags\is_valid_office() ) : ?>
						<div class="row">
							<div class="col-12">
							<?php // Tags\the_office_map(); ?>
							<h2 class=" d-block d-lg-none primary-office-title font-md lighter pb-2">
								<?php the_title(); ?>
							</h2>
							<h2 class="d-none d-lg-block primary-office-title font-md lighter">
								<?php Tags\the_office_header(); ?>
							</h2>
							
							</div>
						</div>
						<?php if ( Tags\get_gmb_map_link() ) : ?>
							<a href="<?php echo esc_url( Tags\get_gmb_map_link() ); ?>" method="get" target="_blank" rel="nofollow">	
						<?php elseif ( ! Tags\get_gmb_map_link() && Tags\get_office_map_link() ) : ?>
							<a href="<?php echo esc_url( Tags\get_office_map_link() ); ?>" method="get" target="_blank" rel="nofollow">
						<?php endif;?>
						<div class="row primary-office order-2 order-lg-3 pb-md-3">
							<div class="col-1">
								
									<svg style="overflow:visible;" height="24" viewBox="" width="24" xmlns="http://www.w3.org/2000/svg">
										<path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
										<path d="M0 0h24v24H0z" fill="none"/>
									</svg>
								
							</div>
							<div class="col-10">
								<?php if ( Tags\get_office_map_link() ) : ?>
									
									<?php Tags\the_office_address('primary', null,'address'); ?>
									
								<?php endif;?>
							</div>
						</div>
										</a>
						<?php if ( $other_offices ) : ?>
							<?php foreach ( $other_offices as $office_type ) : ?>
								<h2 class="physician__info__label d-none d-lg-block font-md lighter">
										<?php Tags\the_office_header( $office_type ); ?>
									</h2> 
									<a
												href="<?php echo esc_url( Tags\get_office_map_link($office_type) ); ?>"
												target="_blank"
												rel="nofollow"
											>
								<div class="row other-office pb-md-3">
									<div class="col-1">
										
											<svg style="overflow:visible;" height="24" viewBox="" width="24" xmlns="http://www.w3.org/2000/svg">
												<path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
												<path d="M0 0h24v24H0z" fill="none"/>
											</svg>
										
									</div>
									<div class="col-10 ">
										<?php if ( Tags\get_office_map_link($office_type) ) : ?>
											
											<?php Tags\the_office_address($office_type, null,'address'); ?>
											
										<?php endif;?>
									</div>
								</div>
								</a>
								
							<?php endforeach;?>
						<?php endif;?>
					<?php endif; ?>
					<div class="row pb-2 pb-lg-5">
						<div class="col-1">	
							<svg style="overflow:visible;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" enable-background="new0 0 24 24" xml:space="preserve">
									<path d="M20.599,15.762c-1.344,0-2.634-0.215-3.838-0.613c-0.375-0.117-0.795-0.031-1.096,0.259l-2.364,2.364
									c-3.042-1.548-5.536-4.03-7.083-7.072l2.364-2.375c0.301-0.29,0.387-0.709,0.269-1.086C8.453,6.035,8.238,4.745,8.238,3.401
									c0-0.591-0.484-1.075-1.075-1.075H3.401c-0.591,0-1.075,0.484-1.075,1.075c0,10.094,8.179,18.272,18.272,18.272
									c0.591,0,1.075-0.484,1.075-1.075v-3.762C21.674,16.246,21.189,15.762,20.599,15.762z"/>
									</svg>	
						</div>	
						<div class="col-10">				
							<a id="dr-phone" class="dr-phone" href="tel:<?php Tags\the_office_address('primary', null,'phone'); ?>"><?php Tags\the_office_address('primary', null,'phone'); ?></a>
						</div>							
					</div>
				</div>
			</div>
					<div class="col-12 col-lg-9 order-3 order-lg-2 physician-block  bg-light-grey">
						<h1 class="physician-info-title line-15 pt-3 font-lg lighter line-sm d-none d-lg-block"><?php the_title(); ?></h1>
						<div class="physician-info-details p-4">
						<div class="row">
							<div class=" col-12 col-sm-6">
								<?php if ( $post->hoagp_primaryspecialty || $post->hoagp_secondaryspecialty ) : ?>
									<div class="pb-2">
										<?php if ( $post->hoagp_primaryspecialty && $post->hoagp_secondaryspecialty ) : ?>
											<span class="text-uppercase bold"><?php esc_html_e( 'Specialties', HOAGP_LANG ); ?></span>: 
										<?php elseif ( Tags\get_extra_specialty() ) : ?>
											<span class="text-uppercase bold"><?php esc_html_e( 'Specialties', HOAGP_LANG ); ?></span>: 	
										<?php else: ?>
											<span class="text-uppercase bold"><?php esc_html_e( 'Specialty', HOAGP_LANG ); ?></span>: 
										<?php endif; ?>	
										<ul>
											<li class=" lighter ">
												<?php 
													Tags\the_comma_sep_array( array_merge(
														wp_list_pluck( $post->hoagp_primaryspecialty, 'Specialty' ),
														wp_list_pluck( $post->hoagp_secondaryspecialty, 'Specialty' )
													) );
													if ( Tags\get_extra_specialty() ) :
														echo esc_html_e( ", " . Tags\get_extra_specialty() );
													endif;	
												?>
											</li>
										</ul>
									</div>
								<?php endif; ?>
								<?php if ( $post->hoagp_languages ) : ?>
									<div class="line-15 pb-2">
										<span class="text-uppercase physician-info-label bold "><?php esc_html_e( 'Languages', HOAGP_LANG ); ?></span>:
										<ul>
											<li class="lighter">
												<?php echo esc_html( $post->hoagp_languages ); ?>
											</li>
										</ul>
									</div>
								<?php endif; ?>
								<?php if ( $post->hoagp_othercertifications ) : ?>
									<span class="text-uppercase physician-info-label bold ">
										<?php esc_html_e( 'Board Certifications', HOAGP_LANG ); ?>
									</span>: 
									<ul>
									<li class=" lighter ">
											<?php
												echo wp_kses(
													wpautop( $post->hoagp_othercertifications ),
													[
														'p'  => [],
														'br' => [],
													]
												);
											?>
										</li>
									</ul>
								<?php endif; ?>	
							</div><!-- end left column dr details -->
							<div class=" col-12 col-sm-6">
								<?php if ( $post->hoagp_affiliationslist ) : ?>
									<div class="physician-card__groups-affiliates">
										<span class="list-title text-uppercase bold ">
											<?php esc_html_e( 'Groups & Affiliations:', HOAGP_LANG );
											?>
										</span>
										<ul>
											<?php foreach ( $post->hoagp_affiliationslist as $affiliate ) : ?>
											<li class=" lighter ">
													<?php echo esc_html( $affiliate['Affiliation'] ); ?>
												</li>
											<?php endforeach; ?>
										</ul>
									</div>
								<?php endif; ?>
								<?php if ( $post->hoagp_interestslist ) : ?>
									<div class="physician-card__groups-intrest">
										<span class="list-title text-uppercase bold ">
											<?php esc_html_e( 'Interests', HOAGP_LANG ); ?>
										</span>
										<ul><li class="lighter">
											<?php foreach ( $post->hoagp_interestslist as $interest ) : ?>
												<?php echo esc_html( $interest['Interest'] ); ?>, 
											<?php endforeach; ?>
											</li>
										</ul>
									</div><!-- /.physician__info__block -->
								<?php endif; ?>
								<?php if ( $post->hoagp_associationslist ) : ?>
									<p>
										<?php foreach ( $post->hoagp_associationslist as $association ) : ?>
											<?php echo esc_html( $association['Affiliation'] ); ?>,
										<?php endforeach; ?>
									</p>
								<?php endif; ?>
								<span class="text-uppercase bold "><?php esc_html_e( 'Phone', HOAGP_LANG ); ?></span>: 
								<a id="dr-phone" class="dr-phone" href="tel:<?php Tags\the_office_address('primary', null,'phone'); ?>"><?php Tags\the_office_address('primary', null,'phone'); ?></a>
								<?php if ( Tags\has_recommend_link() ) : ?>
									<a href="<?php Tags\the_recommend_link(); ?>" class="btn btn-primary px-4">
										<?php esc_html_e( 'Recommend', HOAGP_LANG ); ?>
									</a>
								<?php endif; ?>
							</div><!-- col-md-6 second column -->
						</div>
					</div>
					</div><!-- row physican details desktop -->
					<div class="col-12 col-lg-9 order-4">
					<?php if ( Tags\has_video() ) : ?>
				<div class="physician-video-block">
					<div class="embed-responsive embed-responsive-16by9">
						<?php Tags\the_video(); ?>
					</div>
				</div>
				<?php endif;?>
				<?php if ( $post->post_content !=='') : ?>
					<div class="physician-block p-3 text-overflow text-fade">
						<h2 class="physician-about-title font-ml lighter">About <?php the_title(); ?></h2>
						<?php the_content(); ?>
					</div><!-- /.physician__info__block -->
					<div class="pb-3 pt-1 text-center"><a class="btn-overflow btn btn-outline-primary px-4" href="#">Show more</a></div>
				<?php endif;?> 
				<?php // Dr articles
						$args = array(
						'tax_query' => array(
							array(
								'taxonomy' => 'dr_author',
								'field' => 'slug',
								'terms' => $dr_id,
							)
							),
						'numberposts' => 10,
						'orderby' => 'post_date',
						'order' => 'DESC',
						'post_type' => 'post',
						'suppress_filters' => true
					);

					// The Query
					$query = new WP_Query( $args );
					?>
				<?php if ( $query->have_posts() ) : ?>
					<div class="p-4 bg-light-grey">
						<h2 class="font-ml lighter">Articles by <?php the_title(); ?></h2>
						<ul>
						<?php
							// The Loop
							while ( $query->have_posts() ) {
								$query->the_post();
								echo '<li class="py-2"><a href="'.get_the_permalink().'">'. get_the_title() . '</a></li>';
							}
							wp_reset_postdata();		
						?>
						</ul>
					</div><!-- /.physician__info__block -->
				<?php endif;?> 

					<!-- INSURANCE -->
					<?php if ( $post->hoagp_insuranceidnumbers ) : ?>
						<div class="p-3">
							<h2 class="font-ml lighter">
								<?php esc_html_e( 'Insurances Accepted / Provider ID Numbers', HOAGP_LANG ); ?>
							</h2>
							<div class="physician__info__list pl-5">
								<?php
								echo wp_kses_post(
									$post->hoagp_insuranceidnumbers,
									[
										'a'  => [],
										'p'  => [],
										'br' => [],
									]
								);
								?>
							</div>
						</div><!-- /.physician__info__block -->
					<?php endif; ?>
			</div>


						
					</div>
					

			</div>
			
					<!--schema markup-->
		
					<script type="application/ld+json">{
			"context":"https://schema.org",
			"@type": "Physician",
			"name": "<?php the_title(); ?>",
			"url": "<?php the_permalink(); ?>",
			"image": "<?php the_post_thumbnail_url();?>",
			"telephone":"<?php Tags\the_office_address('primary', null,'phone'); ?>",
			"affiliation": [<?php ob_start(); foreach ( $post->hoagp_affiliationslist as $affiliate ) : ?><?php echo ('"'.esc_html( $affiliate['Affiliation'] ).'",'); ?><?php endforeach; $output = ob_get_clean(); echo rtrim($output, ','); ?>],
			"educationalCredentialAwarded": [<?php ob_start(); $certs = explode (',', $post->hoagp_othercertifications); foreach ($certs as $cert) {echo ('"'.$cert.'",');} $output = ob_get_clean(); echo rtrim($output, ','); ?>],
			"address": {
				"@type": "PostalAddress",
				"streetAddress": "<?php Tags\the_office_street_address('primary', null,'address'); ?>",
				"addressLocality":"<?php Tags\the_office_city_only(); ?>",
				"addressRegion":"CA",
				"addressCountry": "US",
				"postalCode": "<?php Tags\the_office_zip(); ?> "
			},
			"availableLanguage": {
                "@type": "Language",
                "name": [<?php ob_start(); $language = explode (',', $post->hoagp_languages ); foreach($language as $languages){ $languages = '"'.$languages.'"'; print $languages.',';} $output = ob_get_clean(); echo rtrim($output, ','); ?>] 
        	},
			"medicalSpecialty":{
					"@type":"MedicalSpecialty",
					"name":[<?php ob_start(); $specialty =  array_merge(
														wp_list_pluck( $post->hoagp_primaryspecialty, 'Specialty' ),
														wp_list_pluck( $post->hoagp_secondaryspecialty, 'Specialty' )
													 ); foreach ( $specialty as $specialties ){ print ('"' . $specialties. '",');} $output = ob_get_clean(); echo rtrim($output, ','); ?>]
			}
			}
			</script>
			</div>
			
			
				<div class="col-12 col-md-9">
				
				
				
			</div><!--row-->
		</main>
	</div>
</div>

</div>

<?php
get_footer();
