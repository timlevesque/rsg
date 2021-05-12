<?php
/**
 * Filter partial.
 *
 * @package hoag-hospital
 * @since 1.0.0
 */

use HoagPhysicians\TemplateTags as Tags;

$distance = Tags\get_filter_setting( 'distance' );

$location_name = ( ! empty( $_GET['location_name'] ) ) ? $_GET['location_name'] : '';

?>
<div class="card border-0">
	<div class="card-header row no-gutters bg-white py-4 border-0">
		<div class="col-8 ">
			<h4 class="font-md font-weight-light mt-1 "><?php esc_html_e( 'Filter Results', HOAGP_LANG ); ?></h4>
		</div>
		<div class="col-4 text-right pt-2">
			<a href="<?php echo esc_url( HOAGP_ROOT_URL );?>"><span aria-hidden="true">reset</span></a>
		</div>
	</div>
	<div class="card-body bg-light-grey mb-0 pb-0">
		<div class="search-filters">
			<form action="<?php echo esc_url( HOAGP_ROOT_URL ); ?>" method="GET">
				<div class="search-filters__block">
					<div class="row mx-1  bg-white mt-md-3">
						<div class="col-4 pt-3 pr-0 mr-0">
						<label for="distance">
						<?php esc_html_e( 'Distance:', HOAGP_LANG ); ?>
					</label>
						</div>
						<div class="col-8 mx-0 pl-0 pr-1">
						<div class="distance__input">
						<div class="distance__input__tt mr-0 pr-0 pt-0 mt-0 ">
							<button title="<?php esc_html_e( 'Click here to change your location', HOAGP_LANG ); ?>" class="distance-icon a11y-tip__trigger" id="user-location" type="button"></button>
						</div>

						<input class="border-0 small pt-4"type="text" name="location_name" placeholder="Zip code or city" value="<?php echo esc_attr( $location_name ); ?>" id="location" onchange="this.form.submit()">

						<p class="error">
							<strong><?php esc_html_e( 'Sorry, location services are unavailable.', HOAGP_LANG ); ?></strong>
						</p>
					</div>
						</div>
					</div>	
				<!-- 	<label for="distance">
						<?php //esc_html_e( 'Distance', HOAGP_LANG ); ?>
					</label>

					<div class="distance__input">
						<div class="distance__input__tt">
							<button title="<?php //esc_html_e( 'Click here to change your location', HOAGP_LANG ); ?>" class="distance-icon a11y-tip__trigger" id="user-location" type="button"></button>
						</div>

						<input type="text" name="location_name" placeholder="Zip code or city" value="<?php echo esc_attr( $location_name ); ?>" id="location" onchange="this.form.submit()">

						<p class="error">
							<strong><?php //esc_html_e( 'Sorry, location services are unavailable.', HOAGP_LANG ); ?></strong>
						</p>
					</div> -->
					<input type="hidden" name="lat" value="<?php Tags\the_filter_setting( 'lat' ); ?>" id="latitude">
					<input type="hidden" name="long" value="<?php Tags\the_filter_setting( 'long' ); ?>" id="longitude">

					<div class="mx-1 row within-option bg-white border-0 pt-1 mt-3 mt-md-5">
						<div class="col-4 pt-2 bold">
							<label>
						<?php esc_html_e( 'Within:', HOAGP_LANG ); ?>
							</label>
	
						</div>

						<div class="col-8 text-muted border-0 custom-select custom-select--within h-100">
							<select class="text-muted small" name="distance" id="distance-select" onchange="this.form.submit()">
								<option value="" <?php selected( $distance, false ); ?>>
									<?php esc_html_e( 'Any', HOAGP_LANG ); ?>
								</option>
								<?php foreach ( [ 5, 10, 25, 50 ] as $miles ) : ?>
									<option value="<?php echo absint( $miles ); ?>" <?php selected( $distance, $miles ); ?>>
										<?php printf( esc_html__( '%smi', HOAGP_LANG ), absint( $miles ) ); ?>
									</option>
								<?php endforeach; ?>
							</option>
							</select>
						</div>
					</div>
				</div>


				
				<div class="search-filters__block mt-md-5">
					<div class="row mx-1 bg-white pt-2">
					<div class="col-4 pt-1">
						<label for="specialty"><?php esc_html_e( 'Specialty:', HOAGP_LANG ); ?></label>
					</div>
					<div class="col-8 border-0 custom-select custom-select--filter h-100">
						<select id="specialty" name="specialty" class="small text-secondary search-filters__select" onchange="this.form.submit()">
							<option value=""><?php esc_html_e( 'Any', HOAGP_LANG ); ?></option>
							<?php Tags\the_specialty_options(); ?>
						</select>
					</div>
					</div>
				</div>

				<div class="search-filters__block mt-md-5">
					<div class="row bg-white mx-1 pt-1">
						<div class="col-4 pt-2">
							<label for="insurance"><?php esc_html_e( 'Insurance:', HOAGP_LANG ); ?></label>
						</div>	
					<div class="col-8 border-0 custom-select custom-select--filter h-100">
						<select id="insurance" name="insurance" class="small text-secondary search-filters__select" onchange="this.form.submit()">
							<option value=""><?php esc_html_e( 'Any', HOAGP_LANG ); ?></option>
							<?php Tags\the_filter_options( 'insurance' ); ?>
						</select>
					</div>
					</div>
				</div>

				<div class="search-filters__block mt-md-5">
					<div class="row bg-white mx-1 pt-1">
						<div class="col-4 pt-2">
							<label for="language"><?php esc_html_e( 'Language:', HOAGP_LANG ); ?></label>
						</div>
					<div class="border-0 col-8 custom-select custom-select--filter h-100">
						<select id="language" name="language" class="small text-secondary search-filters__select" onchange="this.form.submit()">
							<option value=""><?php esc_html_e( 'Any', HOAGP_LANG ); ?></option>
							<?php Tags\the_filter_options( 'language' ); ?>
						</select>
					</div>
					</div>
				</div>
				<div class="row mb-0 pb-0 bg-lightgrey border-0 mt-md-5 py-3" style="margin-right:-13px; margin-left:-13px;">
				<div class="mx-5 search-filters__block --checkbox">
						<span><?php esc_html_e( 'Gender', HOAGP_LANG ); ?></span>
					<div class="gender-row">
					<label class="pr-5" for="Female">
						<input type="checkbox" name="gender" value="f" id="female" <?php checked( 'f', Tags\get_filter_setting( 'gender' ) ); ?> onchange="this.form.submit()">
						<?php esc_html_e( 'Female', HOAGP_LANG ); ?>
					</label>

					<label for="Male">
						<input type="checkbox" name="gender" value="m" id="male"  <?php checked( 'm', Tags\get_filter_setting( 'gender' ) ); ?> onchange="this.form.submit()">
						<?php esc_html_e( 'Male', HOAGP_LANG ); ?>
					</label>
					</div>
				</div>

				<div class="mx-5 search-filters__block --checkbox">
					
					<label for="new-patients">
						<input type="checkbox" name="new-patients" value="1" id="new-patients" <?php checked( Tags\get_filter_setting( 'new-patients' ) ); ?> onchange="this.form.submit()">
						<span><?php esc_html_e( 'Accepting new patients', HOAGP_LANG ); ?></span>
					</label>
				</div>
				</div>

				<input type="hidden" value="<?php Tags\the_filter_setting( 'fullname' ); ?>" name="fullname" id="name" />
				<input type="hidden" value="<?php Tags\the_filter_setting( 'sort' ); ?>" name="sort" id="sort" />
<!--
				<div class="search-filters__block">
					<input value="Update Filters" class="filter__submit" type="submit" />
				</div>
-->
			</form>
		</div>
	</div>
</div>
