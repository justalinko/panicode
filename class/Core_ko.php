<?php 
/**
* MaFrame Library, Usefull library database and much more for php.
*
* @version 1.0
* @author Alin Koko Mansuby < alinkokomansuby@gmail.com >
* @copyright 2018
*
*/



Class Core_ko{
	public $config;
	public $db;
	public function __construct($config = array(),$db = null)
	{
		$this->config = $config;
		$this->db = $db;
		$dissalow_useragent = ['sqlmap','bot','curl'];
		if(preg_match("/".implode("|",$dissalow_useragent)."/",$_SERVER['HTTP_USER_AGENT']))
		{
			exit('Error. || Dissalowed userAgent by : MaFrame Library. (c) '.date('Y')."\n\n");
		}
	}
	public function filter_xss($filter)
	{
		$str = addslashes(stripslashes(strip_tags(htmlspecialchars($filter))));
		return $str;
	}
	public function filter_sqli($id)
	{
		$tolak = ['union','select','group','concat','order by'];
		$p = str_replace(implode("|",$tolak),"",$id);
		$p = abs($id);
		return $p;
	}
	public function create_session($data = array()){
		$np = "";
		if(is_array($data))
		{
			foreach($data as $name => $val)
			{
				$np.= $_SESSION[''.$name.''] = $val;
			}
		}
		return $np;
	}
	public function get_session($name)
	{
		if(empty($_SESSION[''.$name.'']))
		{
			$result = "empty";
		}
		else
		{
			$result = $_SESSION[''.$name.''];
		}

		return $result;
	}
	public function del_session()
	{
		return session_destroy();
	}
	public function hashm($str,$type = 'sha1')
	{
		if($type == 'sha1')
		{
			$h = sha1($str);
		}elseif($type == 'md5')
		{
			$h = md5($str);
		}elseif($type == 'shamd')
		{
			$h = sha1(md5($str));
		}elseif($type == 'mdsha')
		{
			$h = md5(sha1($str));
		}
		return $h;
	}
	public function method_get($name,$empty = false,$isset = false)
	{
		if($isset == true)
		{
			$m = isset($_GET[$name]);
		}elseif($empty == true)
		{
			$m = empty($_GET[$name]);
		}elseif($empty == true && $isset == true )
		{
			$m = isset($_GET[$name]) && empty($_GET[$name]);
		}elseif($empty == false && $isset == false)
		{
			$m = $_GET[$name];
		}else{
			$m = $_GET[$name];
		}
		return $m;
	}
		public function method_post($name,$empty = false,$isset = false)
	{
		if($isset == true)
		{
			$m = isset($_POST[$name]);
		}elseif($empty == true)
		{
			$m = empty($_POST[$name]);
		}elseif($empty == true && $isset == true )
		{
			$m = isset($_POST[$name]) && empty($_POST[$name]);
		}elseif($empty == false && $isset == false)
		{
			$m = $_POST[$name];
		}else{
			$m = $_POST[$name];
		}
		return $m;
	}
	public function export_excel($filename)
	{
	@header("Content-type: application/vnd-ms-excel");
    @header("Content-Disposition: attachment; filename=".$filename);
    // echo $content;
	}
	public function export_word($filename)
	{
	@header("Content-type: application/msword");
	@header("Content-disposition: inline; filename=".$filename);
	}
	public function redirect($kmn,$type = 'php',$delay = 0)
	{
		if($type == 'php'){
		header('location:'.$kmn);
		ob_end_flush();
		}elseif($type == 'js')
		{
		echo "<script>window.location.href='".$kmn."';</script>";
		}elseif($type == 'html'){
		echo "<meta http-equiv='refresh' content='".$delay.";url=".$kmn."'>";
		}
	}
	public function DateMonth($m,$now = false)
	{
		if($now == true)
		{
			$m = ceil(date('m'));
		}else{
			$m = $m;
		}
		switch ($m) {
			case 1:
				$bln = "Januari";
				break;
			case 2:
				$bln = "Februari";
				break;
			case 3:
				$bln = "Maret";
				break;
			case 4:
				$bln = "April";
				break;
			case 5:
				$bln = "Mei";
				break;
			case 6:
				$bln = "Juni";
				break;
			case 7:
				$bln = "Juli";
				break;
			case 8:
				$bln = "Agustus";
				break;
			case 9:
				$bln = "September";
				break;
			case 10:
				$bln = "Oktober";
				break;
			case 11:
				$bln = "November";
				break;
			case 12:
				$bln = "Desember";
				break;
		}
		return $bln;
	}
	public function DateWeek($w,$now = false)
	{
		if($now == true)
		{
			$w = date('w');
		}else{
			$w = $w;
		}
		$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu");
		return $seminggu[$w];
	}
	public function DateNow($jam=false)
	{
		$bln = $this->DateMonth(ceil(date('m')));
		$seminggu = $this->DateWeek(date('w'));
		
		$hari = $seminggu;
		$tglnow = date('d'); $tahun = date('Y');
		if($jam === true){
			$returnkan = $hari.", ".$tglnow." ".$bln." ".$tahun." , ".date('H:i:s');
		}else{ 
			$returnkan = $hari.", ".$tglnow." ".$bln." ".$tahun;
		}
		return $returnkan;
	}
	public function rupiah($rp)
	{
		return str_replace(",",".",number_format($rp));
	}
	public function getAssets($ex,$filname)
	{
		$path= $this->config['base_url'].'/assets/'.$ex.'/'.$filname.'.'.$ex;
		if($ex == 'css')
		{
			$d = '<!-- MaFrame library -->';
			$d.= "\n";
			$d.= '<link rel="stylesheet" type="text/css" href="'.$path.'">';
			$d.= "\n";
		}elseif($ex == 'js')
		{
			$d = '<!-- MaFrame library -->';
			$d.= "\n";
			$d = '<script type="text/javascript" src="'.$path.'"></script>';
			$d.= "\n";
		}
		return $d;
	}
	

	public function view($filename,$src)
	{
		if($src == 'lib')
		{
			require $this->config['source_path'].'/'.$filename.'.php';
		}elseif($src == 'inc')
		{
			require $this->config['include_path'].'/'.$filename.'.php';
		}
	}
	public function alert($msg,$direct)
	{
		echo "<script type='text/javascript'>";
		echo "alert('".$msg."');";
		echo "window.location.href='".$direct."';";
		echo "</script>";
	}
	public function generate_token()
	{
		$char = "QWERTYUIPASDFGHJKLZXCVBNM0987654321";
		$pan = strlen($char)-1;
		$gen = "";
		for ($i=1; $i <= 6 ; $i++) { 
			$gen.=$char[rand(0,$pan)];
		}
		return $gen;
	}
	public function generate_password($username)
	{
		$pan = strlen($username)-1;
		$gen = "";
		for($i=1;$i<=4;$i++)
		{
			$gen.=$username[rand(0,$pan)];
		}
		return $gen;
	}
	public function urlfromtitle($title)
	{
		$replace = array(" ","20%",",",".","#","/","\\","{","}","(",")","_","+","*");
		$ganti = array("-");
		$s = str_replace($replace,$ganti,$title);
		$s = strtolower($s);
		$s = urlencode($s);
		return $s;
	}

}

?>