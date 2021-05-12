<?php
/**
* Template Name: Classes
*
* @package WordPress
* @subpackage hoag_twenty
*/

get_header(); ?>

<?php
	$search_cat = $_GET['category'];
	$search_type = $_GET['type'];
	
	$cat_terms = get_terms('event-categories');
	$cat_names = wp_list_pluck( $cat_terms, 'name' );
	$term = $cat_names;
	$cat_filter = 'All Categories';
	$type_filter = 'All Types';
	

	if($search_cat != ''){
		$term = $search_cat;
		$cat_filter = $search_cat;
	}
	if($search_type != ''){
		/* $term = $search_type; */
		$type_filter = $search_type;
	}


	$args = array(  
        'post_type' => 'event',
        'post_status' => 'publish',
		'posts_per_page' => -1, 
		'order' => 'DESC',
		 'tax_query' => array(
			array(
				'taxonomy' => 'event-categories',
				'field'    => 'name',
				'terms'    => $term
			)
		 )
	);
	
	
		// The Query
		$the_query = new WP_Query( $args );
		
		// The Loop
		if ( $the_query->have_posts() ) {
			
			$titles = [];
			$ids = [];
			$day_starts = [];
			$day_ends = [];
			$time_ends = [];
			$time_starts = [];
			$ods = [];
			$vids =[];
			$imgs = [];
			$links = [];
			$lss = [];
			$cats = [];

			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$title= get_the_title();
				$id= get_the_ID();
				$vid = 0;
				$od = 0;
				$ls = 0;
				$img = get_the_post_thumbnail_url();
				$link = get_the_permalink();
				$cat = get_the_terms($id, 'event-categories');
				

				$post_options = get_post_meta( get_the_ID(), 'post_options')[0];

				if(isset($post_options['on_demand'])){ $od = 1;}
				if(!isset($post_options['on_demand']) && $post_options['featured_video'] !== ''){ $ls = 1;}
				if($post_options['featured_video'] !== ''){ $vid = 1;}

				$startDate = /* str_replace('-', '',  */get_post_meta( get_the_ID(), '_event_start_date')[0];
				$startTime = /* str_replace(':', '',  */get_post_meta( get_the_ID(), '_event_start_time')[0];
				$endDate =  str_replace('-', '',  get_post_meta( get_the_ID(), '_event_end_date')[0]);
				$endTime = str_replace(':', '',  get_post_meta( get_the_ID(), '_event_end_time')[0]);
				$today =  str_replace('/', '',  date("Y/m/d/h/i/s"));

				if($today <= $endDate.$endTime || $od == 1 ){
				array_push ($titles,$title);
				array_push ($ids, $id);
				array_push ($day_starts, $startDate);
				array_push ($day_ends, $endDate);
				array_push ($time_starts, $startTime);
				array_push ($time_ends, $endTime); 
				array_push ($ods, $od); 
				array_push ($vids, $vid);
				array_push ($lss, $ls); 
				array_push ($imgs, $img);
				array_push ($links, $link); 
				array_push ($cats, $cat[0]->name); 
			} 
		}
		} 

		wp_reset_postdata();

		$unique = array_unique($titles);
if($unique){
		foreach($unique as $name){
			$data[] = array_merge(['title' => $name ], array(
				'ID' => array_merge(array_intersect_key($ids, array_intersect($titles, [$name]))),
				'vid' => array_merge(array_intersect_key($vids, array_intersect($titles, [$name]))),
				'od' => array_merge(array_intersect_key($ods, array_intersect($titles, [$name]))),
				'start_day' => array_merge(array_intersect_key($day_starts, array_intersect($titles, [$name]))),
				'end_day' => array_merge(array_intersect_key($day_starts, array_intersect($titles, [$name]))),
				'start_time' => array_merge(array_intersect_key($time_starts, array_intersect($titles, [$name]))),
				'end_time' => array_merge(array_intersect_key($time_ends, array_intersect($titles, [$name]))),
				'link' => array_merge(array_intersect_key($links, array_intersect($titles, [$name]))),
				'media' => array_merge(array_intersect_key($imgs, array_intersect($titles, [$name]))),
				'ls' => array_merge(array_intersect_key($lss, array_intersect($titles, [$name]))),
				'cat' => array_merge(array_intersect_key($cats, array_intersect($titles, [$name])))
			));
		} 
	}
?>

<div id="content" class="mx-auto row m-auto"> 
    <div id="primary" class="container-lg  mt-5 bg-white  px-0 ">
	<div class="row px-3 py-4 py-lg-2 mb-3">
	<div class="col-10 col-md-7 col-xl-8 px-0">
	<h1 class="mb-0"><?php the_title();?></h1>
	</div>
	<button class="ml-auto p-0 align-self-center btn d-block text-right filter pointer d-md-none overflow-hidden" style="height: 40px;">
			<svg width="60" height="70" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
			<rect class="fltr-line1" x="7" y="8" width="30" height="1" fill="rgb(71, 145, 206)"></rect>
			<rect class="fltr-line2" x="7" y="20" width="30" height="1" fill="rgb(71, 145, 206)"></rect>
			<circle class="fltr-crcl1" cx="16" cy="20.5" r="3" fill="white" stroke="rgb(71, 145, 206)"></circle>
			<circle class="fltr-crcl2" cx="28" cy="8.5" r="3" fill="white" stroke="rgb(71, 145, 206)"></circle>
			</svg>
	</button>
	<div class="row col-12 px-0 col-md-5 col-xl-4 rounded text-left text-md-right  m-0 mt-auto hide-sm border border-secondary">
		<div class="d-flex w-100">
			<select id="cats" class="col p-0 border-top-0 border-bottom-0 border-right-0 border-secondary border-left-0 bg-transparent text-secondary px-4 py-1   ">
				<option selected >All Categories</option>
				<?php 
				foreach($cat_names as $cat):?>
					<option <?php 
						if($search_cat == $cat ){
							echo('selected');
						}
					?> type="<?php echo $cat;?>"><?php echo $cat; ?></option>
				<?php endforeach;?>
			</select>

			<select id="type" class="col p-0 border-top-0 border-bottom-0 border-right-0 border-secondary border-left bg-transparent text-secondary px-4 py-1">
				<option selected> All Types</option>
				<option <?php if($search_type == 'On Demand' ){echo('selected');} ?> type="On Demand">On Demand</option>
				<option <?php if($search_type == 'Live Streams' ){echo('selected');} ?> type="Live Streams">Live Streams</option>
				<option <?php if($search_type == 'Health Fair' ){echo('selected');} ?> type="Health Fair">Health Fair</option>	
			</select>
		</div>
	</div>
</div>


        <?php // get_template_part( 'template-parts/breadcrumbs' ); ?>

<div class="row row-cols-2 row-cols-lg-3 px-2 px-md-1 px-lg-0">
<?php
		$desc= '';
if($data){
		foreach($data as $class):
			$cat = $class['cat'][0];

			if (!in_array(1, $class['vid']) ){
				$desc= 'Health Fair';
			}
			if (in_array(1, $class['ls']) && in_array(1, $class['vid']) && !in_array(1, $class['od'])){
				$desc= 'Live Streams';
			}
			if (in_array(1, $class['od']) && in_array(1, $class['vid']) && !in_array(1, $class['ls'])){
				$desc= 'On Demand';
			}
			if (in_array(1, $class['ls']) && in_array(1, $class['od']) && in_array(1, $class['vid']) ){
				$desc= 'Live Streams & On Demand';
			}
			$ondemand = '';
			if(in_array(1, $class['od'])){
				$ondemand = 1;
			}
			?>
			
		<div data-type="<?php echo $desc;?>"  end="<?php echo end($class['end_day']);?>" class="col p-1 p-lg-2 class-block">

			<div class="card p-0 text-center  h-100 position relative">
				<div class="img-16-90 overflow-hidden">
					<img class="img-fluid img-flex h-100" src="<?php echo end($class['media']);?>">
				</div>

				<div class="badge badge-primary position-absolute t-0 l-0 m-1 m-sm-2 m-md-3 shadow">
						<?php echo($cat);?>
					</div>
				<div class="p-lg-4 p-3">
					<h5><?php echo $class['title'];?></h5>
					<p class="small text-primary pb-5 "><?php echo strtoupper($desc);?></p>
					<a  class="position-absolute b-0 l-0 r-0 my-5 font-weight-bold" href="<?php echo end($class['link']);?>">Sign Up&nbsp;&rarr;</a>
				</div>
			</div>
		</div>
		<?php endforeach;

}
		?>



		</div>
	</div><!-- #primary -->	
</div><!-- #content -->
<?php get_footer('footerless'); ?>
<script>
    $(function(){
		var separator = (window.location.href.indexOf("?")===-1)?"?":"&";
		var url_string = window.location; //window.location.href
		var url = new URL(url_string);
		var type = url.searchParams.get("type");
		var search_params = url.searchParams;

      // bind change event to select
      $('#cats').on('change', function () {
		  var param = $(this).find(':selected').attr("type"); // get selected value
          if (param) { // require a URL
			search_params.set('category', param);
			url.search = search_params.toString();
			var new_url = url.toString();
			window.location = new_url;
          }else{
			search_params.delete('category');
			url.search = search_params.toString();
			var new_url = url.toString();
			window.location = new_url;
		  }
          return false;
	  });
	  
	  // bind change event to select
      $('#type').on('change', function () {
		  var param = $(this).find(':selected').attr("type"); // get selected value
		  if (param) { 
			search_params.set('type', param);
			url.search = search_params.toString();
			var new_url = url.toString();
			window.location = new_url;
          }else{
			search_params.delete('type');
			url.search = search_params.toString();
			var new_url = url.toString();
			window.location = new_url;
		  }
          return false;
	  });
	  

	  var classes = document.getElementsByClassName('class-block');
	  var i;
		for (i = 0; i < classes.length; i++) {
		var classtype = classes[i].getAttribute("data-type"); 
		if(type && classtype != type ){
			classes[i].className += ' d-none ';
		}

		}
	  
    });
</script>
</body>
</html>