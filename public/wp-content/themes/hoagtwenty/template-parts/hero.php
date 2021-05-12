<?php
/**
 * If hero information title, cta, or subtext not null, display the hero
 * else don't display anything.
 * Requires a supporting plugin.
 *
 * @package WordPress
 * @subpackage Hoag_Twenty
 * @since 1.0.0
 */
/*
'hero_title' => '',
        'hero_subtext' => '',
        'hero_cta' => '',
        'hero_link' => '',
        'hero_btn_wrapper_class' => '',
        'hero_wrapper_class' => '',
*/

require get_template_directory() . '/inc/video-logic.php';


$options = get_post_meta( get_the_ID(), 'post_options', true);
$hero_image_anchor_top = '';

if ( ! empty( $options['hero_title']) ) {
    $hero_title = $options['hero_title'];
    $has_hero = true;
}
if ( ! empty( $options['hero_cta']) ) {
    $hero_cta = $options['hero_cta'];
    $has_hero = true;
}
if ( ! empty( $options['hero_subtext']) ) {
    $hero_subtext = $options['hero_subtext'];
    $has_hero = true;
}
if ( ! empty( $options['hero_link']) ) {
    $hero_link = $options['hero_link'];
}
if ( ! empty( $options['hero_btn_wrapper_class']) ) {
    $hero_btn_wrapper_class = $options['hero_btn_wrapper_class'];
}
if ( ! empty( $options['hero_wrapper_class']) ) {
    $hero_wrapper_class = $options['hero_wrapper_class'];
}
if ( isset( $options['hero_image_anchor_top']) ) {
    $hero_image_anchor_top = 'anchor-top';
}
$heroBg = "";
if($vid != ''){$heroBg = 'bg-tertiary25'; $hero = 'hero-vid-wrap';}else{$hero = "hero-img";}
?>
    <div class="overflow-hidden hero <?php echo $hero; ?> position-relative">
        <div class="z-2  <?php echo $heroBg;?>  img-overlay h-100">
            <div class="no-gutters row mx-auto container-lg img-overlay h-100">
            <div class="<?php echo $hero_wrapper_class;?> text-left    mb-md-0 pb-md-0 align-self-center col-12 col-md-9 col-lg-8 col-xl-7 pb-5 pb-md-0 ">
            
                <div class="px-0">
           
            <div class=" fadein ">
            <?php if(isset($hero_subtext)):?>
                    <p class="font-weight-bold text-sm"><?php print $hero_subtext; ?></p>
                    <?php else: ?>
                    <div class="m-3 p-3 invisible">
                    </div>
                <?php endif; ?>
                <?php if(isset($hero_title)):?>
                    <h1><?php print $hero_title; ?></h1>
                <?php endif; ?>

                </div>
                <?php if(isset($hero_btn_wrapper_class)):?>
                    <div class="<?php echo $hero_btn_wrapper_class;?>">
                <?php endif; ?>
                    <?php if( isset($hero_cta) && isset($hero_link)):?>
                        <a href="<?php echo $hero_link;?>" class="btn btn-primary px-5 py-3 mt-2 mt-md-5"><?php print $hero_cta; ?></a>
                    <?php endif; ?>
                <?php if(isset($hero_btn_wrapper_class)):?>
                    </div>
                <?php endif; ?>
                </div>
            </div>
            <!-- <span class="home-carat mx-auto align-self-end"></span> -->
        </div>
        </div>
        <?php if($vid != ''):?>
        <div class="video-container mt-n5">  
                        <iframe style="background-image:url('<?php echo the_post_thumbnail_url(); ?>'); background-size: 100%; background-position: 0;" class="mt-n5 z-1 youtube-vid" width="560" height="315" src="" data-src='<?php echo $vid_embed;?>&autoplay=1&loop=1&autopause=0&muted=1&background=1' frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                    </div>
        <?php else:?>           
        <?php echo the_post_thumbnail( '' ,array('class' => ' img-flex-h100 '.$hero_image_anchor_top.' ie-flexfix') ); ?>
        <?php endif;?>
    </div>
