<?php

if(Config::empty_page())
{
	require_once(Config::admin_modules($config['route']['default_admin']));
	require_once(Config::admin_views($config['route']['default_admin']));
}else{

	require_once(Config::admin_modules(Config::get_page()));
	require_once(Config::admin_views(Config::get_page()));
}