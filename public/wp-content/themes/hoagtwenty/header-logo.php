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
<body <?php body_class(); ?>>
<?php do_action('after_body_open_tag'); ?>
<header id="header" style="z-index:999;" class="no-gutters position-absolute w-100 shadow bg-white">
	<div class="container">
        <div class="row m-0">
			<div class="col-12 mt-1 ie-logo px-0"><!-- title/logo -->
                
					<?php require_once get_template_directory() . '/inc/svg-logo.php';?>  
					<img class="hoag-wave pb-2" height="45"  alt="<?php get_bloginfo('name'); ?>" src="<?php echo $svg_logo ;?>">
	
			</div><!-- end title/logo -->
        </div><!-- .row -->
	</div><!-- end container-fluid -->
</header>
<div id="body-disable" class="bg-grey-50 w-100 h-100 position-fixed blur t-0" style="display:none; z-index:99;"></div>