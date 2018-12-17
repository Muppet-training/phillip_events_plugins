<?php
/**
 * Plugin Name: Directory - Phillip Island Time
 * Plugin URI: http://xenus.com.au
 * Description: Inserts the customer post type form to add listings into the Phillip Island Time Theme
 * Author: Xenus
 * Author URI: http://xenus.com.au
 * Version: 0.0.1
 * Lisence: GPLv2
 */

 // Exit if accessed directly
 if(!defined('ABSPATH')){
   exit;
 }

 require_once (plugin_dir_path(__FILE__) . 'dir-cpt.php');
 require_once (plugin_dir_path(__FILE__) . 'dir-fields.php');

 function phillip_admin_dir_enqueue_scripts(){
    global $pagenow, $typenow;

    if(($pagenow == 'post.php' || $pagenow == 'post-new.php') && $typenow == 'listing'){
      wp_enqueue_style('dir_admin_css', plugins_url('css/admin-dir.css', __FILE__));
      // wp_enqueue_script('phillip-custom-quicktags', plugins_url('js/custom-quicktags.js', __FILE__), array('quicktags'), '20181203', true);
      
      wp_enqueue_style('bootstrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css');
      wp_enqueue_style('bootstrap-theme-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css');
      wp_enqueue_script('dir_admin_js', plugins_url('js/admin-dir.js', __FILE__), array(), '20181203', false); 

      // wp_enqueue_style('datetimepicker-css', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css');
      // wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
      // wp_enqueue_script('bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js', array(), '3.3.5', false);
      // wp_enqueue_script('bootstrap-datepicker-js', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js', array(), '4.17.37', false);
    }
 }
 add_action('admin_enqueue_scripts', 'phillip_admin_dir_enqueue_scripts');








