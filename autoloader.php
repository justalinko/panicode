<?php 
@session_start();

<<<<<<< HEAD

#require 'configuration.php';



=======
>>>>>>> 28da34ea29b4683bb85226ac5858bb422292ba64
require './config/AppControl.php';

spl_autoload_register(function($class_name)
{
	require_once './class/'.$class_name.'.php';
});

$core = new Core_ko;
$db	  = new DB_ko;

<<<<<<< HEAD

=======
// Call database connection file if exist

if(file_exists('db-config.panicode.php'))
{
	require_once 'db-config.panicode.php';
}
>>>>>>> 28da34ea29b4683bb85226ac5858bb422292ba64
// Declare new class html_helper 
$html = new html_helper;
// Generated date : Sat,22 Sep 2018 03:30:16

// Declare new class fedoracss_helper 
$fedoracss = new fedoracss_helper;
// Generated date : Tue,25 Sep 2018 10:45:31
<<<<<<< HEAD

// Call database connection file if exist

if(file_exists('db-config.panicode.php'))
{
	require_once 'db-config.panicode.php';
}
=======
>>>>>>> 28da34ea29b4683bb85226ac5858bb422292ba64
