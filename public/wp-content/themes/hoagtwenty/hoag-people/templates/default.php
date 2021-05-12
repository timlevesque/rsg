<?php
use HoagPeople\TemplateTags as Tags;
get_header();
DEFINE("ROOT_PATH", dirname( __FILE__ ) ."/" );
include( ROOT_PATH . '../components/meta.php');

$contentClass = 'col-12 col-md-7 col-lg-7 col-xl-6';
$xlCol = 'col-xl-3';
$iframe = '';
$mapCol = 'col-12 col-xl-3';


if(empty(get_the_content()) && Tags\has_video()){
    $contentClass = 'col-12 col-md-7 col-lg-8 col-xl-6';
    $xlCol = 'col-lg-4 col-xl-3';
    $iframe = '';
    $mapCol = 'col-12 col-xl-3';
}elseif(empty(get_the_content())){
    $contentClass = 'd-none';
    $xlCol = 'col-md-6 col-lg-4';
    $iframe = 'iframe-w-100';
    $mapCol = 'col-12 col-md-6 col-lg-4';
}
?>
<div class="container-fluid p-0 m-0">
    <div class="row m-0 ">
    <div class="col-12 bg-light col-md-5 col-lg-5 col-xl-3  p-0 text-center">
            <div class="rounded-bottom  w-100 overflow-hidden">
                    <?php include( ROOT_PATH . '../components/left-bar-top.php'); ?>
            </div>
                    <?php include( ROOT_PATH . '../components/left-bar-max.php'); ?>
        </div>
</div>


        <div class=" <?php echo  $contentClass; ?>">
            <!--the content-->
            <?php if ( !empty($post->post_content ) || Tags\has_video() ) :  ?>
				<?php Tags\the_video(); ?>
        <?php endif; ?>
        <?php if(!empty(get_the_content())):?>
        <h3 class="h4 pt-4">About <?php the_title(); ?></h3>
        <?php endif; ?>
        <?php the_content();?>
        </div>
      
        <!--end the content-->
        
   
    
    </div>
</div>