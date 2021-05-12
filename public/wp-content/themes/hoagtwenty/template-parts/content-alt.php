<?php
/**
 * layout for hoag-display-post for displaying content in alternating blocks and image alignment
 *
 * @package WordPress
 * @subpackage Hoag_Twenty
 * @since 1.0.0
 */

//where it falls in the list
global $postCount;

//how many there are
global $count;

require get_template_directory() . '/inc/video-logic.php';

//set deafualts to prevent php errors
$bg = 'bg-transparent';
$text_color = 'text-light';
$col_img ='px-0 pl-md-3 col-md-4 order-1 order-md-2';
$col_copy = 'col-md-8 order-2 order-md-1 pt-2';
if(is_page()){
$container = 'container-lg';
}else{
    $container = 'container-sm';  
}

if(is_odd($postCount)){
   
    $text_color = 'text-tertiary';
    if (has_post_thumbnail()){
        //image right
        $col_img ='px-0 pl-md-3 col-md-4 order-1 order-md-2';
        $col_copy = 'col-md-8 order-2 order-md-1';
        if(is_page()){
            $col_img ='px-0 pl-md-3 col-md-3 order-1 order-md-2';
            $col_copy = 'col-md-9 order-2 order-md-1';
        }

    }else{
        $col_copy = 'col-md-12 pt-2';
        if(is_page()){
            $col_copy = 'col-12 col-md-9 pt-2';
        }
    }
    
}elseif(!is_odd($postCount)){
    $text_color = 'text-tertiary';
    if (has_post_thumbnail()){
        //image left
        $col_img =' px-0 pr-md-3 col-md-4 order-1 order-md-1 px-0';
        $col_copy = 'col-md-8 order-2 order-md-2';
        if(is_page()){
            $col_img ='px-0 pr-md-3 col-md-3 order-1 order-md-1';
        $col_copy = 'col-md-9 order-2 order-md-2';
        }
    }else{
        $col_copy = 'col-12 pt-2 ';
        if(is_page()){
            $col_copy = 'col-12 col-md-9 pt-2 ';
        }

    }
}
?>
<div class="<?php echo $bg;?> <?php echo $container;?> px-3 py-5 border-bottom no-border-last border-tertiary">
    <div class="mx-auto no-gutters">
        <h3 class="order-1 mt-0 px-0 <?php echo $text_color;?>"><a href="<?php the_permalink();?>" rel="bookmark"><?php echo mb_strimwidth(get_the_title(), 0, 70, '...'); ?></a></h3>
        <div class="row d-flex">
        <!-- new img logic-->
        <?php if ($vid !='') :?>
            <div class="mb-3 px-0 <?php echo $col_img;?> ">
        <a class="w-100" type="button" class="" data-toggle="modal" data-target="#video-modal-<?php the_ID(); ?>">
                        <?php echo('<img src='.$vid_img.' class="img-fluid shadow rounded h-100 m-h180 m-h200-sm img-flex ">'); ?>
                        <div class="t-50 card-img-overlay  container rounded-0 p-0">
                            <img class="mx-auto d-block" src='<?php echo $plybtn; ?>'/>
                        </div>
                    </a>
                    </div>
                <?php else :?>
                    <div class=" px-0 mb-3 <?php echo $col_img;?> ">
                    <a class="w-100" href="<?php the_permalink();?>"><?php the_post_thumbnail('medium', ['class' => 'img-fluid shadow rounded h-100 m-h180 img-flex', 'alt'=>get_the_title(), 'title' => get_the_title() ]); ?></a>
                </div>
                    
                <?php endif; ?>
        <!--end img logic-->
            <div class="mt-lg-0 px-0 align-self-center <?php echo $col_copy;?>">
                <div class="<?php echo $text_color;?>">
                    <?php 
                        if(has_excerpt()){
                        echo '<p class="m-0">' . get_the_excerpt() . '</p>';
                        ?>
                        <a href="<?php the_permalink();?>"><br>Read&nbsp;More&nbsp;&rarr;</a>
                        <?php
                        }else{
                            echo '<p class="m-0">' . get_the_excerpt() . '</p>';
                        }
                        ?>
                </div>
                <?php
        if ( 'post' == get_post_type() ) {
            if ($vid =='') :?>
                    <p class="small text-muted text-sm mb-0 pt-2"><?php read_time(); ?> min read</p>
            <?php  elseif ($vid !=''):?>
                <p class="small text-muted text-sm mb-0 pt-2">video</p>
            <?php endif;        
        }?>
            </div><!-- col copy -->
        </div>

           
    </div><!-- container-sm -->
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
<!--modal end-->
    
</div>