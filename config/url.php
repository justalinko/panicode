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


$CONFIG['url']['base_url'] = $PANICODE['site']['base_url'];

$CONFIG['url']['ep']	= empty($_GET['p']);
$CONFIG['url']['p']		= @$_GET['p'];


$CONFIG['url']['em']	= empty($_GET['m']);
$CONFIG['url']['m']		= @$_GET['m'];


######## Aliases variable ##############


$base_url		=	$CONFIG['url']['base_url'];

$empty_page		=	$CONFIG['url']['ep'];

$get_page		=	$CONFIG['url']['p'];

$empty_module	= 	$CONFIG['url']['em'];

$get_module		=	$CONFIG['url']['m'];

$getID			=	abs(@$_GET['id']);


######### end ##########################

?>