<?php 
/**
***************************************************************
* PaniCode v2.0-2018
* 
* Filename : autoloader.php
*
* @author Alin Koko Mansuby < alinkokomansuby@gmail.com >
* @version 2.0-2018
* @copyright 2018 (c) alinko.id
* @license The MIT License (MIT)
*
***************************************************************
*/

session_start();

if(file_exists(__DIR__.'/configuration.php')){

require_once(__DIR__.'/configuration.php');

}else{
	echo "<meta http-equiv='refresh' content='0;url=install.panicode.php?m=view'/>";
}
spl_autoload_register(function($class)
{
	require_once(Config::path_class($class));
});

$core = new Core_ko;

$db = new DB_ko($config['db']);
