<?php
/**
 * Template part for displaying classes.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package freshclicks2016
 */
global $EM_Event, $EM_Events;
$id= get_the_ID();
$cat = get_the_terms($id, 'event-categories');
?>
<div class=" container-sm row h-100 mb-3 m-auto   position-relative overflow-hidden p-0 ">
<header class=" p-1 w-100 single-post-top-block entry-header container-sm ">

<?php
the_title('<h1 class="pt-3 text-ml">','</h1>');
?>
</header>
<div class="col-12 p-0 position-relative mb-4 ">
<?php get_template_part( 'template-parts/featured-media' ); ?>
<div class="badge badge-primary position-absolute t-0 l-0 m-3 shadow">
						<?php print_r($cat[0]->name);?>
					</div>

</div>
<p class="px-3">
<?php print $EM_Event->post_content; ?>
</p>
</div>
<?php
$format_classes = '<div class="text-sm-sm px-2 container-sm row py-4 px-0 border-bottom">';
$format_classes .= '<div class="text-sm-sm col-5 p-0 align-self-center date">#_{l\, F j\, Y }</div>';
$format_classes .= '<div class="text-sm-sm col-3 p-0 align-self-center font-weight-bold  text-center date">#_{h:i A}</div>';
$format_classes .= '<div class="text-sm-sm p-0 col-4 text-center align-self-center">';

if (is_user_logged_in()){
	$format_classes .= '#_BOOKINGBUTTON';
}else{
    $format_classes .= '<button type="button" class="btn d-inline text-center text-sm-sm btn-primary btn-block" data-toggle="modal" data-target="#loginModal">Login</button>';
}
$format_classes .= '</div></div>';
if (class_exists('EM_Events')) {
	
    print EM_Events( array('search' => $EM_Event->event_name,'limit'=>10,'orderby'=>'event_start_date', 'order'=>'ASC','format'=>$format_classes) );
}






$args = array(  
	'post_type' => 'event',
	'post_status' => 'publish',
	'order' => 'DESC',
);


// The Query
$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) {
		$thisname = strtolower(get_the_title());
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		
		$today =  str_replace('/', '',  date("Y/m/d/h/i/s"));
		$name = get_the_title();
		$n = strtolower(get_the_title());
		$endTime = str_replace(':', '',  get_post_meta( get_the_ID(), '_event_end_time')[0]);
		$od = 'false';
		$post_options = get_post_meta( get_the_ID(), 'post_options')[0];
		if(isset($post_options['on_demand'])){ $od = 'true';}
		 if($n == $thisname && $od == 'true' && $today > $endTime):
		$ev_date = strtotime(get_post_meta( get_the_ID(), '_event_end_time')[0]);
		$ev_date_word = date('l, F jS, Y', $ev_date);?>
		<div class="row m-0 p-0 container-sm mx-auto py-4">
			<div class="text-sm-sm col-5 ">
				<?php echo $ev_date_word;?>
			</div>
			<div class="text-sm-sm text-primary text-center col-3 p-0">On Demand</div>
			<div class="col-4 text-sm-sm text-center p-0">
			<a  class=" p-3 font-weight-bold" href="<?php echo the_permalink();?>">Watch Now&nbsp;&rarr;</a>
			</div>
		</div>
		 <?php endif;

	}
}
wp_reset_postdata();


?>