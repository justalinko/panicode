<?php 
/**
***************************************************************
* PaniCode v2.0-2018
* 
* Filename : config.pclass.php
*
* @author Alin Koko Mansuby < alinkokomansuby@gmail.com >
* @version 2.0-2018
* @copyright 2018 (c) alinko.id
* @license The MIT License (MIT)
*
***************************************************************
*/

Class Config{

	public static $conf;
	public function __construct($config)
	{
		self::$conf=$config;
	}
	public function path_includes($file)
	{
		$files=dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR.self::$conf['path']['includes'].'/'.$file.'.php';

		if(file_exists($files))
		{
			return $files;
		}else{
			exit('File : '.$files.' Not found');
		}
	}

	public function path_class($file)
	{
		$files=dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR.self::$conf['path']['class'].'/'.$file.'.pclass.php';

		if(file_exists($files))
		{
			return $files;
		}else{
			exit('File : '.$files.' Not found');
		}
	}

	public function path_views($file){
		$files=dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR.self::$conf['path']['views'].'/'.$file.'.pview.php';

		if(file_exists($files))
		{
			return $files;
		}else{
			exit('File : '.$files.' Not found');
		}
	}

	public function path_modules($file){
		$files=dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR.self::$conf['path']['modules'].'/'.$file.'.pmodule.php';

		if(file_exists($files))
		{
			return $files;
		}else{
			exit('File : '.$files.' Not found');
		}
	}

	public function base_url($dir='/')
	{
		return self::$conf['url']['base'].$dir;
	}
	public function base_admin($dir='/')
	{
		return self::$conf['url']['admin'].$dir;
	}

	public function empty_page()
	{
		return @empty($_GET[''.self::$conf['url']['page'].'']);
	}
	public function empty_module()
	{
		return @empty($_GET[''.self::$conf['url']['module'].'']);
	}
	public function eq_page($get)
	{
		if(@$_GET[''.self::$conf['url']['page'].''] == $get)
		{
			return true;
		}else{
			return false;
		}
	}

	public function eq_module($get)
	{
		if(@$_GET[''.self::$conf['url']['module'].''] == $get)
		{
			return true;
		}else{
			return false;
		}
	}
	public function get_page()
	{
		return @$_GET[''.self::$conf['url']['page'].''];
	}

	public function get_module()
	{
		return @$_GET[''.self::$conf['url']['module'].''];
	
	}
	public function get_id($id)
	{
		return abs(@$_GET[''.self::$conf['url']['id'].'']);
	}
}

?>