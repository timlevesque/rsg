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

<?php 
$options = get_post_meta( get_the_ID(), 'post_options', true);
if (isset($options['header_dark_mode'])){
	$fade = 'header-fade';
}else{$fade = '';}
?>

<header id="header" style="" class="<?php echo $fade; ?> z-4 no-gutters position-absolute w-100">
	<div class="container-fluid px-2">
        <div class="row">
			<div class="col-8 mt-1 ie-logo text-shadow px-0 mt-2"><!-- title/logo -->
			<?php get_template_part( 'template-parts/header-logo-widget' ); ?>
			</div><!-- end title/logo -->
			<div class="col-4 mt-1 pl-0">
                <?php get_template_part( 'template-parts/main-menus-widgets' ); ?>
            </div><!-- col -->

			<!-- <div class="col-2 justify-content-right row px-0 px-md-2">
			<?php 
				/* $searchwhite = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB3aWR0aD0iNjFweCIgaGVpZ2h0PSI2MXB4IiB2aWV3Qm94PSIwIDAgNjEgNjEiIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+CiAgICA8IS0tIEdlbmVyYXRvcjogU2tldGNoIDYxLjIgKDg5NjUzKSAtIGh0dHBzOi8vc2tldGNoLmNvbSAtLT4KICAgIDx0aXRsZT5TbGljZSAxPC90aXRsZT4KICAgIDxkZXNjPkNyZWF0ZWQgd2l0aCBTa2V0Y2guPC9kZXNjPgogICAgPGcgaWQ9IlBhZ2UtMSIgc3Ryb2tlPSJub25lIiBzdHJva2Utd2lkdGg9IjEiIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+CiAgICAgICAgPGNpcmNsZSBpZD0iT3ZhbCIgc3Ryb2tlPSIjRkZGRkZGIiBzdHJva2Utd2lkdGg9IjQiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDMwLjQ4OTU5MiwgMzAuOTg5NTkyKSByb3RhdGUoLTMxNS4wMDAwMDApIHRyYW5zbGF0ZSgtMzAuNDg5NTkyLCAtMzAuOTg5NTkyKSAiIGN4PSIzMC40ODk1OTI0IiBjeT0iMzAuOTg5NTkyNCIgcj0iMTkiPjwvY2lyY2xlPgogICAgICAgIDxsaW5lIHgxPSI0NC41MTA0MDc2IiB5MT0iNDUuNzE3NTE0NCIgeDI9IjU1LjgyNDExNjEiIHkyPSI1Ny4wMzEyMjI5IiBpZD0iTGluZSIgc3Ryb2tlPSIjRkZGRkZGIiBzdHJva2Utd2lkdGg9IjQiIHN0cm9rZS1saW5lY2FwPSJzcXVhcmUiPjwvbGluZT4KICAgIDwvZz4KPC9zdmc+';
				$searchgrey = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB3aWR0aD0iNjFweCIgaGVpZ2h0PSI2MXB4IiB2aWV3Qm94PSIwIDAgNjEgNjEiIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+CiAgICA8IS0tIEdlbmVyYXRvcjogU2tldGNoIDYxLjIgKDg5NjUzKSAtIGh0dHBzOi8vc2tldGNoLmNvbSAtLT4KICAgIDx0aXRsZT5TbGljZSAxPC90aXRsZT4KICAgIDxkZXNjPkNyZWF0ZWQgd2l0aCBTa2V0Y2guPC9kZXNjPgogICAgPGcgaWQ9IlBhZ2UtMSIgc3Ryb2tlPSJub25lIiBzdHJva2Utd2lkdGg9IjEiIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+CiAgICAgICAgPGcgaWQ9Ikdyb3VwIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwLjY5ODQ4NSwgMC45ODk1OTIpIiBzdHJva2U9IiM1QTVFNjgiIHN0cm9rZS13aWR0aD0iNCI+CiAgICAgICAgICAgIDxjaXJjbGUgaWQ9Ik92YWwtQ29weSIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMzAuMDAwMDAwLCAzMC4wMDAwMDApIHJvdGF0ZSgtMzE1LjAwMDAwMCkgdHJhbnNsYXRlKC0zMC4wMDAwMDAsIC0zMC4wMDAwMDApICIgY3g9IjMwIiBjeT0iMzAiIHI9IjE5Ij48L2NpcmNsZT4KICAgICAgICAgICAgPGxpbmUgeDE9IjQ0LjAyMDgxNTMiIHkxPSI0NC43Mjc5MjIxIiB4Mj0iNTUuMzM0NTIzOCIgeTI9IjU2LjA0MTYzMDYiIGlkPSJMaW5lLUNvcHkiIHN0cm9rZS1saW5lY2FwPSJzcXVhcmUiPjwvbGluZT4KICAgICAgICA8L2c+CiAgICA8L2c+Cjwvc3ZnPg==';
				$options = get_post_meta( get_the_ID(), 'post_options', true);
				if (isset($options['header_dark_mode'])){
					$searchicon = $searchwhite;
				}else{
					$searchicon = $searchgrey;
				} */
			?>
		 <img height='25px' class="slideright px-2 hover-grow ml-auto align-self-center search-toggle" src="<?php echo $searchicon;?>"/> 
				
			</div> -->
        </div><!-- .row -->
	</div><!-- end container-fluid -->
</header>
<?php get_template_part( 'template-parts/header-search-widget' ); ?>
<div id="begin">
<div id="body-disable" class="z-3 bg-grey-50 w-100 h-100 position-fixed blur t-0" style="display:none;"></div>
