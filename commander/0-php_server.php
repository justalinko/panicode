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
Class PHP_Server extends PaniCode_{

	public function PanicNow()
  {
    echo "Port [Enter for default port ]::";$port=trim(fgets(STDIN));
    if(empty($port))
    {
      echo "[!] Running php server http://127.0.0.1:5758".PHP_EOL;
      PaniCode_::console("php -S 127.0.0.1:5758");
    }else{
      echo "[!] Running php server http://127.0.0.1:{$port}".PHP_EOL;
      PaniCode_::console("php -S 127.0.0.1:{$port}");
    }
  }

}

PHP_Server::PanicNow();

?>