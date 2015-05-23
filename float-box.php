<?php
/*
 * Plugin Name: Float Box
 * Description: Non-distracting popup box that floats on your page.
 * Version: 0.0.1
 * Author: Pluginaxinstruments
 * Author URI: https://github.com/paxinstruments
 * Plugin URI: https://github.com/paxinstruments/float-box
 * GitHub Plugin URI: https://github.com/paxinstruments/float-box
 * License: GPL2
*/

define( 'FLOATBOX_PATH', plugin_dir_path( __FILE__ ) );

require_once( __DIR__ . '/lib/admin.php' );
require_once( __DIR__ . '/lib/floatbox.php' );


$float_box_admin = new FloatBoxAdmin();
$float_box = new FloatBox();


register_activation_hook( __FILE__, array( $float_box, 'install' ) );

?>