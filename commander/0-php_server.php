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


	public function serve()
	{
		echo "[!] Connect : http://127.0.0.1:5758  ".PHP_EOL;
		self::console("php -S 127.0.0.1:5758");
	}
	public function console($cmd)
	{
if(function_exists('system')) {     
    @ob_start();    
    @system($cmd);    
    $c = @ob_get_contents();    
    @ob_end_clean();    
    return $c;  
  } elseif(function_exists('exec')) {     
    @exec($cmd,$results);     
    $c = "";    
    foreach($results as $result) {      
      $c .= $result;    
    } return $c;  
  } elseif(function_exists('passthru')) {     
    @ob_start();    
    @passthru($cmd);    
    $c = @ob_get_contents();    
    @ob_end_clean();    
    return $c;  
  } elseif(function_exists('shell_exec')) {     
    $c = @shell_exec($cmd);     
    return $c;  
  }

}
}

PHP_Server::serve();

?>