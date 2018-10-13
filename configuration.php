<?php 
/**
***************************************************************
* PaniCode v2.0-2018
* 
* Filename : configuration.php
*
* @author Alin Koko Mansuby < alinkokomansuby@gmail.com >
* @version 2.0-2018
* @copyright 2018 (c) alinko.id
* @license The MIT License (MIT)
*
***************************************************************
*/

$config = [];

$config['path']['includes']  = 'pc_includes/';
$config['path']['modules']   = 'pc_includes/pc_modules/';
$config['path']['views'] 	 = 'pc_includes/pc_views/';
$config['path']['class']	 = 'pc_includes/pc_class/';
$config['path']['admin']	 = 'pc_admin/';

$config['url']['base']		 = 'http://127.0.0.1:5758/';
$config['url']['admin']		 = 'http://127.0.0.1:5758/pc_admin/';
$config['url']['module']	 = 'm'; // $_GET['m'];
$config['url']['page']   	 = 'p'; // $_GET['p'];
$config['url']['id']		 = 'id'; // $_GET['id'];


$config['db']['hostname']    = 'localhost';
$config['db']['username']	 = 'root';
$config['db']['password']    = 'koko';
$config['db']['database']    = 'panicode';


$config['route']['default']  = 'AppMain';
$config['route']['static_header'] = '';
$config['route']['static_footer'] = '';
$config['route']['static_sidebar'] = '';

// Except. kecuali

$config['route']['except_header'] = ['auth'];
$config['route']['except_footer'] = ['auth'];
$config['route']['except_sidebar'] = ['auth'];


if(file_exists(__DIR__.'/'.$config['path']['class'].'/config.pclass.php'))
{
	require_once(__DIR__.'/'.$config['path']['class'].'/config.pclass.php');
	$conf = new Config($config);

}else{
	print __DIR__.'/'.$config['path']['class'].'/config.class.php : Not found';
	exit;
}


