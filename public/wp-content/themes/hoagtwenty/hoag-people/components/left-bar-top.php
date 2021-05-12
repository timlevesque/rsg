<?php 
use HoagPeople\TemplateTags as Tags;
include('meta.php');
?>
<div class="person-single-img-bg text-center py-4 align-self-center col-12  px-xl-5">
<?php if ( has_post_thumbnail( $post->ID ) ) :
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); 
        ?>
        <img src="
            <?php echo $image[0]; ?>
            " class="physician-single-photo   shadow m-0 mx-xl-3 mx-sm-auto img-flex"/>
        <?php endif; ?>
        </div>
            <div class=" mx-auto  text-center col-10  col-lg-8 col-xl-10 text-left">
            <h1 class="h2 text-secondary "><?php the_title(); ?></h1>
        
        <?php if($distinct_title != null):?>
                <p class=" text-primary"><?php echo $distinct_title; ?></p>
            <?php endif; ?>

            <?php if($endowed_chair != null):?>
                <h5 class="mt-4">Focus Areas</h5>
                <p class="font-reading font-normal"><?php echo $endowed_chair; ?></p>
            <?php endif; ?>

            <?php if($public_specialty != null):?>
            <h5 class="mt-4">What I love About Work</h5>
                <p class="font-reading font-normal"><?php echo $public_specialty; ?></p>
            <?php endif;?>

            </div>