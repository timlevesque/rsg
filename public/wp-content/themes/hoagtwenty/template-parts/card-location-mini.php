<?php
/**
 * "locations mini card" layout for Display Posts Shortcode
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
$address1 = $hoag_local_fields['address1'];
$address2 = $hoag_local_fields['address2'];
$city = $hoag_local_fields['city'];
$state = $hoag_local_fields['state'];
$zip = $hoag_local_fields['zip'];
$url = $hoag_local_fields['url'];
 if (! empty($url)){
    $link = $url;
}else{
    $link = get_the_permalink();
}
?>
<!-- <article class="post-summary large"> -->
<?php // print_r($original_atts);?>
<?php // print $original_atts['tax_term'];?>
<div class="col p-1">
    <div class="w-100 card rounded overflow-hidden h-100">
    
        <article id="post-<?php the_ID(); ?>" <?php post_class('excerpt hoag-articles'); ?> class="hoag-articles">
            <!-- <div class="card py-0 mb-0 mx-0 mx-sm-3 bg-light-grey"> -->
            <div class="card-top overflow-hidden">
                <a href="<?php echo $link;?>">
                        <div class="card-img-overlay overflow-hidden p-0">
                        </div>
                        <div class="img-16-90">
                        <?php the_post_thumbnail('medium', ['class' => 'card-img-top img-fluid img-flex ', 'alt'=>get_the_title(), 'title' => get_the_title() ]); ?>
                        </div>
                    </a>
            </div>
            <div class="card-body text-center">
                <div class="card-title">
                    <h5 class="font-ms initial-weight"><a href="<?php echo $link;?>" rel="bookmark"><?php print get_the_title();?></a></h5>
                </div>
                <!-- Address --> 
                <?php if(! empty($address1)):?>
                    <div class="pl-1">
                        <?php if(! empty($address1)){print $address1.'<br>';}?>
                        <?php if(! empty($address2)){ print $address2.'<br>';}?> 
                        <?php if(! empty($city)){print $city;} ?>, <?php if(! empty($state)){print $state;} ?>  <?php if(! empty($zip)){print $zip;} ?>

                    </div>
                <?php endif;?>
            </div><!-- card-body -->
    </article>
</div><!-- card --->
</div>