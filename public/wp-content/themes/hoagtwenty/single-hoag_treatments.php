<?php 
use HoagPeople\TemplateTags as Tags;
get_header();
DEFINE("ROOT_PATH", dirname( __FILE__ ) ."/" );
include( ROOT_PATH . 'hoag-people/components/meta.php');

$contentClass = 'col-12 col-md-7 col-lg-7 col-xl-6';
$xlCol = 'col-xl-3';
$iframe = '';
$mapCol = 'col-12 col-xl-3';



?>
<div class="container-fluid p-0 m-0">
    <div class="row m-0 ">
    <div class="col-12 bg-light col-sm-6 col-lg-5 col-xl-4 col-xxl-3  p-0 text-center text-xl-left">
            <div class="rounded-bottom  w-100 overflow-hidden">
                    <?php include( ROOT_PATH . 'hoag-people/components/left-bar-top.php'); ?>
            </div>
                    <?php include( ROOT_PATH . 'hoag-people/components/left-bar-max.php'); ?>
        </div>
</div>


        <div class=" col col-lg-7 px-5 pb-5 font-reading people-content">
            <!--the content-->
    
<?php

if ( have_posts() ) : 
    while ( have_posts() ) : the_post(); ?>
        <?php
        the_content();
    endwhile; 
endif; 
?>

      
        <!--end the content-->
        
   
    
    </div>
</div>
<?php get_footer(); ?>