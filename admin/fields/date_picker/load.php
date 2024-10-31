<?php

function date_picker_field() {

    // date picker field
    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');

  }
 add_action( 'admin_enqueue_scripts', 'date_picker_field' );
