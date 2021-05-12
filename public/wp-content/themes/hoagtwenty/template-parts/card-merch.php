<?php
/**
 * card for merch spots
**/
        
$merch_options = get_post_meta( get_the_ID(), 'merch_options', true);
if ( ! empty( $merch_options['layout-style']) ) {
    $layout_style = $merch_options['layout-style'];
}
if ( ! empty( $merch_options['color-overlay']) ) {
    $color_overlay = $merch_options['color-overlay'];
    if($color_overlay == 'default'){
        //default, primary, secondary, tertiary
           $bg_color = '';
    }elseif($color_overlay == 'primary'){
            $bg_color = ' bg-primary50';
    }elseif($color_overlay == 'secondary'){
            $bg_color = ' bg-secondary50';
    }elseif($color_overlay == 'tertiary'){
            $bg_color = ' bg-tertiary50';
    }
}
    if ( ! empty( $merch_options['text-position']) ) {
        $text_position = $merch_options['text-position'];
        if ($text_position == 'right'){
            $img_position = 'slideleft';
            if($layout_style =='fullbleed'){
                $img_position = '';
                $img_full = 'img-merch-full-left';
                $text_position = 'ml-auto text-md-left';
            }
        }elseif($text_position == 'left'){
            $img_position = 'order-1 order-md-2 slideright';
            $text_position = 'order-2 order-md-1 text-md-left';

        } elseif($text_position == 'center'){
            $img_position = '';
            $text_position = 'mx-auto text-center';
        } 
    }
    if ( ! empty( $merch_options['cta-url']) ) {
        $cta_url = $merch_options['cta-url'];
    }
    if ( ! empty( $merch_options['cta-text']) ) {
        $cta_text = $merch_options['cta-text'];
    }

    // TO-DO: need to add color-treatment, default, dark
    if ( ! empty( $merch_options['color-treatment']) ) {
    $color_treatment = $merch_options['color-treatment'];
        if ($color_treatment == 'default'){
            $text_color = 'text-tertiary';
            $btn_color = 'btn-outline-tertiary';
        }elseif($color_treatment == 'light'){
            $text_color = 'text-light';
            $btn_color = 'btn-outline-white';
        }
    }
?>
<?php if(isset($layout_style) && ($layout_style =='fullbleed')):?>
    <div id="post-<?php the_ID(); ?>" class="col p-0 img-screen75 m-h550-md">
        <div class="m-h550-md img-screen75 row py-5 m-0 no-gutters d-flex img-overlay  <?php if (isset($bg_color)){echo $bg_color;} ?> <?php if (isset($text_color)){echo $text_color;} ?>">
            <div class="container">
                <div class=" z-1 slideup col pt-4 pt-md-0 col-md-6 col-xl-4 <?php if (isset($text_position)){echo $text_position;} ?> text-center mx-md-reset">
                    <h4 class="h2 entry-title"><?php echo get_the_title() ?></h4>
                    <p><?php echo the_excerpt();?></p>
                    <?php if( isset($cta_text) && isset($cta_url)):?>
                        <a href="<?php echo $cta_url;?>" class="btn <?php echo $btn_color;?> d-inline-flex mt-4"><?php print $cta_text; ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php echo the_post_thumbnail( 'large',array('class' => 'fadein '.$img_full.' img-merch-full ie-flexfix') ); ?>
    </div>
<?php elseif(isset($layout_style) && ($layout_style =='float-image')):?>
    <div id="post-<?php the_ID(); ?>" class="col p-0 bg-white ">
        <div class="d-flex no-gutters containter-fluid <?php if (isset($bg_color)){echo $bg_color;} ?> <?php if (isset($text_color)){echo $text_color;} ?>">
            <div class="row pb-5 px-4 px-lg-0 pt-0 pt-md-5 m-0 container-lg mx-auto">
                <div class="col-md-7 align-self-center mt-n5 mt-md-0 px-0 <?php if (isset($img_position)){echo $img_position;} ?>">
                    <?php echo the_post_thumbnail( 'large',array('class' => 'rounded img-fluid img-flex ie-flexfix') ); ?>
                </div>
                <div class="col-md mt-4 py-4 mt-md-0 px-md-4 px-lg-5 align-self-center <?php if (isset($text_position)){echo $text_position;} ?> mx-auto text-center mx-md-reset text-md-left">
                    <div class="slideup">
                    <h4 class="  h2 entry-title"><?php echo get_the_title() ?></h4>
                    <p><?php echo the_excerpt();?></p>
                    <?php if( isset($cta_text) && isset($cta_url)):?>
                        <a href="<?php echo $cta_url;?>" class="btn <?php echo $btn_color;?> d-inline-flex mt-md-4 mt-md-0 mb-md-0 my-5"><?php print $cta_text; ?></a>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
</div>
<?php else:?>
<?php print_r($merch_options);?>
<?php endif;?>