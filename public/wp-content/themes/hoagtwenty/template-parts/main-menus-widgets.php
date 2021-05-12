<?php
/**
 * Displays the menus and widgets at the end of the main element.
 * Visually, this output is presented as part of the primary menu.
 *
 * @package WordPress
 * @subpackage Hoag_Twenty
 * @since 1.0.0
 */

$has_main_menu = has_nav_menu( 'primary' );

$has_sidebar_primary = is_active_sidebar( 'sidebar-primary' );
$has_sidebar_primary_bottom = is_active_sidebar( 'sidebar-primary-bottom' );

// Only output the container if there are elements to display.
if ( $has_main_menu || $has_sidebar_primary || $has_sidebar_primary_bottom ) {
	?>
<nav aria-label="<?php esc_attr_e( 'Main Menu', 'hoagtwenty' ); ?>" class="">
	<div class=" navbar-toggler border-0 d-block col-12 pr-0" data-toggle="offcanvas">
		<div class="hamburger_button ml-auto">
  			<div class="custom-toggler">
                    <?php 
                        $options = get_post_meta( get_the_ID(), 'post_options', true);
                        if (isset($options['header_dark_mode'])){
                            $icon_color = 'bg-pink';
                        }else{$icon_color = 'bg-pink';}
                    ?>
    			<div class="<?php echo $icon_color;?>"></div>
				<div class="<?php echo $icon_color;?>"></div>
				<div class="<?php echo $icon_color;?>"></div>
  			</div>
		</div>
	</div>
    <div class="z-4 offcanvas-collapse position-fixed shadow-lg overflow-visible col-10 col-sm-6 col-md-5 col-lg-4 col-xl-3  bg-tertiary t-0 p-0 m-0 d-block slide-nav-container p-4 containter-fluid no-gutters">
        <div class="row">
            <?php if ( $has_main_menu ) { ?>
                <div class="align-items-start">
                    <?php wp_nav_menu( array(
                        'container' => 'nav mt-5'
                        , 'container_id'    => 'nav'
                        , 'container_class' => 'mt-5'
                        , 'menu_class' => 'menu text-left navbar-nav bg-transparent slide-nav p-3 mt-5 pt-5'
                        , 'theme_location' => 'primary'
                        , 'walker'  => new bootstrap_submenu));
                    ?>
                </div>
            <?php } ?>
            <?php if ( $has_sidebar_primary ) { ?>
                <div class="text-light">
                    <?php dynamic_sidebar( 'sidebar-primary' ); ?>
                </div>
            <?php } ?>
            <?php if ( $has_sidebar_primary_bottom ) { ?>
                <div class="row align-items-end fixed-bottom border-top border-light text-light py-2">
                    <div class="col">
                        <?php dynamic_sidebar( 'sidebar-primary-bottom' ); ?>
                    </div><!-- .col -->
                </div><!-- .fixed-bottom -->
            <?php } ?>
        </div><!-- .row -->																
	</div><!--end collapse section -->
</nav>
<?php } ?>
