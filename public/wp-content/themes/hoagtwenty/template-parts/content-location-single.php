<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package freshclicks2016
 */

 include('location-meta.php');
?>

<!-- <article class="post-summary large"> -->
<?php // print_r($original_atts);?>
<?php // print $original_atts['tax_term'];?>
    <div class="mx-auto row">
		<div class="col-12 col-md-5 col-lg-4 px-0 bg-light">
        <div class="px-0 ">
			<div class="img-16-90">
			<?php get_template_part( 'template-parts/featured-media' ); ?>
			<?php if(!empty($alert)):?>
			<div class="badge badge-pill badge-warning  position-absolute t-0  r-0 m-3"><?php print $alert; ?></div>
			<?php endif;?>
			</div>
			<?php if(!empty($notice)):?>
			<div class="bg-tertiary py-2 w-100 text-center small"><?php print $notice; ?></div>
			<?php endif;?>
		</div>
        <div class="col-12 bg-light p-0 ">
            <div class="d-block w-100 pt-4 ">	
			<?php echo $cardcol1[1];?>
			<?php echo $cardcol2[0];?>
        <div class="px-4">
		<h1 class="text-md d-block d-md-none"><?php if ($display_name == "") /* the fail safe ---->*/ {print $local_title;} else{print $display_name;}?></h1>
		<h3 class="text-ms d-none d-md-block">Location Details:</h3>
		</div>
		<div class="px-4 pb-3">
		<!-- Address --> 
		<?php if($address1 !=''):?>
			
			<a class="hover-offset-right d-block py-3" href="<?php print $google_maps_url; ?>" method="get" target="">
				<div class="icon-before directions-before">
				<?php if($address1 !=''){print $address1;}?>
				<?php if($address2 !=''){ print $address2;}?><br>
				<?php if($city !=''){print $city;} ?>, <?php if($state !=''){print $state;} ?>  <?php if($zip !=''){print $zip;} ?>
				</div>
			</a>
		<?php endif;?>
		<!-- END Address --> 
		<!-- phone -->
		<?php if ($phone !=''):?>
			<div class="border-top py-3 d-block ">
				<a href="tel:<?php print $phone; ?>" id="<?php echo $local_title; ?>" class="icon-before phone-before  hover-offset-right"><?php print $phone; ?></a>
			</div>
		<?php endif; ?>
		<!-- END phone -->
		<!-- fax -->
		<?php if ($fax !=''):?>
		
			<div id="loc-fax" class="border-top py-3 d-block loc-fax">
			<div class="icon-before fax-before">
				<?php print $fax; ?>
			</div>
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
<div class="border-top today-hours hover-offset-bottom show px-0 pt-3 mb-1 w-100 icon-before pointer  clock-before icon-after arrow-down-after">
			<b class="font-weight-bold">Today:&nbsp;</b>
			<p class=" mb-0 ">
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
					if (is_open == 1 ){ document.write(open);}else{append('closed');}	 			
				}else if (n == 'Monday'){			
					var is_open = "<?php echo $monday_open; ?>";
					var open = "<?php echo ($mon_hr_open." - ".$mon_hr_closed); ?>";
					if (is_open == 1 ){ document.write(open);} else{document.write('closed');} 
				}else if (n == 'Tuesday'){
					var is_open = "<?php echo $tuesday_open; ?>";
					var open = "<?php echo ($tues_hr_open." - ".$tues_hr_closed); ?>";
					if (is_open == 1 ){ document.write(open);} else{document.write('closed');}
				}else if (n == 'Wednesday'){
					var is_open = "<?php echo $wednesday_open; ?>";
					var open = "<?php echo ($wed_hr_open." - ".$wed_hr_closed); ?>";
					if (is_open == 1 ){ document.write(open);} else{document.write('closed');} 
				}else if (n == 'Thursday'){
					var is_open = "<?php echo $thursday_open; ?>";
					var open = "<?php echo ($thur_hr_open." - ".$thur_hr_closed); ?>";
					if (is_open == 1 ){ document.write(open);} else{document.write('closed');}
				}else if (n == 'Friday'){
					var is_open = "<?php echo $friday_open; ?>";
					var open = "<?php echo ($fri_hr_open." - ".$fri_hr_closed); ?>";
					if (is_open == 1 ){ document.write(open);} else{document.write('closed');}
				}else if (n == 'Saturday'){
					var is_open = "<?php echo $saturday_open; ?>";
					var open = "<?php echo ($sat_hr_open." - ".$sat_hr_closed); ?>";
					if (is_open == 1 ){ document.write(open);} else{document.write('closed');}	 
				}
			</script>
			</p></div>
            <div class=" all-hours hide p-4 position-absolute bg-white z-3 shadow rounded" style="margin-top:-50%;">
			<div  class="">
			<p class="small font-weight-bold ">Hours of Operation:</p>
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
            <?php if (!is_null($saturday_open) && !is_null($sunday_open)):
				//if sat & sun hours are the same 
				if ( ($sun_hr_open === $sat_hr_open) && ($sun_hr_closed === $sat_hr_closed) ):?>
					<span class="">Sat - Sun: <?php print $sun_hr_open; ?> - <?php print $sun_hr_closed; ?></span><br/>
				<?php else:?>
					<span class="">Sat: <?php print $sat_hr_open; ?> - <?php print $sat_hr_closed; ?></span><br/>
					<span class="">Sun: <?php print $sun_hr_open; ?> - <?php print $sun_hr_closed; ?></span><br/>

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
		<?php endif; // end hours of opperation ?>
		
    <!-- END hours of opperation -->
					
					</div>
					<?php echo $cardcol2[1];?>
		</div>
		</div>
		</div>
		<div class="col-12  col-md-7 col-lg-8 p-1  text-tertiary ">
			<div class="d-block w-100  mb-n3 ">
				<div class="container-lg p-4 ">
				<h1 class="d-none d-md-block"><?php if ($display_name == "") /* the fail safe ---->*/ {print $local_title;} else{print $display_name;}?></h1>
		<?php the_content();?>
		</div>
		</div>
		</div>
		
    </div>
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
 
