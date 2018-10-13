<?php 
/**
***************************************************************
* PaniCode v2.0-2018
* 
* Filename : index.php
*
* @author Alin Koko Mansuby < alinkokomansuby@gmail.com >
* @version 2.0-2018
* @copyright 2018 (c) alinko.id
* @license The MIT License (MIT)
*
***************************************************************
*/



if(file_exists(__DIR__.'/autoloader.php')){
	require_once(__DIR__.'/autoloader.php');
}else{
	print "autoloader.php not found.";
	exit;
}

require_once(Config::path_includes('AppControl'));

?>