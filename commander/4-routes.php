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


Class Routes extends PaniCode_{

	public function PanicNow()
	{
		self::SubActionList();
		self::Selection();
		self::SubTakeAction();
	}
	public  function SubActionList()
	{
		echo PHP_EOL;
		self::$ActionList = ['Default routes','Header static','Sidebar static','Footer static','Base Dir'];
		$n=1;
		foreach(self::$ActionList as $list)
		{
			echo "[".$n++."] ".$list.PHP_EOL;
		}
		echo PHP_EOL;
	}
	public function SubTakeAction()
	{
		require 'config/route.php';
		
		$a=self::$readLine;
		if($a == '1')
		{
			echo "Set default routes ::";$route=trim(fgets(STDIN));
			$droute=$CONFIG['route']['default'];
			$rr=str_replace($droute,$route,@file_get_contents('config/route.php'));
			if(@file_put_contents('config/route.php',$rr))
			{
				self::Message('success');
			}else{
				self::Message('failed');
			}
		}elseif($a == '2')
		{
			if(empty($CONFIG['route']['header_static']))
			{
				echo "[!] config : header_static , masih kosong anda harus mengisi nya secara manual.";
				self::console('nano ./config/route.php');
			}
		}
	}
}
Routes::PanicNow();
?>