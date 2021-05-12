<?php
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
/* $wait_time_id = $hoag_local_fields['wait_time_id']; */
$google_maps_url = $hoag_local_fields['location_google_maps_id'];

//local type
$types = get_the_terms( '', 'location-type' );
if ( ! empty($types)){
	$type = $types[0]->slug;
}

// hours vars
$sunday_open = null;
$monday_open = null;
$teusday_open = null;
$wednesday_open = null;
$thursday_open = null;
$friday_open = null;
$saturday_open = null;

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
