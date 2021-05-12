<?php
$options = get_post_meta( get_the_ID(), 'post_options', true);
$distinct_title = null;
$endowed_chair = null;
$public_specialty = null;
$exec_img = null;

if(isset($options['distinct_title'])){
	$distinct_title = $options['distinct_title'];
}
if(isset($options['endowed_chair'])){
	$endowed_chair = $options['endowed_chair'];
}
if(isset($options['public_specialty'])){
	$public_specialty = $options['public_specialty'];
}
if(isset($options['people-hero-img'])){
	$exec_img = $options['people-hero-img'];
}