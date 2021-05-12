<?php
/**
 * If a feaetured video is set, display it in the hero location. Otherwise display a featured image.
 * If there is no video or image, don't display anything.
 * Requires a supporting plugin.
 *
 * @package WordPress
 * @subpackage Hoag_Twenty
 * @since 1.0.0
 */
   require get_template_directory() . '/inc/video-logic.php';
//$the_tags = get_the_tags( );// print_r($the_tags);

//where it falls in the list
global $postCount;

//how many there are
global $count;


$title_header = ' h2';
$img_height = 'm-h350 m-h200-sm';
$copyClass = '';
$card_col_inner1 ='d-none';
$card_col_inner2 ='col-12 align-self-center m-0 p-3 pl-0 p-md-4 position-relative';
$orderimg = '';
$orderCopy = '';
$container = 'container-sm ml-0';
$bg = 'bg-transparent';
$text_color = 'text-tertiary';

/* if ( is_singular( array( 'hoag_treatments', 'hoag_clinical_trials', 'hoag_procedures', 'post' ) ) ) {
    $container = 'container-sm';
} */


if(is_odd($postCount) && has_post_thumbnail()){
 
    $orderimg = 'order-1 order-md-2';
    $orderCopy = 'order-2 order-md-1';
    $card_col_inner1 ='col-12 col-md-6 m-h350 m-h200-sm p-0 m-0 ';
    $card_col_inner2 ='col-12 col-md-6 align-self-center m-0 p-3 pl-0 p-md-4 position-relative';
    $container = 'container-lg ';

}elseif(!is_odd($postCount) && has_post_thumbnail()){
   

    $orderimg = 'order-1';
    $orderCopy = 'order-2';
    $card_col_inner1 ='col-12 col-md-6 m-h350 m-h200-sm overflow-hidden rounded shadow  p-0 m-0';
    $card_col_inner2 ='col-12 col-md-6 align-self-center m-0 p-3 pl-0 p-md-4 position-relative';
    $container = 'container-lg ';
}elseif(!is_odd($postCount) && $vid !=''){

    $card_col_inner1 ='col-12 col-md-6 m-h350 m-h200-sm overflow-hidden rounded shadow  p-0 m-0';
    $orderimg = 'order-1';
    $orderCopy = 'order-2';
    $card_col_inner2 ='col-12 align-self-center  m-0 p-4 pl-md-0 pr-4 py-md-4 position-relative';
    $container = 'container-lg ';
}elseif($vid !=''){
    $card_col_inner1 ='col-12 col-md-6 m-h350 m-h200-sm p-0 m-0 ';
    $orderimg = 'order-1 order-md-2';
    $orderCopy = 'order-2 order-md-1';
    $card_col_inner2 ='col-12 col-md-6 align-self-center m-0 p-4 pl-md-0 pr-4 py-md-4 position-relative';
    $container = 'container-lg';
}
?>

<div class="<?php echo $bg;?>  container-lg position-relative w-100 pt-0 py-sm-5 border-bottom border-tertiary no-border-last ">
<div class="p-1 d-flex <?php echo $container;?>">
    <div class=" d-flex  w-100 position-relative">

        <article id="post-<?php the_ID(); ?>"  class=" row m-0 d-flex hoag-articles h-100">
            <!-- <div class="card py-0 mb-0 mx-0 mx-sm-3 bg-light-grey"> -->
                <div class="row m-0 p-0">
            <div class="<?php echo $card_col_inner1; ?>  <?php echo $orderimg;?> bg-grey card-top bg-light rounded shadow ">
                <?php if ($vid !='') :?>
                    <a class="w-100" type="button" class="" data-toggle="modal" data-target="#video-modal-<?php the_ID(); ?>">
                        <?php echo('<img src='.$vid_img.' class="bg-light  card-img-top  rounded shadow  m-h350 m-h200-sm img-flex ">'); ?>
                        <div class="t-50 card-img-overlay  container rounded-0 p-0">
                            <img class="mx-auto d-block" src='<?php echo $plybtn; ?>'/>
                        </div>
                    </a>
                <?php else :?>
                        <div class="card-img-overlay  p-0">
                        </div>
                        <?php the_post_thumbnail('large', ['class' => 'bg-light rounded shadow card-img-top img-fluid img-flex '.$img_height.'', 'alt'=>get_the_title(), 'title' => get_the_title() ]); ?>
                    
                <?php endif; ?>
            </div>
            <div class="card-body p-0 <?php echo $card_col_inner2;?> <?php echo $orderCopy;?> ">
               
                <?php 
                //switch cats for publications
                /*
                    $categories = get_the_category();
                    if ( ! empty( $categories ) ) {
                        echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '" class="small excerpt-category text-muted">' . esc_html( $categories[0]->name ) . '</a>';
                    }
                */
                ?>
                <div class="card-title <?php echo $text_color;?> text-left font-ms initial-weight <?php echo $copyClass;?>"><h3 class="<?php print $title_header;?>" ><a href="<?php the_permalink();?>" rel="bookmark" class="<?php echo $text_color;?>"><?php echo mb_strimwidth(get_the_title(), 0, 70, '...'); ?></a></h3>
                
                    <?php 
                    if(has_excerpt()){
                        the_excerpt();?>
                        <a href="<?php the_permalink();?>">
                        <?php
                        if( get_post()->post_content == '' && $vid != ''):?>
                            Watch&nbsp;Now&nbsp;&rarr;
                        <?php else:?>
                            Read&nbsp;More&nbsp;&rarr;
                        <?php endif;?>
                        </a>
                        <?php
                    }else{
                        the_excerpt();
                    }

                    if( get_post()->post_content == '' && $vid != ''):?>
                        <p class="font-weight-bold text-muted text-sm mb-0 p-4 text-right">video</p>
                    <?php else:?>
                        <p class="font-weight-bold text-muted text-sm mb-0 p-4 text-right"><?php read_time(); ?> min read</p>
                    <?php endif;?>
                </div>
            </div><!-- card-body -->
        </article>
    </div><!-- card --->
    <!-- Modal -->
<div class="modal fade" id="video-modal-<?php the_ID(); ?>" tabindex="-1" role="dialog" aria-labelledby="#video-modal-<?php the_ID(); ?>Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo get_the_title();?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">  
                <?php if(isset($vid_embed)) :?> 
                    <div class="video-container">  
                        <iframe class="youtube-vid" width="560" height="315" src='<?php echo $vid_embed;?>' frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                    </div>
                <?php else: ?>
                    <p> something went wrong.</p>
                <?php endif;?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>
</div>

