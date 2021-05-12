<?php
/**
 * A light version of the themes
 * Displays all of the <head> section and everything up till <div id="content">
 * @package hoagtwenty
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>images/favicon.ico" />
	<link rel="apple-touch-icon" sizes="32x32" href="<?php echo get_stylesheet_directory_uri(); ?>images/favicon-32x32.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri(); ?>images/180-icon.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri(); ?>images/favaicon-512x512.png">
	<?php wp_head(); ?>
</head>
<body onload="checkCookie()" <?php body_class(); ?>>
<?php do_action('after_body_open_tag'); ?>
<div class="text-center p-2 bg-primary"><a href="/covid-19-resources/" class="text-white">RSG COVID-19 Economic Response Team&nbsp;&rarr;</a></div>
<header id="header" class="z-4 no-gutters bg-white w-100 position-relative border-bottom">
	<div class="container-fluid px-2">
        <div class="row ">
			<div class="col-8  ie-logo px-0 py-1 pl-3 "><!-- title/logo -->
                <a class="title" title="<?php get_bloginfo('name'); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php require_once get_template_directory() . '/inc/svg-logo.php';?>  
					<img class="header-logo py-1"  alt="<?php get_bloginfo('name'); ?>" src="<?php echo $color_logo;?>">
			    </a>
			</div><!-- end title/logo -->
			<div class="col-4 mt-1 pl-0 align-self-center">
                <?php get_template_part( 'template-parts/main-menus-widgets' ); ?>
            </div><!-- col -->
			<!-- <div class="col-2 justify-content-right row px-0 px-md-2"></div>
			<?php /* require_once get_template_directory() . '/inc/svg-logo.php'; */?>
			<img height='25px' class="slideright px-2 hover-grow ml-auto align-self-center search-toggle" src="<?php echo $searchicon;?>">
			</div>-->
        </div><!-- .row -->
	</div><!-- end container-fluid -->
</header>
<?php get_template_part( 'template-parts/header-search-widget' ); ?>
<div id="begin">
<div id="body-disable" class="bg-grey-50 w-100 h-100 position-fixed blur t-0 z-3" style="display:none;"></div>