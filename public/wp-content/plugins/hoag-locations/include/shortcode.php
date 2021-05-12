<?php
/**
 * add shortcode with bundled design elements
 */

 //add shortcode
function hoag_locations_shortcode($atts) {
	$city_info = $atts['city'];
	$cat_info = $atts['cat'];
	$location_slug = $atts['slug'];
	$style=$atts['style'];
	$multi_img = $atts['multi-img'];
	$lp=$atts['landing-page'];
	$tabs=$atts['tabs'];
	$img_only=$atts['img-only'];
	$full_width = $atts['full-width'];
	$heading = $atts['heading'];
	$merch = $atts['merch'];
	$buttons = $atts['buttons'];
	$links = $atts['links'];
	$hoag_local_fields = get_post_meta( get_the_ID(), 'hoag_local' )[0];
	$display_name = $hoag_local_fields['display_name'];

	$args = array(
		'post_type'   => 'hoag_locations',
		'post_status' => 'publish',
	    'orderby'			=> 'title',
		'order'				=> 'ASC',
		'name' => $location_slug,
		 'tax_query'   => array(
			'relation' => 'or',
			array(
				'taxonomy' => 'location-city',
				'field'    => 'slug',
				'terms'    => $city_info,
				'operator' => 'IN',
			)
			,
			array(
				'taxonomy' => 'location-category',
				'field'    => 'slug',
				'terms'    => $cat_info,
				'operator' => 'IN',
			),
		)
	);
	 $locations = new WP_Query( $args );
	 $i = 0;
	if( $locations->have_posts() ) :
		//capture output and convert it to a string
		$count = $locations->post_count;
		if($count == 1){
			$card_width = "col-12";
		} elseif ($count==2 ) {
			$card_width = "col-12";
		}elseif ($count ==3){
			$card_width = "col-md-6 col-lg-4";
		}else{
			$card_width = "col-md-6 col-lg-4";
		}
		$count_remainder = $count % 3; //remainer of current count divided by max number of columns
		if ($count_remainder >0){}
		ob_start(); ?>
<div class="hoag-locations w-100">

	<?php if ($count >=2 && $heading != 'false' ):?>
		<div class=" row ie-row w-100 p-0 m-0">
			<span class="h2 pl-5 pt-3 pb-2"><?php print $count; ?> Locations in
			<?php 
			$child_post = get_post(); 
			$child_title = $child_post->post_title;
			$child_id = get_the_ID($child_post);
			$specialities = array(
									"Pediatrics"
									, "Urgent Care"
									, "Internal Medicine"	
									, "Family Medicine"	
									, "Allergy & Immunology"		
								);
			$child_title_new = str_replace($specialities, "", $child_title);
			$city_name = str_replace("Hoag", "", $child_title_new); 
			print $city_name;
			?>
			</span>
		</div>
	<?php endif;?>
	
	<div class=" row m-0">
		<?php
		while( $locations->have_posts() ) :
			$locations->the_post();
			$terms = get_the_terms( $locations->ID, 'location-category' );
			foreach ( $terms as $term ) {
			$speciality = $term->name;
			}
			//print $locations['location-category'];
			$local_title = get_the_title();
			$custom_fields = get_post_custom();
			$hoag_local_fields = get_post_meta( get_the_ID(), 'hoag_local' )[0];
			$local_img = get_the_post_thumbnail_url(get_the_ID());
			//print_r($hoag_local_fields);
			$i = $i + 1;
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
			$sunday_open = $hoag_local_fields['sunday'];
			$sun_hr_open = $hoag_local_fields['sunday_start'];
			$sun_hr_closed = $hoag_local_fields['sunday_end'];

			$monday_open = $hoag_local_fields['monday'];
			$mon_hr_open = $hoag_local_fields['monday_start'];
			$mon_hr_closed = $hoag_local_fields['monday_end'];

			$tuesday_open = $hoag_local_fields['tuesday'];
			$tues_hr_open = $hoag_local_fields['tuesday_start'];
			$tues_hr_closed = $hoag_local_fields['tuesday_end'];

			$wednesday_open = $hoag_local_fields['wednesday'];
			$wed_hr_open = $hoag_local_fields['wednesday_start'];
			$wed_hr_closed = $hoag_local_fields['wednesday_end'];

			$thursday_open = $hoag_local_fields['thursday'];
			$thur_hr_open = $hoag_local_fields['thursday_start'];
			$thur_hr_closed = $hoag_local_fields['thursday_end'];

			$friday_open = $hoag_local_fields['friday'];
			$fri_hr_open = $hoag_local_fields['friday_start'];
			$fri_hr_closed = $hoag_local_fields['friday_end'];

			$saturday_open = $hoag_local_fields['saturday'];
			$sat_hr_open = $hoag_local_fields['saturday_start'];
			$sat_hr_closed = $hoag_local_fields['saturday_end'];
			//styles for the location card
			//loaction JSON
			?>
			<script type="application/ld+json">{
				"@context": "http://schema.org",
				"@type": ["Place", "LocalBusiness", "MedicalClinic", "MedicalOrganization"],
				"name": "<?php print $local_title;?>",
				"description": "<?php the_content();?>",
				"url": "<?php esc_url( get_permalink() );?>",
				"image":"<?php print $local_img;?>",
				"telephone": "<?php print $phone;?>",
				"faxNumber": "<?php print $fax;?>",
				"areaServed": "<?php print $city;?>",
				"address": {
				"@type": "PostalAddress",
				"addressLocality": "<?php print $city;?>",
				"addressRegion": "<?php print $state;?>",
				"postalCode": "<?php print $zip;?>",
				"streetAddress": "<?php print $address1;?>"
				},
				"geo": "<?php print $long;?>, <?php print $lat;?>",
				"openingHours":[
					<?php if ($mon_hr_open!='' && $mon_hr_closed!=''):?>
						"Monday <?php print $mon_hr_open;?>-<?php print $mon_hr_closed;?>"
					<?php endif;?>
					<?php if ($tues_hr_open!='' && $tues_hr_closed!=''):?>
						,"Tuesday <?php print $tues_hr_open;?>-<?php print $tues_hr_closed;?>"
					<?php endif;?>	
					<?php if ($wed_hr_open!='' && $wed_hr_closed!=''):?>
						,"Wednesday <?php print $wed_hr_open;?>-<?php print $wed_hr_closed;?>"	
					<?php endif;?>
					<?php if ($thur_hr_open!='' && $thur_hr_closed!=''):?>
						,"Thursday <?php print $thur_hr_open;?>-<?php print $thur_hr_closed;?>"
					<?php endif;?>
					<?php if ($fri_hr_open!='' && $fri_hr_closed!=''):?>
						,"Friday <?php print $fri_hr_open;?>-<?php print $fri_hr_closed;?>"
					<?php endif;?>
					<?php if ($sat_hr_open!='' && $sat_hr_closed!=''):?>
						,"Saturday <?php print $sat_hr_open;?>-<?php print $sat_hr_closed;?>"	
					<?php endif;?>
					<?php if ($sun_hr_open!='' && $sun_hr_closed!=''):?>
						,"Sunday <?php print $sun_hr_open;?>-<?php print $sun_hr_closed;?>"	
					<?php endif;?>
					]
				}
				</script>
		<?php if($i===1):?>
		
		<?php endif;?>
		<!-- location displayed here -->
		<?php if ($count > 1 || $style==='card'): //if multiple locations ?>
			<div class="col-12 col-sm-6 col-md-4  location-spacer p-0 m-0">	
			<div class="card   bg-light-grey border-0 h-100 hoag-location">
				<div id="<?php if ($display_name == "") /* the fail safe ---->*/ {print $local_title;} else{print $display_name;}?>" class=" <?php if ($img_only != true){echo('card-top');}?> ie-card">
					<?php the_post_thumbnail('medium', ['class' => 'card-img-top flex-img background-img', 'alt'=>$local_title, 'title' => $local_title, 'style' => 'height:350px;']); ?>
					<div class="card-top-block  p-2 bg-bottom-grad ie-card-text">
						<h2 class="card-title text-overlay-centered-bottom text-left font-ms lighter  w-100 pl-5 text-white"><?php if ($display_name == "") /* the fail safe ---->*/ {print $local_title;} else{print $display_name;}?></h2>
					</div>
				</div>
		<?php else: ?>
			<div class="col-12 p-0">	
			<div class="row no-gutters">
			<?php if ($img_only != "true"):?>
				<div class="card bg-light-grey hoag-location single-location col-sm-5 col-md-4 p-0 m-0 order-2 order-sm-1" >
					<h2 class="card-title d-none d-sm-block text-left px-5"><?php if ($display_name == "") /* the fail safe ---->*/ {print $local_title;} else{print $display_name;}?></h2>
		<?php endif;?>
		<?php endif; ?>
			<?php if($alert  !='' && $img_only != "true"):?>
				<div class="small alert alert-primary mb-0">
					<span class="ml-1 pl-2"><?php print $alert; ?></span>
				</div>
			<?php endif;?>
		<!--start buttons -->
		<?php if($buttons != 'false'):?>
		
<div class="">
	<?php
			$page_id = get_queried_object_id();
			$parent_id = wp_get_post_parent_id($page_id);		
			$parent = get_the_title($parent_id);

		if ($parent != 'Hoag Urgent Cares' && $img_only != true):  ?>
			
		  <div class="card-footer card-body row pt-5 px-5 m-0 mx-0">
				
				<?php if ($office_name !=''):?>
					<a href="/physicians/?specialty=<?php print $speciality;?>&office-name=<?php print $office_name;?>" class=" buttons-xs col-7 col-sm-12 col-xl-7 px-0 pr-md-0  pb-3 ">
					<div class="w-100 btn btn-primary">Physicians @ Location</div></a>
				<?php elseif ($parent == 'Travel Medicine'):?>	
					<a href="/physician/stanley-wasbin-md/" class=" buttons-xs col-7 col-sm-12 col-xl-7 px-0 pr-md-0  pb-3 ">
					<div class="w-100 btn btn-primary">Physicians @ Location</div></a>		
					<?php elseif ($parent == 'HIV Medicine'):?>	
					<a href="/physician/laura-salazar-md/" class=" buttons-xs col-7 col-sm-12 col-xl-7 px-0 pr-md-0  pb-3 ">
					<div class="w-100 btn btn-primary">Physicians @ Location</div></a>																												
				<?php endif; ?> 
				<?php if ($google_maps_url !=''):?>
				
					<a href="<?php print $google_maps_url;?>" class="buttons-xs col-5 col-sm-12 col-xl-5 px-0 pl-2 pl-sm-0 pl-xl-2" target="_blank">
					<div class="btn btn-outline-primary w-100">Get Directions</div></a>
					
					<?php endif; ?>
			</div>
		<?php endif;?>
		<!-- start urgent care buttons-->
		<?php

		if ($parent == 'Hoag Urgent Cares' && $img_only != true):  ?>
			
		 <div class="card-footer card-body row pt-5 pb-4 px-5 mx-0">
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
		</div>
					<?php endif;?>
<!--end buttons-->

<!--wait time-->
<?php	if ($wait_time_id !='' && $img_only != true):
				?>
					<div class="small alert alert-danger mt-0">
						<span class="bolder ml-1 pl-2" id='current-wait-<?php print $wait_time_id;?>'></span> ( 
						<span id='current_patients_<?php print $wait_time_id;?>'></span>  in line )
					</div>	
				<?php endif;?>

			<div class="container-fluid <?php if($img_only == 'true'){echo('d-none ');} if($count == 1 && $style != 'card' ){echo ('h-100 ');}?> m-0 p-1 p-md-0">
			<div class="card-body pl-4 ml-3"> 
				
				<?php if($address1 !='' && $img_only != true):?>
					<div class="card-text text-left">
					<?php if($links != 'disabled'):?>
					<a href="<?php print $google_maps_url; ?>" method="get" target="">
						<?php endif;?>
						<div class="row address <?php if($links == 'disabled'):?> text-secondary fill-secondary<?php endif;?>">
							<div class="col-1">
								<svg style="overflow:visible;" height="24"  width="24" xmlns="http://www.w3.org/2000/svg">
								<path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
								<path d="M0 0h24v24H0z" fill="none"/>
								</svg>
							</div>
							<div class="col-10">
								<?php if($address1 !=''){print $address1;}?> <br>
		<?php if($address2 !=''):?><?php print $address2;?> <br><?php endif;?>
								<?php if($city !=''){print $city;} ?>, <?php if($state !=''){print $state;} ?>  <?php if($zip !=''){print $zip;} ?>						
							</div>
						</div>
						<?php if($links != 'disabled'):?>
					</a>
						<?php endif; ?>				
					</div>
				<?php endif; ?>
						</div>
				
			<div class="">
			<ul class="list-group list-group-flush h-100 pl-2 ml-3">
					<?php if ($phone !=''):?>
						<li class="list-group-item">
							<div class="row phone <?php if($links == 'disabled'):?> text-secondary fill-secondary<?php endif;?>">
								<div class="col-1">
									<svg style="overflow:visible;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" enable-background="new0 0 24 24" xml:space="preserve">
									<path d="M20.599,15.762c-1.344,0-2.634-0.215-3.838-0.613c-0.375-0.117-0.795-0.031-1.096,0.259l-2.364,2.364
									c-3.042-1.548-5.536-4.03-7.083-7.072l2.364-2.375c0.301-0.29,0.387-0.709,0.269-1.086C8.453,6.035,8.238,4.745,8.238,3.401
									c0-0.591-0.484-1.075-1.075-1.075H3.401c-0.591,0-1.075,0.484-1.075,1.075c0,10.094,8.179,18.272,18.272,18.272
									c0.591,0,1.075-0.484,1.075-1.075v-3.762C21.674,16.246,21.189,15.762,20.599,15.762z"/>
									</svg>
								</div>							
								<div class="col-10 ">
									<?php if($links != 'disabled'):?>
									<a href="tel:<?php print $phone; ?>" id="loc-phone" class="loc-phone">
									<?php endif;?>
									<?php print $phone; ?>
									<?php if($links != 'disabled'):?>
									</a>
									<?php endif; ?>
								</div>
							</div>
						</li>
					<?php endif;

					if($img_only == true ) : ?>
						<!-- <li class="list-group-item tabs-controls-item">
						<?php $locaddress = strtolower(str_replace(' ','-',$office_name)); ?>
						<button id="<?php echo $address1; ?>" class="tablinks mb-5 w-100 btn btn-primary" onclick="openCity(event, <?php echo("'$locaddress'");?>)" >see [[specialty]] in [[city]]
						</button></li>
						<span class="lat-long" data="<?php echo($address1.', '.$long.', '.$lat) ?>"></span> -->




						
							
						<?php endif;
					
					 if ($fax !='' && $img_only !=true):?>
						<li class="list-group-item">
							<div class="row fax align-middle <?php if($links == 'disabled'):?> text-secondary fill-secondary<?php endif;?>">
								<div class="col-1">
									<svg style="overflow:visible;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="24px"  enable-background="" xml:space="preserve">
										<g><path d="M19,11.252h-1.75V5.44c0-0.552-0.447-1-1-1h-8.5c-0.552,0-1,0.448-1,1v5.812H5c-1.66,0-3,1.34-3,3v6h4h12h4v-6 C22,12.592,20.66,11.252,19,11.252z M8.812,5.898h6.374c0.276,0,0.5,0.224,0.5,0.5v4.854H8.312V6.398 C8.312,6.122,8.536,5.898,8.812,5.898z M16,19.016H8v-2.292h8V19.016z M19,15.252c-0.55,0-1-0.45-1-1s0.45-1,1-1s1,0.45,1,1 S19.55,15.252,19,15.252z"/>
										</g>
									</svg>
								</div>
								<div class="col-10 text-muted">
									<?php print $fax ?>
								</div>															
							</div>
						</li>
					<?php endif;?>
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
					<li class="list-group-item hours">
						<div  class="hours-op row mb-2 <?php if($links == 'disabled'):?> text-secondary fill-secondary<?php endif;?>">
							<div class="col-1">
								<svg style="overflow:visible;" fill="#000000" height="24"  width="24" xmlns="http://www.w3.org/2000/svg">
									<path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/>
									<path d="M0 0h24v24H0z" fill="none"/>
									<path d="M12.5 7H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
								</svg>
							</div>
							<div class="col-10">
							<div class="accordion text-left">
							
							<div class="">
                            <div href="#panel-collapse-<?php the_id();?>" class="panel-heading collapsed row mb-2 " data-toggle="collapse">

							
                                <p class="panel-title text-left col-10 pr-0"><strong>Today:</strong>

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
								</p>
                                <h4><div class="if-collapsed"><i class="fontello-icon icon-angle-down">&#xf107;</i></div><div class="if-not-collapsed"><i class="fontello-icon icon-angle-up">&#xf106;</i></div></h4>
                            </div>
							<?php $location_number = 1;?>
							<div class='panel-collapse  collapse pt-md-3 hours-of-op bg-light-grey' id="panel-collapse-<?php the_id();?>">
                                <div class="position-relative px-md-5 pb-4 panel-body text-muted">
								
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
								<?php 
								if (isset($saturday_open) && isset($sunday_open)):
									//if sat & sun hours are the same 
										if ( ($sun_hr_open === $sat_hr_open) && ($sun_hr_close === $sat_hr_close) ):?>
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
						</div>
					 </div>	
					 </div>
							 
							
							<div class="col-10 d-none">
								<!--old hours of operation-->
							</div>
							
						</div>
					</li>
				<?php endif; 
					//end of hours of opperation
				?>
				
			</ul>
			</div>
								</div>

			<?php if($notice  !='' && $img_only != "true"):?>
				<div class="small alert alert-secondary mb-0">
					<div class="ml-1 pl-2"><?php print $notice; ?></div>
				</div>
			<?php endif;?>	
			</div><!-- .card .m-1 -->
			
			<?php if ($multi_img == "true" || $img_only == "true"):?>
			<div class="row no-gutters">
			<?php endif;?>

			<?php if ($count == 1 && $style !== 'card'): //if not multiple locations ?>
				<div class="<?php  if($img_only != "true"){echo('col-sm-7 col-md-8 order-1 order-sm-2' );} else if ($multi_img == "true"){echo('col-12 col-md-8');} ?>  p-0" style=" <?php if($multi_img == 'true'){echo('height:500px !important;');}else if($img_only == 'true'){echo('height:350px;');}  else{echo('max-height:500px;');} ?>">
					<?php the_post_thumbnail('medium_large', ['class' => 'single-location-img flex-img ', 'alt'=>$local_title, 'title' => $local_title ]); ?>
					<div class="card-top-block p-2 bg-bottom-grad">
					<h2 id="<?php $display_name ?>" class="card-title w-100 pl-5 text-overlay-centered-bottom  text-white  text-left  lighter <?php if($img_only !="true"){echo('d-block d-sm-none font-ms');}else{echo('font-md');}?>"><?php if ($display_name == "") /* the fail safe ---->*/ {print $local_title;} else{print $display_name;}?></h2>
			</div>	
				</div> 



				

				<?php 
				if($count == 1 && $multi_img == true && isset($img2) && isset($img3) ):?>
				<div class="col-md-4 pr-0 pl-2 d-none d-md-block" style="max-height:500px;">
				<div  class="merch-img pb-1 overflow-hidden h-50">
					<img class="w-100" src="<?php echo($img2);?>"/>	
				</div>
				<div  class="merch-img pt-1 overflow-hidden h-50">
					<img class="w-100"src="<?php echo($img3);?>"/>	
				</div>
			</div> 
			<?php endif;?>
			<!--row-->
			<?php endif; ?>
		</div>
		<?php if ($multi_img == "true" || $img_only == "true"):?>
			</div>
			<?php endif;?>
		<!-- end displayed here -->
		<!-- ad logic -->
		<?php if($i===$count && $merch != 'false'):?>
		
			<?php if ($count >=2):?>

			<?php 
				$ad1 = '';
				$ad2 = '';
				if ($count ==2) {
					$ad1 = 'yes';
					$adclass = 'd-none d-md-block col-sm-4';
					$ad2 = 'no';
				}elseif ($count ==3){
					$ad1 = 'yes';
					$adclass = 'd-none d-sm-block d-md-none col-sm-6';
					$ad2 = 'no';
				}elseif ($count ==4){
					$ad1 = 'yes';
					$adclass = 'd-none d-md-block col-sm-4';
					$ad2 = 'no';
				}elseif ($count ==5){
					$ad1 = 'yes';
					$adclass = 'd-none d-md-block col-sm-4';
					$ad2 = 'no';
				}
			?>
			<?php if ($ad1 =='yes'):?> 
				<div class=" <?php print $adclass; ?> px-0 pb-2">
					<div class="specialty-block h-100">
						<span class=" h-100">
							<span class="thumb-container ie-height ie-width">
								<img class="opacity-5  h-100 flex-img featured-thumb" src="/wp-content/uploads/HMG-banners-expresscare.jpg"/>
								<div class="p-4 pl-5 h-100 position-absolute bottom-0">
									<span class="h3 font-md">Hoag Video Visit</span>
									<p class="w-75">Live video with a board-certified clinician from your mobile device or computer</p>
									<a href="https://virtual.hoag.org" class="btn btn-primary mt-4" >Sign up for Free</a>
								</div><!--end merch spot-->
							</span>
							</span>
					</div>
				</div>
			<?php endif;?>
				
			<?php endif;?>
		<?php endif;?>
		
		
    <?php
    	endwhile;
		wp_reset_postdata(); 
	?>
	</div>
</div>
	<script type='application/javascript'>
	function waitTimeMessage(rawWait){
		var numericWait = parseInt(rawWait);
		if (rawWait === 'Closed' || isNaN(numericWait) ) { return 'Currently closed.' };
		var waitRangeEnd = numericWait + 10;
		return 'Current Wait: ' + numericWait + ' - ' + waitRangeEnd + ' min';
	};
    var WAIT_FETCH_OBJECTS = [
  		{ 
			hospitalId: 1400,
    		timeType:   'hospitalPatientsInLine',
			selector:   '#current_patients_1400' 		
		},{ 
			hospitalId: 1400,
			timeType:   'hospitalWait',
            selector:   '#current-wait-1400',
    		formatFunction: waitTimeMessage  
		},{ 
			hospitalId: 1401,
    		timeType:   'hospitalPatientsInLine',
    		selector:   '#current_patients_1401'
		},{ 
			hospitalId: 1401,
			timeType:   'hospitalWait',
            selector:   '#current-wait-1401',
    		formatFunction: waitTimeMessage  
		},{ 
			hospitalId: 1402,
    		timeType:   'hospitalPatientsInLine',
    		selector:   '#current_patients_1402'
		},{ 
			hospitalId: 1402,
			timeType:   'hospitalWait',
            selector:   '#current-wait-1402',
    		formatFunction: waitTimeMessage  
		},{ 
			hospitalId: 1403,
  			timeType:   'hospitalPatientsInLine',
  			selector:   '#current_patients_1403'
		},{ 
			hospitalId: 1403,
			timeType:   'hospitalWait',
            selector:   '#current-wait-1403',
    		formatFunction: waitTimeMessage  
		},{ 
			hospitalId: 1404,
  			timeType:   'hospitalPatientsInLine',
  			selector:   '#current_patients_1404'
		},{ 
			hospitalId: 1404,
			timeType:   'hospitalWait',
            selector:   '#current-wait-1404',
    		formatFunction: waitTimeMessage  
		},{ 
			hospitalId: 1405,
    		timeType:   'hospitalPatientsInLine',
    		selector:   '#current_patients_1405'
		},{ 
			hospitalId: 1405,
			timeType:   'hospitalWait',
            selector:   '#current-wait-1405',
    		formatFunction: waitTimeMessage  
		},{ 
			hospitalId: 1406,
  			timeType:   'hospitalPatientsInLine',
  			selector:   '#current_patients_1406'
		},{ 
			hospitalId: 1406,
			timeType:   'hospitalWait',
            selector:   '#current-wait-1406',
    		formatFunction: waitTimeMessage 
		},{ 
			hospitalId: 2625,
  			timeType:   'hospitalPatientsInLine',
  			selector:   '#current_patients_2625'
		},{ 
			hospitalId: 2625,
			timeType:   'hospitalWait',
            selector:   '#current-wait-2625',
    		formatFunction: waitTimeMessage  
		},{ 
			hospitalId: 2626,
  			timeType:   'hospitalPatientsInLine',
  			selector:   '#current_patients_2626'
		},{ 
			hospitalId: 2626,
			timeType:   'hospitalWait',
            selector:   '#current-wait-2626',
    		formatFunction: waitTimeMessage  
		},{ 
			hospitalId: 2627,
  			timeType:   'hospitalPatientsInLine',
  			selector:   '#current_patients_2627'
		},{ 
			hospitalId: 2627,
			timeType:   'hospitalWait',
            selector:   '#current-wait-2627',
    		formatFunction: waitTimeMessage 
		},{ 
			hospitalId: 2628,
    		timeType:   'hospitalPatientsInLine',
    		selector:   '#current_patients_2628'
		},{ 
			hospitalId: 2628,
			timeType:   'hospitalWait',
            selector:   '#current-wait-2628',
    		formatFunction: waitTimeMessage  
	  	}
		// to add more, copy the braces and everything in it,
		// paste it above this comment, and change the numbers
		// to match the Clockwise MD number. Make sure there is a comma
		// after each internal brace like this {}, <-- like that
	];
	beginWaitTimeQuerying(WAIT_FETCH_OBJECTS);
	</script>
<?php
		return ob_get_clean();
	else :
  		esc_html_e( 'No locations found!', 'text-domain' );
	endif;

}
add_shortcode('locations', 'hoag_locations_shortcode');