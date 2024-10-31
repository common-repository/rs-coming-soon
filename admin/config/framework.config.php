<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK SETTINGS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$settings           = array(
  'menu_title'      => 'RS Coming Soon',
  'menu_type'       => 'menu', // menu, submenu, options, theme, etc.
  'menu_slug'       => 'rs-coming-soon',
  'menu_position'       => 870,
  'ajax_save'       => true,
  'show_reset_all'  => false,
  'framework_title' => 'RS Coming Soon Settings',
);

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options        = array();

// ----------------------------------------
// a option section for options overview  -
// ----------------------------------------
$options[]      = array(
  'name'        => 'overwiew',
  'title'       => 'Overview',
  'icon'        => 'fa fa-star',

  // begin: fields
  'fields'      => array(

    // begin: a field
    array(
      'id'      => 'rs_name',
      'type'    => 'text',
      'title'   => 'Name',
      'desc'    => 'leave it blank if you do not want',
      'default'   => 'RS Coming Soon',
    ), 

     array(
      'id'      => 'rs_title',
      'type'    => 'text',
      'title'   => 'Title',
      'desc'    => 'leave it blank if you do not want',
      'default'   => 'We are coming soon!!!',
    ),

     array(
      'id'      => 'rs_subs_title',
      'type'    => 'text',
      'title'   => 'Subscribe Text',
      'desc'    => 'leave it blank if you do not want',
      'default'   => 'Subscribe To Get Notified',
    ),

     array(
      'id'      => 'rs_facebook',
      'type'    => 'text',
      'title'   => 'Facebook link',
      //'desc'    => 'leave it blank if you do not want',
    ),

     array(
      'id'      => 'rs_twitter',
      'type'    => 'text',
      'title'   => 'Twitter link',
      //'desc'    => 'leave it blank if you do not want',
    ),

     array(
      'id'      => 'rs_linkedin',
      'type'    => 'text',
      'title'   => 'Linkedin link',
      //'desc'    => 'leave it blank if you do not want',
    ),

     array(
      'id'      => 'rs_pinterest',
      'type'    => 'text',
      'title'   => 'Pinterest link',
      //'desc'    => 'leave it blank if you do not want',
    ),


  ), // end: fields
);



CSFramework::instance( $settings, $options );
