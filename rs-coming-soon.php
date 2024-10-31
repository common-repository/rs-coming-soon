<?php
/*
Plugin Name: RS Coming Soon
Plugin URI: http://themebon.com/rs-coming-soon/
Description: RS Coming Soon plugin Creates a page for your Website while it's under construction and collects emails from your visitors and show in dashboard.
Author: Noor-E-Alam
Author URI: http://themebon.com/rs-coming-soon/
Version: 1.0.5
*/



if ( ! defined( 'ABSPATH' ) ) exit;



define('rs_dir_path', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );

//Loading CSS and JS
function rs_coming_soon_styles() {



    wp_enqueue_style('bootstrap_css', rs_dir_path. 'assets/css/bootstrap.min.css');
    wp_enqueue_style('style_css', rs_dir_path. 'assets/css/styles.css');



    wp_enqueue_script( 'jquery' );
	wp_enqueue_script('custom', rs_dir_path. 'assets/js/custom.js' , array('jquery'), '', true);
    

}

add_action( 'wp_enqueue_scripts', 'rs_coming_soon_styles' );


require_once 'admin/cs-framework.php';


function admin_css_add() {
   echo '<style type="text/css">
			.rs_cs_active {background-color: green !important;}
         </style>';
	}

add_action('admin_head', 'admin_css_add');



// Left Menu Button
function rscs_register_coming_soon_menu() {
    add_menu_page('RS Subscriber', 'RS Subscriber', 'add_users', dirname(__FILE__).'/proccess.php', '',   plugins_url('assets/images/rscs_icon.png', __FILE__), 871);


}
add_action('admin_menu', 'rscs_register_coming_soon_menu');



//Coming soon activation
function rscs_protocol() {
	if(isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&  $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'){
		return 'https://';
	}
	return 'http://';
}

add_action('init', 'rscs_coming_soon');
function rscs_coming_soon(){
    if( is_admin() || current_user_can( 'manage_options' ) || in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php')) )return;
 
    $current_uri = rscs_protocol().$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	
    if($current_uri != get_option('siteurl').'/' && $current_uri != get_option('siteurl')){
    	header( 'Location: ' . get_option('siteurl') );
    	exit;
    }
	
	include 'rs-coming-soon-display.php';
	
    exit();
}




/**
* Display admin bar when active
*/

function rs_admin_bar(){
    global $wp_admin_bar;

    /* Add the main siteadmin menu item */
        $wp_admin_bar->add_menu(array(
        	'id'     => 'debug-bar',
            'href' => admin_url().'admin.php?page=RSComingSoon&tab=1',
            'parent' => 'top-secondary',
            'title'  => apply_filters( 'debug_bar_title', __('Coming Soon Activated', 'rs-coming-soon-page') ),
            'meta'   => array( 'class' => 'rs_cs_active' ),
        ));

}

add_action( 'admin_bar_menu',  'rs_admin_bar');



// Plugin Activation
function rscs_install() {
    global $wpdb;
    $table = $wpdb->prefix."rscs";
    $structure = "CREATE TABLE $table (
        id INT(9) NOT NULL AUTO_INCREMENT,
        rscs_email VARCHAR(200) NOT NULL,
    UNIQUE KEY id (id)
    );";
    $wpdb->query($structure);
    
}
register_activation_hook( __FILE__, 'rscs_install' );


// loading this for nonce check
require_once(ABSPATH .'wp-includes/pluggable.php');



// Generate Subscribe Form 

function rs_subs_form(){

	
    $thankyou = 'Thanks! you are in list and will get notified as soon as we finish';
    
    $return = '<form action="" method="post">';


    $return .= '<input type="hidden" name="rscs_subscribe"  value="1">';
    
    
    if ($_POST['rscs_subscribe']) { 

           $return .= "<script>window.onload = function() { alert('".$thankyou."'); }</script>";
    }
    
    $return .= '<p><input class="rs_email" name="rscs_email" required placeholder="Enter your e-mail" type="email" id=""/>';

    $return .= '<input class="rs_submit" type="submit" value="Submit"/></p>';

    $return .= wp_nonce_field( 'rscs_nonce' );

    $return .= '</form>';
    
    return $return;
}


// Handle form Post
if (isset($_POST['rscs_subscribe']) && $_POST['rscs_subscribe'] == 1) {

		check_admin_referer('rscs_nonce');
		

		$email = sanitize_email( $_POST['rscs_email'] );

	    if (is_email($email)) {
	        
	        $exists = mysql_query("SELECT * FROM ".$wpdb->prefix."rscs where rscs_email like '".$wpdb->escape($email)."' limit 1");
	        if (mysql_num_rows($exists) <1) {
	            $wpdb->query("insert into ".$wpdb->prefix."rscs (rscs_email) values (

	                '".$wpdb->escape($email)."'

	                )");
	        }
	    }

}


?>