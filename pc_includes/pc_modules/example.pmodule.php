
<?php 
/**
***************************************************************
* PaniCode v2.0-2018 - Code for fast project.
* 
*
* @author Alin Koko Mansuby < alinkokomansuby@gmail.com >
* @version 2.0-2018
* @copyright 2018 (c) alinko.id
* @license The MIT License (MIT)
*
***************************************************************
* This script was generated by PaniCode.
* Generated date : Wed,17 Oct 2018 19:58:20 //
***************************************************************
*/


if(Config::empty_module() || Config::eq_module('all'))
{

// ?p=Modules&m=all

$data = $db->fetch_rows('table');


}elseif(Config::eq_module('add'))
{

// Add data

}elseif(Config::eq_module('edit'))
{

 // ?p=Modules&m=edit
$data = $db->fetch_rows_where('table',['id' => Config::get_id()]);

}elseif(Config::eq_module('delete'))
{
	// delete action
	if($db->delete('table',['id' => Config::get_id()]))
		echo "ok";
	else
		echo "failed";
}