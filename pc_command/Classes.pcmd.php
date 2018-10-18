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

Class Classes extends PaniCode{

	public static $submenulist = ['1' => 'Create empty class',
								 '2' => 'Create class from url',
								 '3' => 'Create class from file ',
								 '4' => 'Declare class',
								 '5' => 'Delete classes',
								 '6' => 'Class lists'];
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
	public function DeclareClass($class_name,$var)
	{
		$al = @file_get_contents('autoloader.php');
		$co  = PHP_EOL."// Declare new class $class_name ".PHP_EOL;
		$co .= "\$".$var." = new ".$class_name.";";
		$co .= PHP_EOL."// Generated date : ".date('D,d M Y H:i:s').PHP_EOL; 
		return @file_put_contents('autoloader.php',$al.$co);
	}
	public function subaction()
	{
		if(self::$select == '1')
		{
			self::ask('Class Name');
			$name=self::$select;
			$filename=self::$cfg['path']['class'].$name.'.pclass.php';
			$content=Template::emptytemp('class');
			if(self::create_file($filename,$content))
			{
				self::message(1);
			}else{
				self::message(0);

			}
		}elseif(self::$select == '2')
		{
			self::ask('Source URL');
			$url=self::$select;
			self::ask('Class Name');
			$name=self::$select;
			$content=@file_get_contents($url);
			$filename=self::$cfg['pat']['class'].$name.'.pclass.php';
			if(self::create_file($filename,$content))
			{
				self::message(1);
			}else{
				self::message(0);
			}

		}elseif(self::$select == '3')
		{
			self::ask('File path');
			$url=self::$select;
			self::ask('Class Name');
			$name=self::$select;
			$content=@file_get_contents($url);
			$filename=self::$cfg['pat']['class'].$name.'.pclass.php';
			if(self::create_file($filename,$content))
			{
				self::message(1);
			}else{
				self::message(0);
			}
		}elseif(self::$select == '4')
		{
			self::ask('Class Name');
			$cname=self::$select;
			self::ask('Variable');
			$var=self::$select;

			if(self::DeclareClass($cname,$var))
			{
				self::message(1);
			}else{
				self::message(0);
			}
		}elseif(self::$select == '5')
		{
			self::ask('Class Name');
			$cname=self::$select;
			$filename=self::$cfg['path']['class'].$cname.'.pclass.php';
			echo "[+] Checking class exist ...";
			if(file_exists($filename))
			{
				echo self::colors(2)."[OK]".self::colors(0).PHP_EOL;
				if(@unlink($filename))
				{
					self::message(1);
				}else{
					self::message(0);
				}
			}else{
				echo self::colors(1)."[NO]".self::colors(0);
			}	
		}elseif(self::$select == '6')
		{
			$dir=scandir(self::$cfg['path']['class']);
			echo PHP_EOL.PHP_EOL;
			$num=1;
			echo "+------------[ CLASS LIST ]------------+".PHP_EOL;
			foreach($dir as $mod)
			{if($mod=='.'||$mod=='..'||preg_match("/^.ht|index/",$mod))continue;
				$getname = explode(".pclass.php",$mod);
				echo "[".$num++."]. ".$getname[0]."      :  ".self::$cfg['path']['class'].$mod.PHP_EOL;
			}
			echo PHP_EOL.PHP_EOL;
		}
	}
}


Classes::panic_now();
?>