<?php 
@session_start();

require './config/AppControl.php';

spl_autoload_register(function($class_name)
{
	require_once 'class/'.$class_name.'.php';
});

$core = new Core_ko;
$db	  = new DB_ko;

// Call database connection file if exist

if(file_exists('db-config.panicode.php'))
{
	require_once 'db-config.panicode.php';
}