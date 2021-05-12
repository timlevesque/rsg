<?php
$title = get_the_title();
$rsg_listing_fields = get_post_meta( get_the_ID(), 'rsg_listing' )[0];
$type = $rsg_listing_fields['listing_type'];
$size = $rsg_listing_fields['listing_size'];
$status = $rsg_listing_fields['listing_status'];
$zone = $rsg_listing_fields['listing_zone'];
$x_url = $rsg_listing_fields['listing_link'];
$address1 = $rsg_listing_fields['address1'];
$address2 = $rsg_listing_fields['address2'];
$city = $rsg_listing_fields['city'];
$state = $rsg_listing_fields['state'];
$zip = $rsg_listing_fields['zip'];
$img = get_the_post_thumbnail_url();

if($x_url == ''){
	$x_url = get_permalink(); 
}

?>

<div class="col media-card slideleft stagger p-2 bg-alternate">
<div class="h-100  w-100 position-relative rounded  ">
<div class="offset-left position-absolute t-0 l-0 r-0 b-0"></div>
	<div class="h-100 w-100 position-relative">
	<?php the_post_thumbnail('medium', array('class' => 'img-flex img-fluid h-100 w-100 position-relative  ')); ?>
</div>

	<div class=" position-absolute t-0 b-0 r-0 l-0 bg-fade-up"></div>
	<div class=" position-absolute t-0 b-0 r-0 l-0 border border-light m-2"></div>
	<div class="position-absolute b-0 l-0 text-white m-4 ">
		<h2 class=" mb-0 text-ms font-weight-bold">
			<?php echo $title;?>
		</h2>
		<?php if($size !== ''):?>
		<small class=""><?php echo $size;?></small>
		<?php endif;?>
	</div>
	<?php if($type !== ''):?>
	<small class="badge badge-warning position-absolute t-0 l-0 m-4"><?php echo $type;?></small>
	<?php endif;?>
	<?php if($status !== ''):?>
	<small class="badge badge-danger shadow position-absolute t-0 r-0 m-4"><?php echo $status;?></small>
	<?php endif;?>
 </div>
 </div>




