<?php
/**
 * Displays the menus and widgets at the end of the main element.
 * Visually, this output is presented as part of the primary menu.
 *
 * @package WordPress
 * @subpackage Hoag_Twenty
 * @since 1.0.0
 */

$has_utility_menu = has_nav_menu( 'utility-menu' );

$has_sidebar_utility_menu = is_active_sidebar( 'sidebar-utility-menu' );
$has_sidebar_utility_menu_bottom = is_active_sidebar( 'sidebar-utility-menu-bottom' );

// Only output the container if there are elements to display.
if ( $has_utility_menu || $has_sidebar_utility_menu || $has_sidebar_utility_menu_bottom ) {
	?>
<div aria-label="<?php esc_attr_e( 'Utility Menu', 'hoagtwenty' ); ?>" class="align-self-center utility-menu-wrapper pt-1 ml-auto d-block" style=" z-index: 9999;">
    <div style="z-index:99999999;" class="slideright utility-menu-icon h-100col ml-auto px-0" >
    <div id="utilities-icon" class="w-100 ml-auto">
    <?php 
                $options = get_post_meta( get_the_ID(), 'post_options', true);
                if (isset($options['header_dark_mode'])){
                    $icon_color = 'text-white arrow-white-down-after';
                }else{$icon_color = 'text-grey  arrow-down-after';}
          ?>

  <button class="d-flex  icon-after py-0 btn px-0 position-relative text-sm font-weight-bold ml-n5 ml-sm-auto <?php echo $icon_color;?>">
  My Hoag&nbsp;&nbsp;&nbsp;
  </button>
 
</div>
	</div>
    <div class="utility-menu rounded shadow utility-menu-collapse text-white  position-fixed bg-secondary col-10 col-md-8 col-lg-4 t-0 p-0 m-0 d-block slide-nav-container  px-3 containter-fluid no-gutters">
        <div class="row">
            <?php if ( $has_utility_menu ) { ?>
                <div class="align-items-start w-100">
                    <?php wp_nav_menu( array(
                        'container' => 'nav pt-5 mt-5'
                        , 'container_id'    => 'nav'
                        , 'container_class' => ''
                        , 'menu_class' => 'utility-menu navbar-nav bg-transparent slide-nav p-3  py-5 mt-5 text-left  text-light'
                        , 'theme_location' => 'utility-menu'
                        , 'walker'  => new bootstrap_submenu));
                    ?>
                </div>
            <?php } ?>
            <?php if ( $has_sidebar_utility_menu ) { ?>
                <div class="text-light">
                    <?php dynamic_sidebar( 'sidebar-utility-menu' ); ?>
                </div>
            <?php } ?>
            <?php if ( $has_sidebar_utility_menu_bottom ) { ?>
                <div class="row align-items-end fixed-bottom border-top border-light text-light py-2">
                    <div class="col">
                        <?php dynamic_sidebar( 'sidebar-utility-menu-bottom' ); ?>
                    </div><!-- .col -->
                </div><!-- .fixed-bottom -->
            <?php } ?>
        </div><!-- .row -->																
	</div><!--end collapse section -->
            </div>
<?php } ?>
