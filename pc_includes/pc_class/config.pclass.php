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
	public function path_admin()
	{
		return self::$conf['path']['admin'];
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
	public function get_id()
	{
		return abs(@$_GET[''.self::$conf['url']['id'].'']);
	}

		public function admin_includes($file)
	{
		$files=dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR.self::path_admin().'/includes/'.$file.'.php';

		if(file_exists($files))
		{
			return $files;
		}else{
			exit('File : '.$files.' Not found');
		}
	}

	public function admin_class($file)
	{
		$files=dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR.self::path_admin().'/class/'.$file.'.pclass.php';

		if(file_exists($files))
		{
			return $files;
		}else{
			exit('File : '.$files.' Not found');
		}
	}

	public function admin_views($file){
		$files=dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR.self::path_admin().'/includes/views/'.$file.'.pview.php';

		if(file_exists($files))
		{
			return $files;
		}else{
			exit('File : '.$files.' Not found');
		}
	}

	public function admin_modules($file){
		$files=dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR.self::path_admin().'/includes/modules/'.$file.'.pmodule.php';

		if(file_exists($files))
		{
			return $files;
		}else{
			exit('File : '.$files.' Not found');
		}
	}
	public function admin_action($perms = ['r','e','d'],$page,$id)
	{
		$base_admin = self::base_admin();
		$url=$base_admin.'?p='.$page.'&m=';
		$temp = '<div class="hidden-sm hidden-xs action-buttons">';
		if(in_array('r',$perms)){
		$temp.='<a class="blue" href="'.$url.'view&id='.$id.'"><i class="ace-icon fa fa-eye bigger-130"></i></a>';
		}
		if(in_array('e',$perms)){
		$temp.='<a class="green" href="'.$url.'edit&id='.$id.'"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
		}
		if(in_array('d',$perms)){
		$temp.='<a class="red" href="'.$url.'delete&id='.$id.'"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>';
		}
		$temp.='</div>';
		$temp.='<div class="hidden-md hidden-lg">';
		$temp.='<div class="inline pos-rel">';
		$temp.='<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">';
		$temp.='<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>';
		$temp.='</button><ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">';
		if(in_array('r',$perms)){
		$temp.='<li><a href="'.$url.'view&id='.$id.'" class="tooltip-info" data-rel="tooltip" title="View"><span class="blue"><i class="ace-icon fa fa-eye bigger-120"></i></span></a></li>';
		}
		if(in_array('e', $perms)){
		$temp.='<li><a href="'.$url.'edit&id='.$id.'" class="tooltip-success" data-rel="tooltip" title="Edit"><span class="green"><i class="ace-icon fa fa-pencil-square-o bigger-120"></i></span></a></li>';
		}
		if(in_array('d',$perms)){
		$temp.='<li><a href="'.$url.'delete&id='.$id.'" class="tooltip-error" data-rel="tooltip" title="Delete"><span class="red"><i class="ace-icon fa fa-trash-o bigger-120"></i></span></a></li>';
		}
$temp.='</ul>
</div>
</div>';

return $temp;
	}

	public function BuildMenu($url,$parent,$menu)
	{
		//
	}
}

?>