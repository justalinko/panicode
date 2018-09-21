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

}
?>