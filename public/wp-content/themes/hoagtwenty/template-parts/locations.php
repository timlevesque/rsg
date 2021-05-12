<?php
/**
 * "locations" layout for Display Posts Shortcode
 * sample short code [display-posts post_type='hoag_locations' layout="locations" title='Locations' taxonomy="location-category" tax_term="urgent-care"]
**/

/**
 * TO-DO add back Urgent care wait time integration and logic.
 * Use if (isset($wait_time_id )): to load script in theme footer.
 * <script src='https://s3-us-west-1.amazonaws.com/clockwisepublic/clockwiseWaitTimes.min.js'></script>

 * 
 */
//post_type


$local_title = get_the_title();
$hoag_local_fields = get_post_meta( get_the_ID(), 'hoag_local' )[0];
$display_name = $hoag_local_fields['display_name'];
$notice = $hoag_local_fields['notice'];
$alert = $hoag_local_fields['alert'];
$img2 = $hoag_local_fields['second_img'];
$img3 = $hoag_local_fields['third_img'];
$office_name = $hoag_local_fields['pofficename'];
$phone = $hoag_local_fields['phone'];
$fax = $hoag_local_fields['fax'];
$address1 = $hoag_local_fields['address1'];
$address2 = $hoag_local_fields['address2'];
$city = $hoag_local_fields['city'];
$state = $hoag_local_fields['state'];
$zip = $hoag_local_fields['zip'];
$long = $hoag_local_fields['longitude'];
$lat = $hoag_local_fields['latitude'];
$wait_time_id = $hoag_local_fields['wait_time_id'];
$google_maps_url = $hoag_local_fields['location_google_maps_id'];
// hours vars
if (isset ($hoag_local_fields['sunday'])){
	$sunday_open = $hoag_local_fields['sunday'];
}

$sun_hr_open = $hoag_local_fields['sunday_start'];
$sun_hr_closed = $hoag_local_fields['sunday_end'];

if (isset( $hoag_local_fields['monday'] )){
	$monday_open = $hoag_local_fields['monday'];
}
$mon_hr_open = $hoag_local_fields['monday_start'];
$mon_hr_closed = $hoag_local_fields['monday_end'];

if (isset ($hoag_local_fields['tuesday'])){
	$tuesday_open = $hoag_local_fields['tuesday'];
}
$tues_hr_open = $hoag_local_fields['tuesday_start'];
$tues_hr_closed = $hoag_local_fields['tuesday_end'];

if (isset ($hoag_local_fields['wednesday'])){
	$wednesday_open = $hoag_local_fields['wednesday'];
}
$wed_hr_open = $hoag_local_fields['wednesday_start'];
$wed_hr_closed = $hoag_local_fields['wednesday_end'];

if (isset ($hoag_local_fields['thursday'])){
	$thursday_open = $hoag_local_fields['thursday'];
}
$thur_hr_open = $hoag_local_fields['thursday_start'];
$thur_hr_closed = $hoag_local_fields['thursday_end'];

if (isset ($hoag_local_fields['friday'])){
	$friday_open = $hoag_local_fields['friday'];
}
$fri_hr_open = $hoag_local_fields['friday_start'];
$fri_hr_closed = $hoag_local_fields['friday_end'];
if (isset ($hoag_local_fields['saturday'])){
	$saturday_open = $hoag_local_fields['saturday'];
}
$sat_hr_open = $hoag_local_fields['saturday_start'];
$sat_hr_closed = $hoag_local_fields['saturday_end'];
?>
<!-- <article class="post-summary large"> -->
<?php // print_r($original_atts);?>
<?php // print $original_atts['tax_term'];?>
	<script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": ["Place", "LocalBusiness", "MedicalClinic", "MedicalOrganization"],
		"name": "<?php echo $local_title;?>",
		"description": "<?php the_content();?>",
		"url": "<?php esc_url( get_permalink() );?>",
		"image":"<?php echo $local_img;?>",
		"telephone": "<?php echo $phone;?>",
		"faxNumber": "<?php echo $fax;?>",
		"areaServed": "<?php echo $city;?>",
		"address": {
			"@type": "PostalAddress",
			"addressLocality": "<?php echo $city;?>",
			"addressRegion": "<?php echo $state;?>",
			"postalCode": "<?php echo $zip;?>",
			"streetAddress": "<?php echo $address1;?>"
		},
		"geo": "<?php echo $long;?>, <?php echo $lat;?>",
		"openingHours":[
			<?php if ($mon_hr_open!='' && $mon_hr_closed!=''):?>
				"Monday <?php echo $mon_hr_open;?>-<?php echo $mon_hr_closed;?>"
			<?php endif;?>
			<?php if ($tues_hr_open!='' && $tues_hr_closed!=''):?>
				,"Tuesday <?php echo $tues_hr_open;?>-<?php echo $tues_hr_closed;?>"
			<?php endif;?>	
			<?php if ($wed_hr_open!='' && $wed_hr_closed!=''):?>
				,"Wednesday <?php echo $wed_hr_open;?>-<?php echo $wed_hr_closed;?>"	
			<?php endif;?>
			<?php if ($thur_hr_open!='' && $thur_hr_closed!=''):?>
				,"Thursday <?php echo $thur_hr_open;?>-<?php echo $thur_hr_closed;?>"
			<?php endif;?>
			<?php if ($fri_hr_open!='' && $fri_hr_closed!=''):?>
				,"Friday <?php echo $fri_hr_open;?>-<?php echo $fri_hr_closed;?>"
			<?php endif;?>
			<?php if ($sat_hr_open!='' && $sat_hr_closed!=''):?>
				,"Saturday <?php echo $sat_hr_open;?>-<?php echo $sat_hr_closed;?>"	
			<?php endif;?>
			<?php if ($sun_hr_open!='' && $sun_hr_closed!=''):?>
				,"Sunday <?php echo $sun_hr_open;?>-<?php echo $sun_hr_closed;?>"	
			<?php endif;?>
		]
		}
	</script>
	<div class="col p-0 m-0 mb-4">
	<div class="card h-100 pb-2">
		<figure class="">
			<a class="entry-image-link" href="<?php echo get_permalink(); ?>"><?php echo get_the_post_thumbnail( get_the_ID(),'medium-large', array('class' => 'img-fluid img-flex')); ?></a>
		</figure>
		<h5 class="card-title pl-1"><?php if ($display_name == "") /* the fail safe ---->*/ {print $local_title;} else{print $display_name;}?></h5>
		<?php if($alert  !=''):?>
			<div class="alert alert-primary pl-1 m-0">
				<span class=""><?php print $alert; ?></span>
			</div>
		<?php endif;?><!-- actions logic -->
		<?php if (isset($original_atts['tax_term']) && $original_atts['tax_term'] != 'urgent-care'):  ?>
			<div class="card-body row pt-5 p px-5 m-0 mx-0">
				<?php if ($office_name !=''):?>
					<a href="/physicians/?specialty=<?php print $speciality;?>&office-name=<?php print $office_name;?>" class=" buttons-xs col-7 col-sm-12 col-xl-7 px-0 pr-md-0  pb-3 ">
					<div class="w-100 btn btn-primary">Physicians @ Location</div></a>																											
				<?php endif; ?> 
				<?php if ($google_maps_url !=''):?>
					<a href="<?php print $google_maps_url;?>" class="buttons-xs col-5 col-sm-12 col-xl-5 px-0 pl-2 pl-sm-0 pl-xl-2" target="_blank">
					<div class="btn btn-outline-primary w-100">Get Directions</div></a>
				<?php endif; ?>
			</div>
		<?php endif;?><!-- end action logic -->
		<!-- urgent care CTA -->
		<?php if (isset($original_atts['tax_term']) && $original_atts['tax_term'] == 'urgent-care'):  ?>
			<div class="card-footer card-body row pt-5 pl-1 pb-4 px-5 mx-0">
				<?php //logic to get directions or reserve spot
					if ($wait_time_id !=''):
				?>
					<a href="https://www.clockwisemd.com/hospitals/<?php print $wait_time_id;?>/appointments/new" class="buttons-xs pr-sm-0 pr-2 col-6 col-sm-12 col-xl-6 ml-0 pl-0 pt-0 pb-0 pb-sm-3 clockwise-btn" target="_blank" id="cwmd">
					<div class="w-100 btn btn-primary">Reserve my Spot</div></a>	
					<?php endif; ?>
				<?php if ($google_maps_url !=''):?>
					<a href="<?php print $google_maps_url;?>" class="buttons-xs col-6 col-sm-12  col-xl-6 p-0 pl-2 pl-sm-0 pl-xl-2 " target="_blank">
					<div class="btn btn-outline-primary w-100">Get Directions</div></a>
					<?php endif; ?>
			</div> 
		<?php endif;?>
		<!-- end urgent care CTA -->
		<!--wait time-->
		<?php if (isset($original_atts['tax_term']) && $original_atts['tax_term'] == 'urgent-care'):  ?>
			<div class="small alert alert-danger mt-0">
				<span class="bolder ml-1 pl-2" id='current-wait-<?php print $wait_time_id;?>'></span> ( 
				<span id='current_patients_<?php print $wait_time_id;?>'></span>  in line )
			</div>	
		<?php endif;?>
		<!-- END wait time-->
		<!-- Address --> 
		<?php if($address1 !=''):?>
            <div class="pl-1">
			<a href="<?php print $google_maps_url; ?>" method="get" target="">
				<?php if($address1 !=''){print $address1;}?> <br>
				<?php if($address2 !=''){ print $address2;}?> <br>
				<?php if($city !=''){print $city;} ?>, <?php if($state !=''){print $state;} ?>  <?php if($zip !=''){print $zip;} ?>
			</a>
            </div>
		<?php endif;?>
		<!-- END Address --> 
		<!-- phone -->
		<?php if ($phone !=''):?>
			<div class="pl-1">
				<a href="tel:<?php print $phone; ?>" id="loc-phone" class="loc-phone"><?php print $phone; ?></a>
			</div>
		<?php endif; ?>
		<!-- END phone -->
		<!-- fax -->
		<?php if ($fax !=''):?>
		<div class="pl-1">
			<a href="tel:<?php print $fax; ?>" id="loc-fax" class="loc-fax"><?php print $fax; ?></a>
		</div>
		<?php endif; ?>
		<!-- END fax -->
		<!-- hours of opperation -->
		<?php //hours of opperation
			if( 
				isset($sunday_open)
				|| isset($monday_open)
				|| isset($tuesday_open)
				|| isset($wednesday_open)
				|| isset($thursday_open)
				|| isset($friday_open)
				|| isset($saturday_open)
		): ?>
		<div class="pl-1">
			<script>
				var d = new Date();
				var weekday = new Array(7);
				weekday[0] = "Sunday";
				weekday[1] = "Monday";
				weekday[2] = "Tuesday";
				weekday[3] = "Wednesday";
				weekday[4] = "Thursday";
				weekday[5] = "Friday";
				weekday[6] = "Saturday";
				var n = weekday[d.getDay()];
				if (n == 'Sunday'){
					var is_open = "<?php echo $sunday_open; ?>";
					var open = "<?php echo ($sun_hr_open." - ".$sun_hr_closed); ?>";
					if (is_open == 1 ){ document.write(open);}else{document.write('closed');}					
				}else if (n == 'Monday'){			
					var is_open = "<?php echo $monday_open; ?>";
					var open = "<?php echo ($mon_hr_open." - ".$mon_hr_closed); ?>";
					if (is_open == 1 ){ document.write(open);}else{document.write('closed');}
				}else if (n == 'Tuesday'){
					var is_open = "<?php echo $tuesday_open; ?>";
					var open = "<?php echo ($tues_hr_open." - ".$tues_hr_closed); ?>";
					if (is_open == 1 ){ document.write(open);}else{document.write('closed');}	
				}else if (n == 'Wednesday'){
					var is_open = "<?php echo $wednesday_open; ?>";
					var open = "<?php echo ($wed_hr_open." - ".$wed_hr_closed); ?>";
					if (is_open == 1 ){ document.write(open);}else{document.write('closed');}
				}else if (n == 'Thursday'){
					var is_open = "<?php echo $thursday_open; ?>";
					var open = "<?php echo ($thur_hr_open." - ".$thur_hr_closed); ?>";
					if (is_open == 1 ){ document.write(open);}else{document.write('closed');}
				}else if (n == 'Friday'){
					var is_open = "<?php echo $friday_open; ?>";
					var open = "<?php echo ($fri_hr_open." - ".$fri_hr_closed); ?>";
					if (is_open == 1 ){ document.write(open);}else{document.write('closed');}
				}else if (n == 'Saturday'){
					var is_open = "<?php echo $saturday_open; ?>";
					var open = "<?php echo ($sat_hr_open." - ".$sat_hr_closed); ?>";
					if (is_open == 1 ){ document.write(open);}else{document.write('closed');}		
				}
			</script>
			<p class="bolder">Hours of Operation:</p>
			<?php  if ( 
					$mon_hr_open === $tues_hr_open 
					&& $mon_hr_open === $wed_hr_open 
					&& $mon_hr_open === $thur_hr_open 
					&& $mon_hr_open === $fri_hr_open 
					&& $mon_hr_closed === $tues_hr_closed 
					&& $mon_hr_closed === $wed_hr_closed 
					&& $mon_hr_closed === $thur_hr_closed 
					&& $mon_hr_closed === $fri_hr_closed 
				):  
			?>
				<span class="">Mon - Fri: <?php print $mon_hr_open; ?> - <?php print $mon_hr_closed; ?><br></span>
			<?php  else :?>
				<span class="">Mon: 
					<?php if (isset($monday_open)): ?>
						<?php print $mon_hr_open; ?> - <?php print $mon_hr_closed; ?>
					<?php else:?>
						Closed
					<?php endif;?>
				</span><br/>
				<span class="">Tues: 
					<?php if (isset($tuesday_open)): ?>
						<?php print $tues_hr_open; ?> - <?php print $tues_hr_closed; ?>
					<?php else:?>
						Closed
					<?php endif;?>
				</span><br/>
				<span class="">Wed: 
					<?php if (isset($wednesday_open)): ?>
						<?php print $wed_hr_open; ?> - <?php print $wed_hr_closed; ?>
					<?php else:?>
						Closed
					<?php endif;?>
				</span><br/>
				<span class="">Thur: 
					<?php if (isset($thursday_open)): ?>
						<?php print $thur_hr_open; ?> - <?php print $thur_hr_closed; ?>
					<?php else:?>
						Closed
					<?php endif;?>
				</span><br/>
				<span class="">Fri: 
				<?php if (isset($friday_open)): ?>
					<?php print $fri_hr_open; ?> - <?php print $fri_hr_closed; ?>
				<?php else:?>
					Closed
				<?php endif;?>
				</span><br/>
			<?php endif; ?>
			<?php if (isset($saturday_open) && isset($sunday_open)):
				//if sat & sun hours are the same 
				if ( ($sun_hr_open === $sat_hr_open) && ($sun_hr_closed === $sat_hr_closed) ):?>
					<span class="">Sat - Sun: <?php print $sun_hr_open; ?> - <?php print $sun_hr_closed; ?></span><br/>
				<?php endif;?>
			<?php else :
				//else sat hours and sunday hours seperate ?>
				<span class="">Sat: 
					<?php if (isset($saturday_open)): ?>
						<?php print $sat_hr_open; ?> - <?php print $sat_hr_closed; ?></span>
					<?php else:?>
						Closed
					<?php endif;?>
				</span><br/>
				<span class="">Sun: 
					<?php if (isset($sunday_open)): ?>
						<?php print $sun_hr_open; ?> - <?php print $sun_hr_closed; ?></span>
					<?php else:?>
						Closed
					<?php endif;?>	 
				</span>
			<?php endif;?> 
		</div>
		<?php endif; // end hours of opperation ?>
	<!-- END hours of opperation -->
    </div><!-- end card -->
	</div>
	<!-- END action logic -->
<!-- </article> -->
<?php
//loop in the specific taxonomies
	if ($wait_time_id !=''){
		require_once(plugin_dir_path( __FILE__ ) . '/clockwise.php');
	}
?>