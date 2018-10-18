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

Class Modules extends PaniCode{

	public static $submenulist = ['1' => 'Create empty modules',
								 '2' => 'Create CRUD modules',
								 '3' => 'Create Auth modules',
								 '4' => 'Create empty modules without views',
								 '5' => 'Delete modules',
								 '6' => 'Module lists'];
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

	public function subaction()
	{
		if(self::$select == '1')
		{
			self::ask('Module Name');
			$name=self::$select;
			$filename=[self::$cfg['path']['modules'].$name.'.pmodule.php',self::$cfg['path']['views'].$name.'.pview.php'];
			$content=[Template::emptytemp('modules'),Template::viewsempty()];
			if(self::create_file($filename,$content))
			{
				self::message(1);
			}else{
				self::message(0);
			}
		}elseif(self::$select == '2')
		{
			self::ask('Module Name');
			$name=self::$select;
			$filename=[self::$cfg['path']['modules'].$name.'.pmodule.php',self::$cfg['path']['views'].$name.'.pview.php'];
			$content=[Template::modules_crud(),Template::views_crud()];
			if(self::create_file($filename,$content))
			{
				self::message(1);
			}else{
				self::message(0);
			}
		}elseif(self::$select == '3')
		{
			self::ask('Modules Name');
			$name=self::$select;
			$filename=[self::$cfg['path']['modules'].$name.'.pmodule.php',self::$cfg['path']['views'].$name.'.pview.php'];
			$content=[Template::modules_auth(),Template::views_auth()];
			if(self::create_file($filename,$content))
			{
				self::message(1);
			}else{
				self::message(0);
			}
		}elseif(self::$select == '4')
		{
			self::ask('Module Name');
			$name=self::$select;
			$filename=[self::$cfg['path']['modules'].$name.'.pmodule.php'];
			$content=[Template::emptytemp('modules')];
			if(self::create_file($filename,$content))
			{
				self::message(1);
			}else{
				self::message(0);
			}
		}elseif(self::$select == '5')
		{
			self::ask('Module Name');
			$name=self::$select;
			echo "[+] Removing modules $name ...".PHP_EOL;
			if(@unlink(self::$cfg['path']['modules'].$name.'.pmodule.php'))
			{
				self::message(1);
			}else{
				self::message(0);
			}
			echo "[+] Removing views $name ...".PHP_EOL;
			if(@unlink(self::$cfg['path']['views'].$name.'.pview.php'))
			{
				self::message(1);
			}else{
				self::message(0);
			}
		}elseif(self::$select == '6')
		{
			$dir=scandir(self::$cfg['path']['modules']);
			echo PHP_EOL.PHP_EOL;
			echo "+------------[ MODULE LIST ]------------+".PHP_EOL;
			foreach($dir as $mod)
			{if($mod=='.'||$mod=='..'||preg_match("/^.ht|index/",$mod))continue;
				$getname = explode(".pmodule.php",$mod);

				echo $getname[0]."      :  ".self::$cfg['path']['modules'].$mod;
				if(file_exists(self::$cfg['path']['views'].$getname[0].'.pview.php'))
				{
					echo " ( Views : ".self::$cfg['path']['views'].$getname[0].".pview.php ) ".PHP_EOL; 
				}else{
					echo " ( View not found on this module )".PHP_EOL;
				}
			}
			echo PHP_EOL.PHP_EOL;

		}
	}

}



Modules::panic_now();