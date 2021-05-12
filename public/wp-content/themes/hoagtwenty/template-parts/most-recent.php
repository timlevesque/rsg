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

$orderimg = '';
$orderCopy = '';

if($postCount == 1 && $count > 2){
    $card_col = ' position-relative col-12 col-lg-8 rounded';
    $card_col_inner1 = ' col-12 m-0 p-0 ';
    $card_col_inner2 =' col-12 align-self-end m-0 align-self-end p-4 border border-bottom-0 h-100' ;
    $img_height = ' h-100 m-h350 ';
    $title_header = ' h3 ';
    $card_border= 'rounded border-0';
    $card_footer_padding = "py-4 border position-absolute b-0 w-100 rounded-bottom border-top-0";
     $copyClass = 'mb-5';
}elseif($postCount != 1 && $count > 2){
    $card_col = 'col-12 col-sm-6 col-md position-relative rounded';
    $card_col_inner1 ='col-4 col-sm-12 p-0 m-0';
    $card_col_inner2 ='col-8 col-sm-12 m-0 p-2  p-sm-3 px-md-3 pb-0 align-self-center border border-bottom-0 border-bottom-sm h-100 ';
    $img_height = ' m-h180 m-h120-md ';
    $title_header = ' h6 ';
    $card_border= 'rounded border-0 ' ;
    $card_footer_padding = "border rounded-bottom border-top-0";
    $copyClass = '';
}elseif($postCount == 2 && $count < 3){
    $card_col = 'col-12';
    $card_col_inner1 ='col-12 col-md-6 col-lg-5  p-0 m-0';
    $card_col_inner2 ='col-12 col-md-6 col-lg-7  m-0 p-3 p-md-4 position-relative border';
    $img_height = 'm-h350 m-h200-sm';
    $title_header = ' h3';
    $card_border= 'rounded border-0';
    $orderimg = 'order-1 order-md-2';
    $orderCopy = 'order-2 order-md-1';
    $copyClass = 'mb-5 mb-5 pt-lg-5';
    $card_footer_padding = "py-4 position-absolute b-0";
}elseif($postCount == 1 && $count < 3){
    $card_col = 'col-12';
    $card_col_inner1 ='col-12 col-md-6 col-lg-5 p-0 m-0';
    $card_col_inner2 ='col-12 col-md-6 col-lg-7 m-0 p-3 p-md-4 border position-relative';
    $img_height = 'm-h350 m-h200-sm';
    $title_header = ' h3 ';
    $card_border= 'rounded border-0';
    $orderimg = 'order-1';
    $orderCopy = 'order-2';
    $copyClass = 'mb-5 pt-lg-5';
    $card_footer_padding = "py-4 position-absolute b-0";
}
?>

<?php if($postCount == 2 && $count > 2):?>
<div class="col-lg-4 row m-0 row-cols-1 row-cols-md-2 row-cols-lg-1 px-0">
<?php endif;?>
<div class=" <?php echo $card_col;?> p-1 d-flex ">
    <div class="card <?php echo $card_border;?> d-flex overflow-hidden w-100 position-relative">
    <?php if ($vid =='') :?>
    <a href="<?php the_permalink();?>" class="z-2 r-0 l-0 t-0 b-0 position-absolute"></a>
    <?php endif;?>
        <article id="post-<?php the_ID(); ?>"  class=" row m-0 d-flex hoag-articles h-100">
            <!-- <div class="card py-0 mb-0 mx-0 mx-sm-3 bg-light-grey"> -->
                <div class="row m-0 p-0 w-100">
            <div class="<?php echo $card_col_inner1; ?>  <?php echo $orderimg;?> card-top rounded-0 ">
                <?php if ($vid !='') :?>
                    <a type="button" class="" data-toggle="modal" data-target="#video-modal-<?php the_ID(); ?>">
                        <?php echo('<img src='.$vid_img.' class="bg-grey-50 card-img-top img-fluid overflow-hidden '.$img_height.'  img-flex ">'); ?>
                        <div class="card-img-overlay overflow-hidden container rounded-0 p-0">
                            <?php
                                $article_types = get_the_terms( '', 'article-types' );
                                if ( ! empty($article_types)){
                                    if (strpos($article_types[0]->name, 'Press') !== false){
                                        echo '<span class="ml-1 small badge badge-pill badge-secondary">' . esc_html( $article_types[0]->name ) . '</span>';
                                    }else{
                                        echo '<span class="ml-1 small badge  badge-pill badge-info">' . esc_html( $article_types[0]->name ) . '</span>';
                                    }   
                                }else{
                                    echo'<span class="small">&nbsp;</span>';
                                }
                                // Get rid of the other data stored in the object, since it's not needed
                                unset($article_types);
                            ?>
                            <img class="pt-5 mx-auto d-block" src='<?php echo $plybtn; ?>'/>
                        </div>
                    </a>
                <?php else :?>
                        <div class="card-img-overlay overflow-hidden p-0">
                            <?php 
                                $article_types = get_the_terms( '', 'article-types' );
                                if ( ! empty($article_types)){
                                    if (strpos($article_types[0]->name, 'Press') !== false){
                                        echo '<span class="ml-1  small  badge-pill badge badge-primary">' . esc_html( $article_types[0]->name ) . '</span>';
                                    }else{
                                        echo '<span class="ml-1  small  badge-pill badge badge-info">' . esc_html( $article_types[0]->name ) . '</span>';
                                    }
                                    
                                }
                                // Get rid of the other data stored in the object, since it's not needed
                                unset($article_types);
                            ?>
                        </div>
                        <?php the_post_thumbnail('medium-large', ['class' => 'bg-grey-50 card-img-top rounded-0 img-fluid img-flex '.$img_height.'', 'alt'=>get_the_title(), 'title' => get_the_title() ]); ?>
                    
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
                <div class="card-title  text-tertiary text-left font-ms initial-weight <?php echo $copyClass;?>"><h3 class="<?php print $title_header;?>" ><?php echo mb_strimwidth(get_the_title(), 0, 70, '...'); ?></h3>
              

               <?php if ($postCount == 1 || $count == 2 ) { the_excerpt();}?>
        

                </div>
                <div class="text-muted <?php if($postCount != 1 ){ echo(' d-block d-sm-none ');} ?>  small position-absolute b-0 r-0 m-2 px-3 font-weight-bold">
                <?php if ($vid ==''):?>
                <span><?php read_time(); ?> min read</span>
                <?php else:?>
        <span>video</span>
                <?php endif;?>
        </div>
            </div><!-- card-body -->
        </article>
        <div class="<?php if($postCount != 1 ){ echo(' d-none d-sm-block ');} ?> text-muted text-right small pb-4 px-4 font-weight-bold <?php echo $card_footer_padding;?>">
        <?php if ($vid =='' && $count == 3):?>
                <span><?php read_time(); ?> min read</span>
        <?php else:?>
            <span>video</span>
        <?php endif;?>
        </div>
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
<?php if($postCount == 3 && $count > 2):?>
</div>
<?php endif;?>
