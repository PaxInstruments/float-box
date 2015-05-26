<?php
require('../../../../wp-blog-header.php');
header('Content-type: text/css');   
$options = get_option("floatbox");
if(isset($options['floatbox-style'])) print $options['floatbox-style'];

?>