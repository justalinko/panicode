<?php 
@session_start();

require './config/AppControl.php';

spl_autoload_register(function($class_name)
{
	require_once './class/'.$class_name.'.php';
});

$core = new Core_ko;
$db	  = new DB_ko;

// Call database connection file if exist

if(file_exists('db-config.panicode.php'))
{
	require_once 'db-config.panicode.php';
}
// Declare new class html_helper 
$html = new html_helper;
// Generated date : Sat,22 Sep 2018 03:30:16

// Declare new class fedoracss_helper 
$fedoracss = new fedoracss_helper;
// Generated date : Tue,25 Sep 2018 10:45:31
