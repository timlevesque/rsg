<?php
/**
 * If a text only card.
 * Requires a supporting plugin.
 *
 * @package WordPress
 * @subpackage Hoag_Twenty
 * @since 1.0.0
 */
?>
<div class="col p-2 p-lg-3 fadein stagger bg-white" >
        <div class=" ">
           <?php the_post_thumbnail('', ['class' => '  h-100  img-fluid img-flex ie-article-img', 'alt'=>get_the_title(), 'title' => get_the_title() ]); ?>
            <div class="col align-self-center position-absolute text-center font-weight-bold text-white pt-4 pt-lg-5 mt-md-3 t-0 b-0 r-0 l-0 "><h3 class="text-ms"><?php the_title();?></h3>
            <a class="position-absolute t-0 r-0 l-0 b-0" href="<?php the_permalink();?>">
           
           </a> 
            <!-- <button class="mx-auto btn btn-outline-white  py-1 mt-4 d-flex">Read More</button> -->
        </div>
           

        </div>
        
</div>
