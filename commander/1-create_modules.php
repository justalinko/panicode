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
Class Create_Modules extends PaniCode_{

	public function PanicNow()
	{
		self::SubActionList();
		self::Selection();
		self::SubTakeAction();
	}
	public function SubActionList()
	{
		echo PHP_EOL;
		self::$ActionList = ['Empty Modules','CRUD Modules','Auth Modules'];
		$n=1;
		foreach(self::$ActionList as $list)
		{
			echo "[".$n++."] ".$list.PHP_EOL;
		}
		echo PHP_EOL;
	}
	public function SubTakeAction()
	{
		$a = self::$readLine;
		if($a == '1')
		{
			echo "Module name ::"; $mn = trim(fgets(STDIN));
			if(@file_put_contents('includes/modules/'.$mn.'.php',Template::header($mn.'.php')))
			{
				self::Message('success');
			}else{
				self::Message('failed');
				
			}

		}elseif($a == '2')
		{
			echo "Module name ::"; $mn=trim(fgets(STDIN));
			if(@file_put_contents('includes/modules/'.$mn.'.php',Template::header($mn.'.php').Template::crud()))
			{
				self::Message('success');
			}else{
				self::Message('failed');
			}
		}elseif($a == '3')
		{
			echo "Module name ::"; $mn=trim(fgets(STDIN));
			if(@file_put_contents('includes/modules/'.$mn.'.php',Template::header($mn.'.php').Template::auth()))
			{
				self::Message('success');
			}else{
				self::Message('failed');
			}
		}
	}
}


Create_Modules::PanicNow();
?>