<?php 
/**
* MaFrame Library, useful library for database and php cores.
*
* @version 1.0
* @author Alin Koko Mansuby < alinkokomansuby@gmail.com >
* @copyright 2018
*
*/



Class DB_ko{
	public $config = array();
	public $connection;

	public function __construct($c = array())
	{
		if(is_array($c)){
		$this->connection = mysqli_connect($c['hostname'],$c['username'],$c['password'],$c['database']);
		}
		return $this->connection;
	}

	public function last_id()
	{
		return mysqli_insert_id($this->connection);
	}
	public function query($q)
	{
		$r = mysqli_query($this->connection,$q);
		return $r;
	}
	public function multiselect($table = array(),$where = array())
	{
		$sql = "SELECT * FROM ";
		
		$ctbl = count($table)-1;

		for($i=0;$i<=$ctbl;$i++)
		{
			$sql.=$table[$i];
			if($i != $ctbl)
			{
				$sql.=",";
			}
		}
		$sql.=" WHERE ";
		$cw = count($where)-1;
		$n=0;
		foreach($where as $wh=>$val)
		{
			$sql.= "$wh=$val";
			if($n++ != $cw){
			$sql.=" AND ";
		 	}
		}
		$sql.= "";

		return $this->query($sql);

	}
	public function fetch($a)
	{
		$r = mysqli_fetch_array($a);
		return $r;
	}

	public function assoc($a)
	{
		$r = mysqli_fetch_assoc($a);
		return $r;
	}
	public function count_rows($a)
	{
		$r = mysqli_num_rows($a);
		return $r;
	}
	public function error()
	{
		$r = mysqli_error($this->connection);
		return $r;
	}
	public function select($table,$kolom = '*')
	{
		$sql = "SELECT $kolom FROM $table";
		return $this->query($sql);
	}
	public function select_where($table,$where = array())
	{
		$sql = "SELECT * FROM $table WHERE ";
		$n=0;
		$j=count($where)-1;
		foreach($where as $tb=>$cl)
		{
			$sql.= "$tb='$cl'";
			if($n++ != $j){
			$sql.=" AND ";
		 	}
		}
		$sql.= "";
		#print_r($sql);
		return $this->query($sql);
	}
	
	public function insert($table,$data = array())
	{
		$sql = "INSERT INTO $table VALUES(";
		for ($i=0; $i <= count($data)-1; $i++) { 
			if(empty($data[$i])){
				$val=0;
			}else{
				$val=$data[$i];
			}
		$sql.= "'".$val."'";
	if($i != count($data)-1)
	{
		$sql.= ',';
	}
	}	
	$sql.= ")";
	return $this->query($sql);
	}


	public function update($table,$set = array(),$where=array())
	{
		$sql = "UPDATE $table SET ";
		$j = count($set)-1;
		$n = 0;
		foreach($set as $col=>$val)
		{
			$sql.="$col='$val'";
		if($n++ != $j){
		$sql.=",";}
		}
		$n=0;
		$j=count($where)-1;
		foreach($where as $tb=>$cl)
		{
			$sql.= "$tb='$cl'";
			if($n++ != $j){
			$sql.=" AND ";
		 	}
		}
		$sql.= "";
		return $this->query($sql);
	}
	public function delete($table,$where)
	{
		$sql = "DELETE FROM $table WHERE";
		foreach($where as $target=>$value)
		{
			$sql.= " $target='$value' ";
		}
		$sql.= "";
		return $this->query($sql);
	}
	public function query_result($result)
	{
		echo "<table border=\"1\" style=\"margin: 2px;border-collapse:collapse;border:1px solid #888\">".
           "<thead style=\"font-size: 80%\">";
      $numFields = mysqli_num_fields($result);
      // BEGIN HEADER
      $tables    = array();
      $nbTables  = -1;
      $lastTable = "";
      $fields    = array();
      $nbFields  = -1;
      while ($column = mysqli_fetch_field($result)) {
        if ($column->table != $lastTable) {
          $nbTables++;
          $tables[$nbTables] = array("name" => $column->table, "count" => 1);
        } else
          $tables[$nbTables]["count"]++;
        $lastTable = $column->table;
        $nbFields++;
        $fields[$nbFields] = $column->name;
      }
      for ($i = 0; $i <= $nbTables; $i++)
        echo "<th colspan=".$tables[$i]["count"].">".$tables[$i]["name"]."</th>";
      echo "</thead>";
      echo "<thead style=\"font-size: 80%\">";
      for ($i = 0; $i <= $nbFields; $i++)
        echo "<th>".$fields[$i]."</th>";
      echo "</thead>";
      // END HEADER
      while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        for ($i = 0; $i < $numFields; $i++)
          echo "<td>".htmlentities($row[$i])."</td>";
        echo "</tr>";
      }
      echo "</table></div>";
	}
	public function closecon()
	{
		return mysqli_close();
	}
	public function free($data)
	{
		return mysqli_free_result($data);
	}

	public function check_exist($table,$data=array())
	{
		$sql=$this->select_where($table,$data);
		$c=$this->count_rows($sql);

		if($c > 0)
		{
			return true;
		}else{
			return false;
		}

	}
	public function fetch_rows($table)
	{
		$sql = $this->select($table);

		return $this->fetch($sql);
	}
	public function fetch_rows_where($table,$where = array())
	{
		$sql = $this->select_where($table,$where);
		$data = $this->fetch($sql);

		return $data;
	}
	public function fetch_rows_array($table)
	{
		$re=[];
		$sql = $this->select($table);
		while($data=$this->fetch($sql))
		{
			$re[] = $data;
		}
		return $re;
	}
	public function fetch_array_where($table,$where = array())
	{
		$re=[];
		$sql = $this->select_where($table);
		while($data=$this->fetch($sql))
		{
			$re[] = $data;
		}
		return $re;
	}
	public function fetch_custom_array($query)
	{
		$re=[];
		$sql = $this->query($query);
		while($data=$this->fetch($sql))
		{
			$re[]=$data;
		}
		return $re;
	}
}

 ?>