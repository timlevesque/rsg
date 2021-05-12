<?php
/**
 * Physician Card
 *
 * @package hoag-physicans
 * @since 1.0.0
 */
?>
<?php use HoagPeople\TemplateTags as Tags;
$options = get_post_meta( get_the_ID(), 'post_options', true);
$distinct_title = null;
$endowed_chair = null;
$public_specialty = null;

if(isset($options['distinct_title'])){
	$distinct_title = $options['distinct_title'];
}
if(isset($options['endowed_chair'])){
	$endowed_chair = $options['endowed_chair'];
}
if(isset($options['public_specialty'])){
	$public_specialty = $options['public_specialty'];
} 

	$col1 = 'col-3 col-sm-12';
	$col2 = 'col-9 col-sm-12  py-3 pt-md-0 mt-sm-n2 px-2 px-sm-3"';
	$textAlign = 'text-sm-center';
	$imgBg = 'person-card-img-bg';
	$imgPadding = 'p-2 py-sm-4';
	$titleSize = 'h6';
	$small = 'small';
	$imgClass='physician__card__photo shadow m-0 mx-sm-auto';
?>
<div class="col border-sm-0 border-bottom pb-1 d-inline-flex p-0 p-sm-1 text-left hover-shadow  <?php echo $textAlign;?>">
	<div class="card square border-0 border-sm  m-1 flex-fill physician__card  position-relative ">
	<a href="<?php Tags\the_physician_link(); ?>" class="z-1 m-0 t-0 b-0 r-0 l-0 position-absolute "></a>
		<div class="container-lg px-0 text-tertiary">
        <?php if ( Tags\has_video() ) : ?>
            <span class="video-icon float-right icon ml-auto mb-n5 mt-2 mr-2 mt-sm-3 mr-sm-3"></span>
                    <?php endif; ?>
			<div class="row m-0">
            
				<div class="<?php echo($col1);?> <?php echo($imgPadding);?> <?php echo($imgBg);?> align-self-center">
                    
					<?php if ( has_post_thumbnail( $post->ID ) ) :
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
						
						
							<img src="<?php echo $image[0]; ?>" class="<?php echo $imgClass;?> img-flex"/>
					
					
					<?php endif; ?>
				</div>
		
				<div class="<?php echo $col2;?> ">
				
					<h4 class="card-title mb-0 mb-sm-2 <?php echo($titleSize);?>">
							<?php the_title(); ?>
                    </h4>


					<?php if($distinct_title != null):?>
                        <p class="physician-card__address  text-dark font-italic font-weight-bold small mb-0 "><?php echo $distinct_title; ?></p>
                    <?php elseif($endowed_chair != null):?>
						<p class="physician-card__address text-muted font-italic small mb-0 font-weight-bold"><?php echo $endowed_chair; ?></p>
                    <?php endif; ?>
					<?php if($public_specialty != null):?>
                        <p class="physician-card__specialty  <?php echo($small);?>  mb-0 my-sm-2 "><?php echo $public_specialty; ?></p>
					<?php elseif ( get_post_meta( $post->ID , 'hoagp_providerspecialties') ) : ?>
					<p class="physician-card__specialty  <?php echo($small);?>  mb-0 my-sm-2 "><?php Tags\get_specialties(); ?></p>
					<?php endif; ?>

					<p class="physician-card__address text-sm mb-1 mb-sm-2 text-grey"><?php $office1 = Tags\get_address('Primary Office', $post, 'city-state'); ?></p>
					<?php /* if ( Tags\is_valid_office2( 1 , $post) &&  Tags\get_address('Office 2', $post, 'city-state') != $office1 ) : endif;  */?>
<!--                 
                    <div class="text-xs  text-grey mb-0 mb-sm-2">
						<span class="icon-before calendar-icon-before  d-inline-flex mx-auto pr-2">Online Scheduling</span><?php if ($count != 1):?><span class="d-none d-sm-inline"><br></span><?php endif;?>
                		<span class="icon-before check-icon-before  d-inline-flex  mx-auto">Accepting New Patients</span>
               		</div>
 -->
				</div>
				<!-- <div class="physician-card__groups-affiliates">
					<?php if ( $post->hoagp_affiliationslist ) : ?>
						<strong class="list-title">
							<?php esc_html_e( 'Groups & Affiliations', HOAGP_LANG );
							?>
						</strong>
						<ul>
							<?php foreach ( $post->hoagp_affiliationslist as $affiliate ) : ?>
								<li>
									<?php echo esc_html( $affiliate['Affiliation'] ); ?>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
					<?php if ( $post->hoagp_associationslist ) : ?>
						<p>
							<?php foreach ( $post->hoagp_associationslist as $association ) : ?>
								<?php echo esc_html( $association['Affiliation'] ); ?>,
							<?php endforeach; ?>
						</p>
					<?php endif; ?>
                </div> -->
              
                
			</div>
        </div>
        <?php
        $practice = get_the_terms( get_the_ID() , 'practice' );
        //an array so only grabs the 1st one
        if ($practice != null):?>
        <div class="bg-secondary font-weight-bold border-top  px-4 small py-1 text-left text-sm-center"><?php echo $practice[0]->name ; ?></div>
        <?php endif; ?>
        
		<?php if ( !empty( $post->hoagp_providerhasnoclinicalprivileges) || !empty( $post->hoagp_providerhasopprivilegesonly ) ) : ?>
		<div class="container-fluid physician-card__privileges card-footer alert-danger px-2 py-1 ">
			<div class="row ">
				<div class="col-12">	
					<div class="physician-card__privilege__text">
						<p class="mb-0 ml-2 small"> <?php Tags\get_privileges(); ?> </p>
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>
	</div>
</div>


