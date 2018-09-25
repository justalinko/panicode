<?php 
/**
* [ Panicode v1.0 ] 
* 
* 
*
* @author Alin Koko Mansuby < alinkokomansuby@gmail.com >
* @version 1.0
* @copyright 2018 alinko.id
*
*
*/


if(!empty($CONFIG['route']['static_header'])){
	require_once $CONFIG['route']['base_dir'].$CONFIG['route']['static_header'].'.php';
}
if(!empty($CONFIG['route']['static_sidebar']))
{
	require_once $CONFIG['route']['base_dir'].$CONFIG['route']['static_sidebar'].'.php';
}

if($CONFIG['url']['ep'])
{
	
	require_once $CONFIG['route']['base_dir'].$CONFIG['route']['default'].'.php';
}else{

	if(file_exists($CONFIG['path']['modules'].$CONFIG['url']['p'].'.php'))
	{
		require_once $CONFIG['path']['modules'].$CONFIG['url']['p'].'.php';
	}else{
		exit('Halaman 404 ');
	}
}

if(!empty($CONFIG['route']['static_footer'])){
	require_once $CONFIG['route']['base_dir'].$CONFIG['route']['static_footer'].'.php';
}

?>