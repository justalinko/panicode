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


Class html_helper{

	public function assets($file,$tag='link',$add=array())
	{
		$html = "\n\n<!-- html helper, PaniCode -->\n";
		switch ($tag) {
			case 'link':
				$html.="<link rel=\"stylesheet\" href=\"./assets/css/{$file}\" type=\"text/css\"";
				break;
			case 'img':
				$html.="<img src=\"./assets/img/{$file}\" ";
				break;
			case 'script':
				$html.="<script type=\"text/javascript\" src=\"./assets/js/{$file}\" ";
				break;
			case 'emptylink':
				$html.="<link href=\"{$file}\" type=\"text/css\"";
				break;
			default:
				$html.="<!-- PaniCode -->";
				break;
		}
		foreach($add as $tag=>$val)
		{
			$html.=" ".$tag."=\"".$val."\"";
		}
		$html.=" />\n";
		$html.="<!-- End html helper -->\n\n";
		return $html;
	}
	public function tr($content = array())
	{
		$html = "<tr>";
		for($i=0;$i<=count($content)-1;$i++)
		{
			$html.="<td>".$content[$i]."</td>".PHP_EOL;
		}
		$html.="</tr>\n";

		return $html;
	}
	public function table_open($property = array(),$th = array())
	{
		$html = "<!-- start table open | panicode html helper -->".PHP_EOL;
		$html.= "<table ";
		if(is_array($property) && !empty($property))
		{
			foreach($property as $prop=>$val)
			{
				$html.= " $prop='$val' ";
			}
		}
		$html.= " >";
		$html.=PHP_EOL;
		$html.= "<thead>";
		for($i=0;$i<=count($th)-1;$i++)
		{
			$html.="<th>".$th[$i]."</th>".PHP_EOL;
		}
		$html.="</thead>".PHP_EOL;
		$html.="<tbody>";
		$html.=PHP_EOL;
		$html.="<!-- end table open -->".PHP_EOL;

		return $html;

	}
	public function table_close()
	{
		$html = "<!-- close table | panicode html helper-->".PHP_EOL;
		$html.="</tbody>".PHP_EOL;
		$html.="</table>";
		return $html;
	}
	public function input($type='text',$name,$attr = array())
	{
		$html = "<input type=\"".$type."\" name=\"".$name."\" ";
		if(is_array($attr) && !empty($attr))
		{
			foreach($attr as $atr=>$val)
			{
				$html.=$atr."=\"".$val."\" ";
			}
		}
		$html.= " />";
		$html.=PHP_EOL;
		$html.="<!-- input html helper | panicode -->".PHP_EOL;
		return $html;
	}

}
?>