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

Class Create_class extends PaniCode_{

	public function PanicNow()
	{
		self::SubActionList();
		self::Selection();
		self::SubTakeAction();
	}
	public  function SubActionList()
	{
		echo PHP_EOL;
		self::$ActionList = ['Empty Class','Get from internet','Get from file'];
		$n=1;
		foreach(self::$ActionList as $list)
		{
			echo "[".$n++."] ".$list.PHP_EOL;
		}
		echo PHP_EOL;
	}
	public function DeclareClass($class_name,$var)
	{
		$al = @file_get_contents('autoloader.php');
		$co  = PHP_EOL."// Declare new class $class_name ".PHP_EOL;
		$co .= "\$".$var." = new ".$class_name.";";
		$co .= PHP_EOL."// Generated date : ".date('D,d M Y H:i:s').PHP_EOL; 
		return @file_put_contents('autoloader.php',$al.$co);
	}
	public function SubTakeAction()
	{
		$a=self::$readLine;

		if($a == '1')
		{
			echo "Class name ::";$nm=trim(fgets(STDIN));
			echo "Variable for declare class ::"; $var=trim(fgets(STDIN));
			self::DeclareClass($nm,$var);

			if(@file_put_contents('class/'.$nm.'.php',Template::header($nm.'.php').Template::emptyClass($nm)))
			{
				self::Message('success');
			}else{
				self::Message('failed');

			}

		}elseif($a == '2')
		{
			echo "Class name ::"; $nm=trim(fgets(STDIN));
			echo "Source URL ::"; $url=trim(fgets(STDIN));
			echo "Variable for declare class ::"; $var=trim(fgets(STDIN));
			self::DeclareClass($nm,$var);
			echo "[!] Downloading in proccess ...";
			$source = @file_get_contents($url);
			if(@file_put_contents('class/'.$nm.'.php',$source))
			{
				self::Message('success');
			}else{
				self::Message('failed');
			}
		}elseif($a == '3')
		{
			echo "Class name ::"; $nm=trim(fgets(STDIN));
			echo "Filepath   ::"; $file=trim(fgets(STDIN));
			echo "Variable for declare class ::"; $var=trim(fgets(STDIN));
			self::DeclareClass($nm,$var);
			echo "[!] Copying {$file} to class/{$nm}.php ...";
			if(@copy($file,'class/'.$nm.'.php'))
			{
				self::Message('success');
			}else{
				self::Message('failed');
			}
		}
	}
}

Create_class::PanicNow()
?>