<?php 
/**
***************************************************************
* PaniCode v2.0-2018
* 
* Filename : AppControl.php
*
* @author Alin Koko Mansuby < alinkokomansuby@gmail.com >
* @version 2.0-2018
* @copyright 2018 (c) alinko.id
* @license The MIT License (MIT)
*
***************************************************************
*/

if(!empty($config['route']['static_header']) && !in_array(Config::get_page(),$config['route']['except_header']))
{
	require_once(Config::path_views($config['route']['static_header']));
}

if(!empty($config['route']['static_sidebar']) && !in_array(Config::get_page(),$config['route']['except_sidebar']))
{
	require_once(Config::path_views($config['route']['static_sidebar']));
}


if(Config::empty_page())
{
	require_once(Config::path_modules($config['route']['default']));
	require_once(Config::path_views($config['route']['default']));
}else{

	require_once(Config::path_modules(Config::get_page()));
	require_once(Config::path_views(Config::get_page()));
}


if(!empty($config['route']['static_footer']) && !in_array(Config::get_page(),$config['route']['except_footer']))
{
	require_once(Config::path_views($config['route']['static_footer']));
}
