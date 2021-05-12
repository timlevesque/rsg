<?php
/**
 * Physician Card
 *
 * @package hoag-physicans
 * @since 1.0.0
 */

use HoagPhysicians\TemplateTags as Tags;

?>
<div class="fad col-6 col-sm-4 col-md-3 p-1 m-0">
	<div class="card bg-light-grey border-0 h-100 p-0 m-0">
		<a href="<?php Tags\the_physician_link(); ?>">
			<?php Tags\the_image( 'hoagp-profile' , array('class' => 'card-img-top fluid-img flex-img dr-img') );
			?>
			<?php if ( Tags\has_video() ) : ?>
				<span class="video-icon position-absolute">
				<svg style="width:28%; height:28%;" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 72 72" style="enable-background:new 0 0 50 50;" xml:space="preserve">
				<circle class="st0" cx="37.9" cy="35.8" r="30.8"/>
				<path class="st1" d="M43.2,48.3h-18c-1.9,0-3.5-1.6-3.5-3.5v-18c0-1.9,1.6-3.5,3.5-3.5h18c1.9,0,3.5,1.6,3.5,3.5v18
				C46.6,46.7,45.1,48.3,43.2,48.3z"/>
				<path class="st1" d="M44,37.6L54.3,46c1.5,1.2,3.8,0.2,3.8-1.8l0-16.9c0-1.9-2.3-3-3.8-1.8L44,34C42.9,34.9,42.9,36.6,44,37.6z"/>
				</svg>
				
				<?php esc_html_e( '', HOAGP_LANG ); ?></span>
			<?php endif; ?>
		</a>
		<div class="card-body text-center">
			<h2 class="card-title font-normal bold"><?php the_title(); ?></h2>
				<?php if ( $post->hoagp_primaryspecialty || $post->hoagp_secondaryspecialty ) : ?>
					<div class="physician-card-speciality small">
						<?php
							Tags\the_comma_sep_array( array_merge(
								wp_list_pluck( $post->hoagp_primaryspecialty, 'Specialty' ),
								wp_list_pluck( $post->hoagp_secondaryspecialty, 'Specialty' )
							) );
							if ( Tags\get_extra_specialty() ) :
								echo esc_html_e( ", " . Tags\get_extra_specialty() );
							endif;								
						?>
					</div>
				<?php endif; ?>
				<div class="physician-card-city">
					<?php Tags\the_office_city(); ?>
				</div>
				
				
		</div>
		<div class="physician-card-footer">
				<a href="<?php Tags\the_physician_link(); ?>" class="btn .bg-transparent btn-outline-primary btn-block"><?php esc_html_e( 'View profile', HOAGP_LANG ); ?></a>
    	</div>
	</div>
</div>