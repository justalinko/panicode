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


if(!empty($CONFIG['route']['static_header']) && !in_array($get_page,$CONFIG['route']['except_header'])){

	require_once $CONFIG['route']['base_dir'].$CONFIG['route']['static_header'].'.php';
}
if(!empty($CONFIG['route']['static_sidebar']) && !in_array($get_page,$CONFIG['route']['except_sidebar']))
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
		echo "<h1>Not found</h1>";
		echo "<hr>";
		echo "<i>Tidak di temukan ".$CONFIG['path']['modules'].$CONFIG['url']['p'].'.php</i>';
		echo "<br><br>Software powered by : <b>PaniCode v1.0-2018</b>";
		exit;
	}
}

if(!empty($CONFIG['route']['static_footer']) && !in_array($get_page,$CONFIG['route']['except_footer'])){
	require_once $CONFIG['route']['base_dir'].$CONFIG['route']['static_footer'].'.php';
}

?>