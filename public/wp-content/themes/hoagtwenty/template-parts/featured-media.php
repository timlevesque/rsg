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
if ($vid !='') :?>
    <div class="video-container">
        <iframe class="youtube-vid" width="560" height="315" src='<?php echo $vid_embed;?>' frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
    </div>
<?php elseif(has_post_thumbnail()):
 the_post_thumbnail( 'large',array('class' => ' h-100 img-fluid img-flex ie-flexfix') ); 
/* else:?>
    <img class="h-100 img-fluid img-flex ie-flexfix" src="<?php randomImg();?>"/> */
 endif; ?>