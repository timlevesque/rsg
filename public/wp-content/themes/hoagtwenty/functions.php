<?php
/** 
 * hoagtwenty functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage hoagtwenty
 * @since 1.0.0
*/

// Hide admin bar
//add_filter('show_admin_bar', '__return_false');


//Sets up theme defaults and registers support for various WordPress features.
//Note that this function is hooked into the after_setup_theme hook, which
//runs before the init hook. The init hook is too late for some features, such
//as indicating support for post thumbnails.

function hoagtwenty_setup() {
		
	//Make theme available for translation.
	//Translations can be filed in the /languages/ directory.
	//If you're building a theme based on hoag base theme, use a find and replace
	//to change 'hoag-base01' to the name of your theme in all the template files.
	load_theme_textdomain( 'hoagtwenty', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
	// add_theme_support( 'automatic-feed-links' );

	//Let WordPress manage the document title.
	//By adding theme support, we declare that this theme does not use a
	//hard-coded <title> tag in the document head, and expect WordPress to
	//provide it for us.
	add_theme_support( 'title-tag' );
		
	// Enable support for Post Thumbnails on posts and pages.
	// @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
    add_theme_support( 'post-thumbnails' );

    // Set post thumbnail size.
	// set_post_thumbnail_size( 1200, 9999 );

	// Add custom image size used in Cover Template.
    // add_image_size( 'hoagtwenty-fullscreen', 1980, 9999 );
    
    function hoagtwenty_the_custom_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$image_logo = wp_get_attachment_image_src( $custom_logo_id , 'small' );
			//load logo as data uri
			$b64image = base64_encode(file_get_contents($image_logo[0]));
			echo '<img class="custom-logo" height="'.$image_logo[2].'" width="'.$image_logo[1].'" alt="'.get_bloginfo('name').'" src="data:image/png;base64,'.$b64image.'" />';
		}else{
			echo '<h1>'.get_bloginfo('name').'</h1>';
		}
    }

    add_theme_support( 'custom-logo', array(
        'height'      => 80,
        'width'       => 200,
        'flex-height' => false,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ) );

    // Set up the WordPress core custom background feature.
    add_theme_support( 'custom-background', apply_filters( 'hoagtwenty_custom_background_args', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    ) ) );
    
    /*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
		
	add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'script',
        'style',
    ) );
    
    /*
	 * Adds `async` and `defer` support for scripts registered or enqueued
	 * by the theme.
	 */
	$loader = new HoagTwenty_Script_Loader();
	add_filter( 'script_loader_tag', array( $loader, 'filter_script_loader_tag' ), 10, 2 );
    

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'hoagtwenty' ),
			'top' => esc_html__( 'Top', 'hoagtwenty' ),
			'cta' => esc_html__( 'CTA', 'hoagtwenty' ),
            'footer' => esc_html__( 'Footer', 'hoagtwenty' ),
            'mobile-phone-menu' => esc_html__( 'Phone-menu', 'hoagtwenty' ),
            'utility-menu' => esc_html__( 'Utility Menu', 'hoagtwenty' ),
            
	) );
		
	}

	add_action( 'after_setup_theme', 'hoagtwenty_setup' );

	
	/* //add site logo as admin logo image
	function wpdev_filter_login_head() {
	
		if ( has_custom_logo() ) :
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$image_logo = wp_get_attachment_image_src( $custom_logo_id , 'small' );
			$b64image = base64_encode(file_get_contents($image_logo[0]));
			?>
			<style type="text/css">
				.login h1 a {
					background-image: url(<?php echo esc_url( $image_logo[0] ); ?>);
					-webkit-background-size: <?php echo absint( $image_logo[1] )?>px;
					background-size: <?php echo absint( $image_logo[1] ) ?>px;
					height: <?php echo absint( $image_logo[2] ) ?>px;
					width: <?php echo absint( $image_logo[1] ) ?>px;
				}
			</style>
			<?php
		endif;
	}
	add_action( 'login_head', 'wpdev_filter_login_head', 100 ); */
add_action( 'after_setup_theme', 'hoagtwenty_setup' );

//Set the content width in pixels, based on the theme's design and stylesheet.
//Priority 0 to make it available to lower priority callbacks.
//@global int $content_width

function hoagtwenty_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'hoagtwenty_content_width', 1020 );
}
add_action( 'after_setup_theme', 'hoagtwenty_content_width', 0 );


//Register widget area.
//@link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar

function hoagtwenty_widgets_init() {
    $shared_args = array(
		'before_title'  => '<h2 class=" py-2 text-center font-md font-weight-light">',
		'after_title'   => '</h2>',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
    );

    $shared_args_well = array(
		'before_title' 	=> '<h4 class="widget-title">',
		'after_title' 	=> '</h4>',
		'before_widget' => '<aside id="%1$s" class="widget %2$s well">',
		'after_widget' 	=> '</aside>',
    );

    register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Primary Menu Sidebar', 'hoagtwenty' ),
				'id'          => 'sidebar-primary',
				'description' => __( 'Widgets in this area will be displayed below the primary menu in the side menu', 'twentytwenty' ),
			)
		)
    );

    register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Primary Menu bottom', 'hoagtwenty' ),
				'id'          => 'sidebar-primary-bottom',
				'description' => __( 'Widgets in this area will be displayed in the sidebar navigation fixed bottom', 'twentytwenty' ),
			)
		)
    );

	register_sidebar( array(
		'name' 			=> esc_html__( 'Header', 'hoagtwenty' ),
		'id' 			=> 'header',
		'before_widget' => '<div class="header-cta">',
		'after_widget' 	=> '</div>',
		'before_title' 	=> '',
		'after_title' 	=> '',
    ) );
    

    register_sidebar(
		array_merge(
			$shared_args_well,
			array(
				'name'        => __( 'Footer Links ', 'hoagtwenty' ),
                'id'          => 'footer-links',
                'description' => __( 'Widgets in this area will be displayed in the sidebar navigation', 'twentytwenty' ),
                'before_widget' => '<div class="mb-4 mb-md-0 footer-menu col-6 col-md px-0 text-white line-2 ">',
                'after_widget' => '</div>',
                'before_title' => '<h6 class="widget-title text-white">',
                'after_title' => '</h6>',
			)
		)
    );


    register_sidebar(
		array_merge(
			$shared_args_well,
			array(
				'name'        => __( 'Footer Block', 'hoagtwenty' ),
				'id'          => 'footer-blocks',
				'description' => __( 'Widgets in this area will be displayed in the sidebar navigation', 'twentytwenty' ),
			)
		)
    );

    register_sidebar(
		array_merge(
			$shared_args_well,
			array(
				'name'        => __( 'Footer Accolades', 'hoagtwenty' ),
				'id'          => 'footer-accolades',
				'description' => __( 'Widgets in this area will be displayed in the sidebar navigation', 'twentytwenty' ),
			)
		)
    );
/*     register_sidebar(
		array_merge(
			$shared_args_well,
			array(
				'name'        => __( 'Footer Links', 'hoagtwenty' ),
                'id'          => 'footer-links',    
				'description' => __( 'Widgets in this area will be displayed in the sidebar navigation', 'twentytwenty' ),
			)
		)
    ); */
    register_sidebar(
		array_merge(
			$shared_args_well,
			array(
				'name'        => __( 'Social Media', 'hoagtwenty' ),
				'id'          => 'social-media',
				'description' => __( 'Widgets in this area will be displayed in the sidebar navigation', 'twentytwenty' ),
			)
		)
    );


}
add_action( 'widgets_init', 'hoagtwenty_widgets_init' );

//Enqueue scripts and styles.
function hoagtwenty_scripts() {
    $theme_version = wp_get_theme()->get( 'Version' );
    wp_enqueue_style( 'bootstrap4-css', get_template_directory_uri() .'/css/bootstrap.min.css',array(),'' );
    wp_enqueue_style( 'hoagtwenty-style', get_template_directory_uri() .'/css/theme.css', $theme_version );
    wp_dequeue_script('jquery');
    wp_deregister_script('jquery');
    wp_enqueue_script( 'jquery', get_template_directory_uri() .'/js/jquery-3.3.1.min.js', array(), true );
	wp_enqueue_script( 'popper', get_template_directory_uri() .'/js/popper.min.js', array(), true );
	wp_enqueue_script( 'bootstrap4-js', get_template_directory_uri() .'/js/bootstrap.min.js', array(), true);	
    wp_enqueue_script( 'hoag-twenty-js', get_template_directory_uri() . '/js/hoagtwenty.js', array(), 1, true);
    
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'hoagtwenty_scripts', 10 );

//Implement the Custom Header feature.
require get_template_directory() . '/inc/custom-header.php';

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

//Custom functions that act independently of the theme templates.
require get_template_directory() . '/inc/extras.php';

//Customizer additions.
require get_template_directory() . '/inc/customizer.php';

//Load Jetpack compatibility file.
require get_template_directory() . '/inc/jetpack.php';

// Custom script loader class.
require get_template_directory() . '/classes/class-hoagtwenty-script-loader.php';

// sub menu options
class bootstrap_submenu extends Walker_Nav_Menu {
	function start_lvl(&$output, $depth = 0, $args = array()) {
		$output .= "\n<ul class=\"dropdown-menu shadow-lg rounded-0\">\n";
	}
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		$item_html = '';
		parent::start_el($item_html, $item, $depth, $args);
		if ( $item->is_dropdown && $depth === 0 ) {
			$item_html = str_replace( '<a', '<a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"', $item_html );
			$item_html = str_replace( '</a>', ' <b class="caret "></b></a>', $item_html );
		}
		// add nowrap text to submenu itmes
		if ($depth === 1 ) {
			$item_html = str_replace( '<a', '<a class="text-nowrap"', $item_html );
		}
		
		$output .= $item_html;
	}
	function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
		if ( $element->current )
			$element->classes[] = 'active';
		$element->is_dropdown = !empty( $children_elements[$element->ID] );
		if ( $element->is_dropdown ) {
			if ( $depth === 0 ) {
				$element->classes[] = 'dropdown';
			} elseif ( $depth === 1 ) {
				// Extra level of dropdown menu,
				// as seen in http://twitter.github.com/bootstrap/components.html#dropdowns
				$element->classes[] = 'dropdown-submenu';
			}
		}
		parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
	}
}

// modify all images to include the bootstrap responsive images option
function add_image_class($class){
	$class .= ' img-fluid';
	return $class;
}
add_filter('get_image_tag_class','add_image_class');

//Checks if a post thumbnails is already defined.
function freshclicks_is_post_thumbnail_set()
{
	global $post;
	if (get_the_post_thumbnail()) {
		return true;
	} else {
		return false;
	}
}

//Set post thumbnail as first image from post, if not already defined.
function freshclicks_autoset_featured_img()
{
	global $post;

	$post_thumbnail = freshclicks_is_post_thumbnail_set();
	if ($post_thumbnail == true) {
		return get_the_post_thumbnail();
	}
	$image_args     = array(
			'post_type'      => 'attachment',
			'numberposts'    => 1,
			'post_mime_type' => 'image',
			'post_parent'    => $post->ID,
			'order'          => 'desc'
	);
	$attached_images = get_children($image_args, ARRAY_A);
	$first_image = reset($attached_images);
	if (!$first_image) {
		return false;
	}

	return get_the_post_thumbnail($post->ID, $first_image['ID']);

}

//Add custom image sizes attribute to enhance responsive image functionality
//for content images
//@param string $sizes A source size value for use in a 'sizes' attribute.
//@param array  $size  Image size. Accepts an array of width and height
//                     values in pixels (in that order).
//@return string A source size value for use in a content image 'sizes' attribute.

function freshclicks_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 100vw';

	if ( 'page' === get_post_type() ) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 100vw';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'freshclicks_content_image_sizes_attr', 10 , 2 );

//Add custom image sizes attribute to enhance responsive image functionality
//for post thumbnails
//@param array $attr Attributes for the image markup.
//@param int   $attachment Image attachment ID.
//@param array $size Registered image size or flat array of height and width dimensions.
//@return string A source size value for use in a post thumbnail 'sizes' attribute.

function freshclicks_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 100vw';
		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 100vw';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'freshclicks_post_thumbnail_sizes_attr', 10 , 3 );

// add 'read more' to post excerpts
function new_excerpt_more( $more ) {
	return '<span class="">... <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read Full Article', 'your-text-domain') . '</a></span>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

// add SVG support
function svg_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
  }
add_filter('upload_mimes', 'svg_mime_types');


/***************
 admin customizer
 **************/ 
function themename_customize_register($wp_customize){


    //new customizer section
    $wp_customize->add_section('themename_color_scheme', array(
        'title'    => __('Admin Style', 'themename'),
        'description' => '',
        'priority' => 120,
    ));
 
 
    //logo upload
    $wp_customize->add_setting('login_logo', array(
        'default'           => 'image.jpg',
        'transport'   => 'refresh',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'login_logo', array(
        'label'    => __('Admin Logo', 'themename'),
        'section'  => 'themename_color_scheme',
        'settings' => 'login_logo',
    )));
 
    //color picker
    $wp_customize->add_setting('login_bg_color', array(
        'default'     => '#f1f1f1',
        'transport'   => 'refresh',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'login_bg_color', array(
        'label'    => __('Bakground Color', 'themename'),
        'section'  => 'themename_color_scheme',
        'settings' => 'login_bg_color',
    )));
 
}
 
add_action('customize_register', 'themename_customize_register');

add_filter( 'image_size_names_choose', 'fresh_custom_sizes' );
function fresh_custom_sizes( $sizes ) {
   return array_merge( $sizes, array(
      'medium_large' => __( 'Medium Large' ),
   ) );
}

/***************
 admin css output
 ***************/
function wpdev_filter_login_head() {
    

if (get_theme_mod('login_logo')):
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$image_logo = wp_get_attachment_image_src( $custom_logo_id , 'small' );
		$b64image = base64_encode(file_get_contents($image_logo[0]));?>
   		<style type="text/css">
            .login h1 a {
                background-image: url(<?php print(get_theme_mod('login_logo')); ?>);
               -webkit-background-size: 200px;
				background-size: 200px;
				height: 150px;
				width: 200px;
            }
            body.login {
                background-color: <?php echo get_theme_mod( 'login_bg_color', '#f1f1f1'); ?> !important; }
        </style>
        
 <?php
elseif( has_custom_logo() ) :
    	$custom_logo_id = get_theme_mod( 'custom_logo' );
		$image_logo = wp_get_attachment_image_src( $custom_logo_id , 'small' );
		$b64image = base64_encode(file_get_contents($image_logo[0]));?>
        <style type="text/css">
            .login h1 a {
                background-image: url(<?php echo esc_url( $image_logo[0] ); ?>);
				-webkit-background-size: 200px;
				background-size: 200px;
				height: 150px;
				width: 200px;
            }
            body.login {
                background-color: <?php echo get_theme_mod( 'login_bg_color', '#f1f1f1'); ?> !important; }
        </style>
       <?php
endif;
}
add_action( 'login_head', 'wpdev_filter_login_head', 100 );


/*Remove WordPress logo and menu from admin bar*/
add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );
function remove_wp_logo( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'wp-logo' );
}

// Breadcrumbs
function get_breadcrumb() {
       
    // Settings
    $separator          = '&gt;';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs';
    $home_title         = 'Home';
      
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'product_cat';
       
    // Get the query & post information
    global $post,$wp_query;
       
    // Do not display on the homepage
    if ( !is_front_page() ) {
       
        // Build the breadcrums
        echo '<ul id="' . $breadcrums_id . '" class=" font-sm ' . $breadcrums_class . '">';
           
        // Home page
        echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
        echo '<li class="separator separator-home"> ' . $separator . ' </li>';
           
        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
              
            echo '<li class="item-current item-archive"><span class="bread-current bread-archive">' . post_type_archive_title($prefix, false) . '</span></li>';
              
        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
              
            }
              
            $custom_tax_name = get_queried_object()->name;
            echo '<li class="item-current item-archive"><span class="bread-current bread-archive">' . $custom_tax_name . '</span></li>';
              
        } else if ( is_single() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
              
            }
              
            // Get post category info
            $category = get_the_category();
             
            if(!empty($category)) {
              
                // Get last category post is in
                $last_category = end(array_values($category));
                  
                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);
                  
                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">'.$parents.'</li>';
                    $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
                }
             
            }
              
            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                   
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;
               
            }
              
            // Check if the post is in a category
            if(!empty($last_category)) {
                echo $cat_display;
                echo '<li class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</span></li>';
                  
            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                  
                echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
                echo '<li class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</span></li>';
              
            } else {
                  
                echo '<li class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</span></li>';
                  
            }
		 
        } else if ( is_category() ) {
			if ( isset( $wp_query->query_vars['category_name'] ) ) {	
				if( 'physicians' == $wp_query->query_vars['category_name'] ){
					$fad_title = $wp_query->query_vars['category_name'].' Directory'; 
					// Paginated archives
					echo '<li class="item-current item-current-'.$wp_query->query_vars['category_name'].'"><span class="bread-current bread-current-'.$wp_query->query_vars['category_name'].'" title="">Physician Directory</span></li>';
				}
			}else{
				// Category page
				echo '<li class="item-current item-cat"><span class="bread-current bread-cat">' . single_cat_title('', false) . '</span></li>';
			}      
            
        } else if ( is_page() ) {   
			
            // Standard page
            if( $post->post_parent ){
                   
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                   
                // Get parents in the right order
                $anc = array_reverse($anc);
                   
                // Parent page loop
                if ( !isset( $parents ) ) $parents = null;
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                    $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                }
                   
                // Display parent pages
                echo $parents;
                   
                // Current page
                echo '<li class="item-current item-' . $post->ID . '"><span title="' . get_the_title() . '"> ' . get_the_title() . '</span></li>';
                   
            } else {
                   
                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</span></li>';
                   
            }        
        } else if ( is_tag() ) {
               
            // Tag page
               
            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;
               
            // Display the tag name
            echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><span class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</span></li>';
           
        } elseif ( is_day() ) {
               
            // Day archive
               
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';
               
            // Day display
            echo '<li class="item-current item-' . get_the_time('j') . '"><span class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</span></li>';

        } else if ( is_month() ) {

               
            // Month Archive
               
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><span class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</span></li>';
               
        } else if ( is_year() ) {
               
            // Display year archive
            echo '<li class="item-current item-current-' . get_the_time('Y') . '"><span class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</span></li>';
               
        } else if ( is_author() ) {
               
            // Auhor archive
               
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );
               
            // Display author name
            echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><span class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</span></li>';
           
        } else if ( get_query_var('paged') ) {
               
            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . '"><span class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</span></li>';
               
        } else if ( is_search() ) {
           
            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '"><span class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</span></li>';
           
        } elseif ( is_404() ) {
               
            // 404 page
            echo '<li>' . 'Error 404' . '</li>';
        }
       
        echo '</ul>';
           
    }
       
}

//Create a metabox for pages
/**
 * Create the metabox
 * @link https://developer.wordpress.org/reference/functions/add_meta_box/
*/
add_action( 'add_meta_boxes', 'meta_below_content' );
function meta_below_content()
{
    add_meta_box( 'below-content-id', 'Below Main Content', 'meta_box_callback', 'page', 'normal', 'default' );
}

function meta_box_callback( $post )
{
    $values = get_post_custom( $post->ID );
    $selected = isset( $values['meta_below_content_embed'] ) ? $values['meta_below_content_embed'][0] : '';

    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
    ?>
    <p><label for="meta_below_content_embed"><p>Below Content Field</p></label>
        <textarea name="meta_below_content_embed" id="meta_below_content_embed" cols="62" rows="5" ><?php echo $selected; ?></textarea>
    </p>
    <?php   
}

add_action( 'save_post', 'meta_below_content_save' );
function meta_below_content_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;

    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;

    // now we can actually save the data
    $allowed = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchords can only have href attribute
        )
    );

    // Probably a good idea to make sure your data is set

    if( isset( $_POST['meta_below_content_embed'] ) )
        update_post_meta( $post_id, 'meta_below_content_embed', $_POST['meta_below_content_embed'] );

}

add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false );
        } elseif ( is_author() ) {
            $title = '<span class="vcard">' . get_the_author() . '</span>' ;
        }
    return $title;

});

function hmg_article_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'hmg_article_excerpt_length' );

//remove width and hieght attributes from images inserted via get_the_post_thumbnail() 
add_action( 'init', 'get_id_by_slug' );

function remove_img_attr ($html) {
    return preg_replace('/(width|height)="\d+"\s/', "", $html);
}

add_filter( 'post_thumbnail_html', 'remove_img_attr' );

add_filter('the_seo_framework_pre_add_title', 'change_the_title');
function change_the_title() {
    global $wp;
    if( isset( $wp->query_vars['category_name'] ) ){
        if( 'physicians' == $wp->query_vars['category_name'] ){
            $title = $wp->query_vars['category_name'].'Directory'; 
            return $title;

        }
    }
}

require_once('utility-functions.php');