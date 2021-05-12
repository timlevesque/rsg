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
   $city= '';

   $options = get_post_meta( get_the_ID(), 'case_studies_options', true);
   if($options){
    $city =  $options['city'];
   }


  


//$the_tags = get_the_tags( );// print_r($the_tags);
?>
<div class="col p-2 slideup stagger media-card">
    <div class="card border  border-tertiary h-100 rounded overflow-hidden w-100 hover-shadow">
        <article id="post-<?php the_ID(); ?>" <?php post_class('excerpt hoag-articles'); ?> class="hoag-articles h-100">
            <!-- <div class="card py-0 mb-0 mx-0 mx-sm-3 bg-light-grey"> -->
            <?php
                        if(has_post_thumbnail()):?>
            <div class="card-top overflow-hidden position-relative">
                
                    <a href="<?php the_permalink();?>">
                        <div class="card-img-overlay overflow-hidden p-0">
                            <?php 
                                /* $article_types = get_the_terms( '', 'article-types' );
                                if ( ! empty($article_types)){
                                    if (strpos($article_types[0]->name, 'Press') !== false){
                                        echo '<span class="ml-1  small badge badge-pill badge-primary">' . esc_html( $article_types[0]->name ) . '</span>';
                                    }else{
                                        echo '<span class="ml-1  small badge badge-pill badge-info">' . esc_html( $article_types[0]->name ) . '</span>';
                                    }
                                    
                                }
                                // Get rid of the other data stored in the object, since it's not needed
                                unset($article_types); */
                            ?>
                        </div>
          <!--               <div class="ie-180 img-16-90">
                       <?php
                            /* the_post_thumbnail('medium-large', ['class' => 'h-100 bg-grey-50 card-img-top overflow-hidden img-fluid img-flex ie-article-img', 'alt'=>get_the_title(), 'title' => get_the_title() ]);  */
                        ?>
                        </div>	  -->                       
                    </a>
            </div>
        <?php endif;?>
            <div class="card-body ">
            <p class="text-sm text-primary mb-3 p-0"><strong><?php echo ($city);?></strong></p>
                <div class="card-title text-secondary text-left h5 font-weight-bold"><strong><?php echo mb_strimwidth(get_the_title(), 0, 70, '...'); ?></strong>
                </div>
            </div><!-- card-body -->
        </article>
        <div class="row no-gutters mx-0 p-0 h-100">
            <div class="col align-self-end  border-0 card-footer bg-white small ">
                <div class="row justify-content-between px-4 mx-0">
                <?php
                           // Get publications
           /*                  $publications = get_the_terms( '', 'publications' );
                            if ( ! empty($publications)){
                                echo '<a href="' . esc_url( get_category_link( $publications[0]->term_id ) ) . '" class="text-right text-xs badge  badge-primary">' . esc_html( $publications[0]->name ) . '</a>';
                            }
                            // Get rid of the other data stored in the object, since it's not needed
                            unset($publications); */
                        ?>
                    <div class="ml-auto small font-weight-bold text-teriary">
                        <?php if ($vid =='') :?>
                            <span><?php read_time(); ?> min read</span>
                        <?php else:?>
                            <span>video</span>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div><!--end card footer -->
        <a class="position-absolute t-0 r-0 l-0 b-0" href="<?php the_permalink();?>"></a>
    </div><!-- card --->
    <!-- Modal -->
    </div>
