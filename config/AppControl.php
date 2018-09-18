<?php 

$not_included_config_file = [
							$_SERVER['PHP_SELF'], // AppControl.php
							'.',
							'..',
							'index.php',
							'index.html',
							'index.html',
							'.htaccess',

							]; // File blacklist to not included config file.


$CONFIG = array(); 

/** config path **/
$CONFIG['path']['config'] 	= 'config/';
$CONFIG['path']['class'] 	= 'class/';
$CONFIG['path']['includes']	= 'includes/';
$CONFIG['path']['modules']	= 'includes/modules/';

//** end *//


$SCANPATH = scandir($CONFIG['path']['config']);


foreach($SCANPATH as $inc_file)
{
	if(in_array($inc_file,$not_included_config_file))continue;

	require_once $inc_file;
}
?>