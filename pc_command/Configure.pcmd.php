<?php 
/**
***************************************************************
* PaniCode v2.0-2018
* 
*
* @author Alin Koko Mansuby < alinkokomansuby@gmail.com >
* @version 2.0-2018
* @copyright 2018 (c) alinko.id
* @license The MIT License (MIT)
*
***************************************************************
*/

Class Configure extends PaniCode{

	public static $submenulist = ['1' => 'Config path',
								 '2' => 'Config url',
								 '3' => 'Config DB',
								 '4' => 'Config Route',
								 '5' => 'Private key',
								 '6' => 'Config lists'];
	public function panic_now()
	{
		self::submenu();
		self::ask('Select');
		self::subaction();
	}
	public function submenu()
	{
		foreach(self::$submenulist as $num=>$submenu)
		{
			echo "   [$num]. $submenu".PHP_EOL;
		}
	}
	public function editConfig($old,$new)
	{
		$f = @file_get_contents('configuration.php');
		$c = str_replace($old,$new,$f);
		return @file_put_contents('configuration.php',$c);
	}
	public function conflist($cfg)
	{
		foreach($cfg as $name=>$val)
		{
			echo "[$name]  :: $val".PHP_EOL;
		}
	}
	public function confedit($editap)
	{
			self::conflist(self::$cfg[$editap]);
			self::ask('config name');
			$name=self::$select;
			self::ask('Edit to');
			$edit=self::$select;
			$old=self::$cfg[$editap][$name];
			echo "[+] Replacing $old to $edit ...".PHP_EOL;

			if(self::editConfig($old,$edit))
			{
				self::message(1);
			}else{
				self::message(0);
			}
	}
	public function subaction()
	{
		if(self::$select == '1')
		{
			self::confedit('path');
		}elseif(self::$select == '2')
		{
			self::confedit('url');
		}elseif(self::$select == '3')
		{
			self::confedit('db');

		}elseif(self::$select == '4')
		{
			self::confedit('route');
		}elseif(self::$select == '5')
		{
			echo "Private key not availabe for now.".PHP_EOL;
		}elseif(self::$select == '6')
		{
			$n=0;
			foreach(self::$cfg as $conf=>$list)
			{
				echo "+---------[ ".$conf." ]---------+".PHP_EOL;
				foreach($list as $n=>$li)
				{
					if(is_array($li))
					{
						$li=implode(",",$li);
					}else{
						$li=$li;
					}
					echo "* $n :: $li".PHP_EOL;
				}
				echo PHP_EOL;
			}
		}
	}

}


Configure::panic_now();