<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Field: Date Picker
 *
 * @since 1.0
 * @version 1.0
 *
 */


class CSFramework_Option_date_picker extends CSFramework_Options {

  public function __construct( $field, $value = '', $unique = '' ) {
    parent::__construct( $field, $value, $unique );
  }

  public function output(){

    echo $this->element_before();
    echo '<input type="text" name="'. $this->element_name() .'" value="'. $this->element_value() .'"'. $this->element_class( 'cs_date' ) . $this->element_attributes() .'/>';
    echo $this->element_after();

    echo '<script>

					jQuery(document).ready(function() {
					    jQuery(".cs_date").datepicker({
					        dateFormat : "dd-mm-yy"
					    });
					});

			</script>';

  }

}
