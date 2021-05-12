<?php
/**
* Template Name: Publications
*
* @package WordPress
* @subpackage hoag_twenty
*/
get_header(); ?>

<!-- hoag for life -->
<div class="container-lg px-0">
<h1 class="my-4 px-4 px-lg-0  mx-2">Publications</h1>
	<h2 class="mt-4 px-4 px-lg-0 mb-2 mx-2 text-tertiary text-md">Hoag For Life</h2>
	<div class="card-carousel-wrapper  px-0">
	<?php 
	$terms = get_terms([
	'taxonomy' => 'publications',
	'hide_empty' => false,
	'meta_key' => 'publication-date',
	'orderby'  => 'meta_value', 
	'meta_type'      => 'DATE',
	'order'      => 'DESC',
	]);	

	$i = 0;
	foreach($terms as $term){
		$pubName = $term->name;
		$pubDesc = $term->description;
		$pubUrl = $term->slug;
		$pubId = $term->term_taxonomy_id;
		$pubImage = get_term_meta( $pubId, 'category-image-id', true);
		//template

		$pos = strpos($pubName, 'Hoag for Life');
		if ($pos !== false && $term->count !== 0):?>

		<div class="col p-1">
			<div class="card border-0 bg-light h-100 rounded overflow-hidden w-100 position-relative">
				<?php
			if ($i == 0):?><div class="d-inline-flex position-absolute t-0 l-0 m-2 z-1">
				<span class="badge badge-primary d-block px-2 text-white shadow">New Issue</span>
			</div>
				
			<?php endif;?>
				<article id="<?php the_ID(); ?>" class="hoag-articles h-100">
					<div class=" img-16-90 card-top overflow-hidden position-relative">
					
					<?php
					if(wp_attachment_is_image($pubImage)):
						echo wp_get_attachment_image($pubImage, 'large', "", array( "class" => " img-fluid img-flex ie-flexfix h-100" ) );  

					else:?>
						<img class="h-100 img-fluid img-flex ie-flexfix " src="<?php randomImg();?>"/>
					<?php endif;
					?>
					<a class="position-absolute t-0 b-0 r-0 l-0" href="<?php echo $pubUrl;?>" >
					</a>
					</div>
					<div class="p-4 my-2 m-0 text-tertiary h-100">
					<div class="w-100">
						<h5><?php echo $pubName; ?></h5>
						<p><?php echo $pubDesc;?></p>
						<a href="<?php echo $pubUrl;?>">view articles &rarr;</a>
						</div>
					</div>
					</div>
				</article>
			</div>

		<?php
		//template end
		$i++;

					endif;
	}
	?>
	</div>




<div class="container-lg row mb-5 px-2">
<!-- heart of hoag -->
<div class="col-12 col-sm  align-self-end">
	<h2 class="mt-5 px-lg-0 mx-2 text-tertiary mb-2 text-md">Heart of Hoag</h2>
	<?php 
	$terms = get_terms([
	'taxonomy' => 'publications',
	'hide_empty' => false,
	'meta_key' => 'publication-date',
	'orderby'  => 'meta_value', 
	'meta_type'      => 'DATE',
	'order'      => 'DESC',
	]);	

	$i = 0;
	foreach($terms as $term){
		$pubName = $term->name;
		$pubDesc = $term->description;
		$pubUrl = $term->slug;
		$pubId = $term->term_taxonomy_id;
		$pubImage = get_term_meta( $pubId, 'category-image-id', true);
		//template

		$pos = strpos($pubName, 'Heart of Hoag');
		if ($pos !== false):?>
		<div class="col p-1">
			<div class="card border-0 bg-light h-100 rounded overflow-hidden w-100 position-relative">

				<article id="<?php the_ID(); ?>" class="hoag-articles h-100">
					<div class="card-top img-16-90 overflow-hidden position-relative">
					
					<?php
					if(wp_attachment_is_image($pubImage)):
						echo wp_get_attachment_image($pubImage, 'large', "", array( "class" => " img-fluid img-flex ie-flexfix h-100" ) );  

					else:?>
						<img class="h-100 img-fluid img-flex ie-flexfix " src="<?php randomImg();?>"/>
					<?php endif;?>
					<a class="position-absolute t-0 r-0 l-0 b-0" href="<?php echo $pubUrl;?>" >
					</a>
					</div>
					<div class="p-4 my-2 m-0 text-tertiary h-100">
					<div class="w-100">
						<h5><?php echo $pubName; ?></h5>
						<p><?php echo $pubDesc;?></p>
						<a href="<?php echo $pubUrl;?>">view articles &rarr;</a>
						</div>
					</div>
					</div>
				</article>
			</div>
		<?php
		//template end
		$i++;
		endif;
	}?>
</div>

<!-- hoag in your community -->
<div class="col-12 col-sm align-self-end ">
	<h2 class="mt-5 px-lg-0 mx-2 text-tertiary text-md mb-2">Hoag in Your Community</h2>
	<?php 
	$terms = get_terms([
	'taxonomy' => 'publications',
	'hide_empty' => false,
	'meta_key' => 'publication-date',
	'orderby'  => 'meta_value', 
	'meta_type'      => 'DATE',
	'order'      => 'DESC',
	]);	

	$i = 0;
	foreach($terms as $term){
		$pubName = $term->name;
		$pubDesc = $term->description;
		$pubUrl = $term->slug;
		$pubId = $term->term_taxonomy_id;
		$pubImage = get_term_meta( $pubId, 'category-image-id', true);
		//template

		$pos = strpos($pubName, 'Community');

		if ($pos !== false):?>
		<div class="col p-1">
			<div class="card border-0 bg-light h-100 rounded overflow-hidden w-100 position-relative">
				<article id="<?php the_ID(); ?>" class="hoag-articles h-100">
					<div class="card-top img-16-90 overflow-hidden position-relative">
					<?php
					if(wp_attachment_is_image($pubImage)):
						echo wp_get_attachment_image($pubImage, 'large', "", array( "class" => " img-fluid img-flex ie-flexfix h-100" ) );  

					else:?>
						<img class="h-100 img-fluid img-flex ie-flexfix " src="<?php randomImg();?>"/>
					<?php endif;?>
					<a class="position-absolute t-0 r-0 l-0 b-0" href="<?php echo $pubUrl;?>" >
					</a>
					</div>
					<div class="p-4 my-2 m-0 text-tertiary h-100">
					<div class="w-100">
						<h5><?php echo $pubName; ?></h5>
						<p><?php echo $pubDesc;?></p>
						<a href="<?php echo $pubUrl;?>">view articles &rarr;</a>
						</div>
					</div>
					</div>
				</article>
			</div>
		<?php
		//template end
		$i++;
		endif;
	}?>
</div>
</div>

<?php get_footer(); ?>
</body>
</html>