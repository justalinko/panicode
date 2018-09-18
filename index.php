<?php 
/**
* [ Panicode v1.0 ] 
* 
* index.php
* 
*
* @author Alin Koko Mansuby < alinkokomansuby@gmail.com >
* @version 1.0
* @copyright 2018 alinko.id
*
*
*/

// checking file exists.
if(file_exists('autoloader.php'))

{
	require_once 'autoloader.php';
}else{

	die('Error : autoloader file not exists');
}

require_once 'includes/AppControl.php';

?>