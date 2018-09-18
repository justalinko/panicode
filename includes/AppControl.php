<?php 

if(!empty($CONFIG['route']['static_header']) && !empty($CONFIG['route']['static_sidebar'])){
	require_once $CONFIG['path']['includes'].$CONFIG['route']['static_header'];
	require_once $CONFIG['path']['includes'].$CONFIG['route']['static_sidebar'];
}

if($CONFIG['url']['ep'])
{
	require_once $CONFIG['path']['includes'].$CONFIG['route']['default'].'.php';
}else{

	if(file_exists($CONFIG['path']['modules'].$CONFIG['url']['p'].'.php'))
	{
		require_once $CONFIG['path']['modules'].$CONFIG['url']['p'].'.php';
	}else{
		exit('Halaman 404 ');
	}
}

if(!empty($CONFIG['route']['static_footer'])){
	require_once $CONFIG['path']['includes'].$CONFIG['route']['static_footer'];
}

?>