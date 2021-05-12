<?php 
/**
 * Plugin Name: Hoag Metadata
 * Plugin URI: 
 * Description: Custom settings used for Pages, Posts, and other custom content type
 * Version: 1.0
 * Author: Hoag Interactive
 * Author URI: 
 */

//loop in the metabox values
require_once(plugin_dir_path( __FILE__ ) . 'include/mixed-metabox.php');
require_once(plugin_dir_path( __FILE__ ) . 'include/page-metabox.php');
require_once(plugin_dir_path( __FILE__ ) . 'include/post-metabox.php');
require_once(plugin_dir_path( __FILE__ ) . 'include/people-metabox.php');
require_once(plugin_dir_path( __FILE__ ) . 'include/dept-metabox.php');
require_once(plugin_dir_path( __FILE__ ) . 'include/publication-metabox.php');
require_once(plugin_dir_path( __FILE__ ) . 'include/app-metabox.php');
require_once(plugin_dir_path( __FILE__ ) . 'include/case-studies-metabox.php');

//remove when done
function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
    ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}