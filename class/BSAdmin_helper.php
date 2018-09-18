<?php

Class BSAdmin_helper{
	public function action($data = array())
	{
		$html = "";
		foreach($data as $d=>$w){
		$html.= "<a href='./?p=".$w['title']."&m=".$w['url']."' class='btn btn-".$w['btn']."' data-toggle='tooltip' title='".$w['url']."' : ".$w['title']."'><i class='fa fa-".$w['icon']."'></i></a>  ";
		}

		return $html;
	}
	public function tr($max = 1,$content = array())
	{
		$html = "<tr>";
		for($i=0;$i<=$max;$i++)
		{
			$html.="<td>".$content[$i]."</td>";
		}
		$html.="</tr>";

		return $html;
	}
	public function maxchar($max = 100,$string)
	{
		$string = strip_tags($string);
		$s = substr($string,0,$max)." ...";

		return $s;
	}
	public function header_admin($title,$menu = array())
	{
		$html = '<div class="row">';
		$html.= '<div class="col-lg-12">';
		$html.='<h2>'.strtoupper($title).'</h2></div></div>';  
		if(is_array($menu))
		{
			foreach($menu as $man=>$men)
			{
				$html.='<a href="./?p='.strtolower($title).'&m='.$men['url'].'" class="'.$men['class'].'"><i class="fa fa-'.$men['icon'].'"></i>  '.$men['title'].' '.strtolower($title).'</a>';
				$html.="&nbsp;&nbsp;";
			}
		}
		$html.='<hr/><br><br>';

		return $html;
	}

	public function breadcumb($item)
	{
		 $html ='<ol class="breadcrumb">';
		 $html.='<li class="breadcrumb-item ">';
		 $html.='<a href="./?p=dashboard">Dashboard</a></li>';
		 $html.='<li class="breadcrumb-item">';
		 $html.='<a href="./?p='.$item['p'].'&m=all">'.$item['p'].'</a></li>';
		 $html.='<li class="breadcrumb-item">';
		 $html.='<a href="./?p='.$item['p'].'&m='.$item['m'].'">'.$item['m'].'</a></li>';
         $html.='</ol>';
         return $html;
	}
	public function delete_selected($link)
	{
		$html='<div class="card mt-3 mb-5">';
		$html.='<div class="card-body">';
		$html.='<button type="submit" class="btn btn-danger" name="delete_selected"><i class="fa fa-trash"></i> Delete selected</button>';
		$html.='</div>';
		$html.='</div>';
		return $html;
		if(isset($_POST['delete_selected']))
		{
			echo "<script>window.location.href='./?p=delete_selected&m=".$link."';</script>";
		}
	}
}