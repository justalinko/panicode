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

Class Database extends PaniCode_{

	public function PanicNow()
	{
		self::SubActionList();
		self::Selection();
		self::SubTakeAction();
	}
	public function SubActionList()
	{
		echo PHP_EOL;
		self::$ActionList = ['Create connection','Crate database','Import database'];
		$n=1;
		foreach(self::$ActionList as $list)
		{
			echo "[".$n++."] ".$list.PHP_EOL;
		}
		echo PHP_EOL;

	}
	public function SubTakeAction()
	{
		$a=self::$readLine;
		if($a=='1')
		{
			echo "Hostname ::";$host=trim(fgets(STDIN));
			echo "Username ::";$user=trim(fgets(STDIN));
			echo "Password ::";$pass=trim(fgets(STDIN));
			echo "DB Name  ::";$dbname=trim(fgets(STDIN));
			echo PHP_EOL;
			echo "[!] Checking connection to database ...";
			if(@mysqli_connect($host,$user,$pass,$dbname))
			{
				echo "[!] Connected ! ".PHP_EOL;
			}else{
				echo "Error.".PHP_EOL;
				exit;
			}
			if(@file_put_contents('db-config.panicode.php',Template::header('db-config.panicode.php').Template::create_dbconnection($host,$user,$pass,$dbname)))
			{
				self::Message('success');
			}else{
				self::Message('failed');
			}
		}
	}
}

Database::PanicNow();
?>