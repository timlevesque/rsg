<?php
global $post;
global $count;
$options = get_post_meta( get_the_ID(), 'post_options', true);
$container=' col-sm-6';
$col1 = 'col-unset col-sm-12 align-self-center';
$col2 = 'col col-sm-12  py-3 pt-md-0 mt-sm-n2 px-2 px-sm-3"';
$textAlign = 'text-sm-center  ';
$imgBg = 'person-card-img-bg';
$imgPadding = 'p-2 py-sm-4';
$titleSize = 'h6';
$small = 'small';
$imgClass='physician__card__photo shadow m-0 mx-sm-auto';
$img_size = 'single-post-thumbnail';

if ($count == 1){
	$col1 = ' col-12 col-sm-5 col-md-4  d-flex pt-5 py-sm-4';
	$col2 = 'col-12 col-sm-7 p-4  col-md-8 pt-lg-5  pt-sm-4 pb-5';
	$textAlign = 'text-center text-sm-left ';
	$imgBg = 'person-single-img-bg bg-light-sm';
	$imgPadding = 'p-0';
	$titleSize = 'h4';
	$small = '';
	$imgClass='shadow physician-single-photo mx-auto align-self-center';
	$img_size = 'medium-large';
	$container='';
}
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

/* $practice = get_the_terms( get_the_ID() , 'practice' );
$practiceName = $practice[0]->name;

$practiceUrl=strtolower(str_replace(" ","-", $practiceName)); */
?>

<div class="col-12  col-md col-sm   pb-1 d-inline-flex p-0 p-sm-1 text-left <?php echo $container;?> <?php echo $textAlign;?>">
	<div class="hover-shadow card square border-0 bg-secondary25 overflow-visible flex-fill physician__card m-1 position-relative">
	<?php if ($count > 1):?>
		<a href="<?php the_permalink();?>" class="z-2 m-0 position-absolute r-0 l-0 b-0 t-0"></a>
	<?php endif;?>
		<div class="container-lg px-0 text-white">
       
			<div class="row m-0">
				<div class="<?php echo($col1);?> <?php echo($imgPadding);?> <?php echo($imgBg);?>">
                    
					<?php if ( has_post_thumbnail( $post->ID ) ) :
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $img_size ); ?>
							<img src="<?php echo $image[0]; ?>" class="<?php echo $imgClass;?> img-flex "/>
					<?php endif; ?>
				</div>
				<div class="<?php echo $col2;?> ">
					<h4 class="card-title mb-0 mb-sm-2 text-white <?php echo($titleSize);?>">
					<?php if ($count == 1):?>
						<a href="<?php the_permalink();?>" class="text-white"><?php the_title(); ?></a>
					<?php else:?>
						<?php the_title(); ?>
					<?php endif;?>
					
                    </h4>
                    <?php 
					if($count == 1):?>
					<?php if($distinct_title != null):?>
                        <p class="physician-card__address  text-secondary font-italic font-weight-bold  small mb-0 "><?php echo $distinct_title; ?></p>
						<?php endif; ?>
                    <?php if($endowed_chair != null):?>
						<p class="physician-card__address text-muted font-italic small mb-0"><?php echo $endowed_chair; ?></p>
                    <?php endif; ?>
					<?php else: ?>
		
				<?php if($distinct_title != null):?>
                        <p class="physician-card__address  text-secondary font-italic font-weight-bold small mb-0 "><?php echo $distinct_title; ?></p>
                    <?php elseif($endowed_chair != null):?>
						<p class="physician-card__address text-muted font-italic small mb-0 font-weight-bold"><?php echo $endowed_chair; ?></p>
                    <?php endif; ?>
					<?php endif; ?>
				</div>
			</div>
			
        </div>
	</div>
</div>
