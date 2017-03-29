<?php
/**
* Plugin Name: Podemos Streamings
* Plugin URI: 
* Description: Streamings management system for Podemos websites.
* Version: 0.0
* Author: PODEMOS
* Author URI: https://podemos.info
* License:
*
*
* Required plugins for better performance:
*
*  - Advanced Custom Fields
*    https://es.wordpress.org/plugins/advanced-custom-fields/
*
*  - Advanced Custom Fields: Date and Time Picker
*    https://es.wordpress.org/plugins/acf-field-date-time-picker/
*/

require_once dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'ps_register_streaming_posttype.php';
require_once dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'ps_functions.php';
require_once dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'lib/yt.lib.php';

wp_register_style( 'podemos-streamings', plugins_url( 'podemos-streamings/ps-style.css' ) );
wp_enqueue_style( 'podemos-streamings' );

