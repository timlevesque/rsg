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


  <?php 
  global $count;

  $text_align = 'text-center';
  $padding= 'p-1';
  $border = 'rounded ';

    if ( $count == 1 ) {
        $textSize = 'h1';
        $padding= 'p-0';
        $border = 'rounded-0 border-0';
    }elseif ( $count == 2 ) {
        $textSize = 'h2';
    }else{
        $textSize = 'h4';

    } 
?>
<div class="col p-2 p-md-3 p-lg-4 fadein stagger bg-alternate circle hover-shadow" >
   
        <div class=" img-square circle">
           <?php the_post_thumbnail('medium-large', ['class' => ' circle h-100 bg-grey-50 card-img-top img-fluid img-flex ie-article-img', 'alt'=>get_the_title(), 'title' => get_the_title() ]); ?>
           <div class="position-absolute t-0 r-0 l-0 b-0 card text-white circle font-weight-bold text-center"></div>
            <div class="col align-self-center position-absolute text-center font-weight-bold text-white t-50 b-0 r-0 l-0 "><h3 class="text-ms"><?php the_title();?></h3>
            <a class="position-absolute t-0 r-0 l-0 b-0" href="<?php the_permalink();?>">
           
           </a> 
            <!-- <button class="mx-auto btn btn-outline-white  py-1 mt-4 d-flex">Read More</button> -->
        </div>
           

        </div>
        
</div>
