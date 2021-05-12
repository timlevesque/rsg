<?php
/**
 * card for ad like spots from pages. 
 * Utilizes hero title and header darkmode logic from page to display proper logo and text color.
**/

$page_options = get_post_meta( get_the_ID(), 'post_options', true);
//print_r($page_options);

require get_template_directory() . '/inc/svg-logo.php';
if ( ! empty( $options['header_dark_mode']) ) {
    $svg_logo = $white_logo;
    $text_color = 'text-light';
    $btn_color = 'btn-outline-white';

}else{
    $svg_logo = $color_logo;
    $text_color = 'text-tertiary';
    $btn_color = 'btn-outline-tertiary';
}
?>

<div class="card-ads m-h350 d-flex container-fluid position-relative px-0 "><!--flex used to vertically align copy -->
    <div class="container-lg img-overlay align-self-center">
        <div class="entry-header col-8">
        <img class="" height="42px"  alt="<?php get_bloginfo('name'); ?>" src="<?php echo $svg_logo ;?>">
            <?php
                $ad_url = esc_url( get_permalink());
                print '<a class="'.$text_color.'" href="' . $ad_url . '" rel="bookmark">';
                the_title( '<h3>', '</h3>' );
                print '</a>';
            ?>
            <?php if ( ! empty( $options['hero_title']) ) :?>
                <p class="<?php print $text_color;?>"><?php print $options['hero_title'];?></p>
            <?php endif; ?>
            <a href="<?php echo $ad_url;?>" class="btn <?php print $btn_color;?> d-inline-flex mt-4" rel="bookmark">Learn more</a>
        </div><!-- .entry-header -->
    </div>
    <?php the_post_thumbnail( 'medium-large',array('class' => 'img-fluid img-flex img-flex-h250 ie-flexfix') ); ?>
</div>