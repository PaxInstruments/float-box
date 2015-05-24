<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
  exit;
}


delete_option( 'floatbox' );
delete_option( 'floatbox_version' );


?>