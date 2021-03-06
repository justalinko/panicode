<?php 
/**
***************************************************************
* PaniCode v2.0-2018
* 
*
* @author Alin Koko Mansuby < alinkokomansuby@gmail.com >
* @version 2.0-2018
* @copyright 2018 (c) alinko.id
* @license The MIT License (MIT)
*
***************************************************************
*/

Class Template{

	public function header()
	{
$temp = "
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
* Generated date : ".date('D,d M Y H:i:s')." //
***************************************************************
*/

";
	return $temp;
	}

	public function emptytemp($type)
	{
		$content=self::header();
		if($type == 'modules')
		{
			$content .="
// This empty modules
";
		}elseif($type == 'class')
		{
			$content .="
Class EmptyClas{

	// This empty clasas.
}
";
		}
		return $content;
	}
	public function viewsempty()
	{
		$tmp = "<!DOCTYPE html>
<html>
<head>
	<title>PaniCode v2.0-2018</title>
</head>
<body>
<center><h1>PaniCode</h1></center>
</body>
</html>";
return $tmp;
	}
	public function modules_crud()
	{
$tmp=self::header();
$tmp.="
if(Config::empty_module() || Config::eq_module('all'))
{

// ?p=Modules&m=all

\$data = \$db->fetch_rows('table');


}elseif(Config::eq_module('add'))
{

// Add data

}elseif(Config::eq_module('edit'))
{

 // ?p=Modules&m=edit
\$data = \$db->fetch_rows_where('table',['id' => Config::get_id()]);

}elseif(Config::eq_module('delete'))
{
	// delete action
	if(\$db->delete('table',['id' => Config::get_id()]))
		echo \"ok\";
	else
		echo \"failed\";
}
";
return $tmp;
	}
	public function views_crud()
	{
$tmp ="
<?php if(Config::empty_module() || Config::eq_module('all')): ?>

<h3>All data</h3>
<table>
	<thead><th>No</th><th>Example</th></thead>
	<tbody>
		<tr><td>1</td><td>Example view</td></tr>
	</tbody>
</table>

<?php if(Config::eq_module('add')): ?>

<h3>Add data</h3>
<form>
	<input type=\"\" name=\"\">
	<input type=\"\" name=\"\">
</form>

<?php if(Config::eq_module('edit')): ?>

<h3>Edit data</h3>
<form>
	<input type=\"\" name=\"\">
	<input type=\"\" name=\"\">
</form>

<?php endif; ?>
";
return $tmp;
	}

	public function views_auth()
	{
		$tm='<?php if(Config::empty_module() || Config::eq_module(\'login\')): ?>

<h3>Login</h3>
<form>
	<label>Username</label>
	<input type="text" name="username" placeholder="username">
	<label>Password</label>
	<input type="password" name="password" placeholder="*****">
</form>

<?php elseif(Config::eq_module(\'register\')): ?>

<h3>Register</h3>
<form>
	<label>Email</label>
	<input type="email" name="email" placeholder="alin@mail.com">
	<label>Username</label>
	<input type="text" name="username" placeholder="username">
	<label>Password</label>
	<input type="password" name="password" placeholder="*****">
	<label>re-Password</label>
	<input type="password" name="repassword" placeholder="*****">
</form>

<?php endif; ?>';
return $tm;
	}
	public function modules_auth()
	{
		$r = self::header();
		$r .= "
if(Config::eq_module('login'))
{


if(\$core->method_post('submit'))
{
	\$username=\$core->method_post('username');
	\$password=\$core->hashm(\$core->method_post('password'),'sha1');

	\$check_exist = \$db->check_exist('table',['username' => \$username,'password' => \$password]);

	if(\$check_exist)
	{
		\$session_data = ['username' => \$username,
						'password' => \$password];
		\$core->create_session(\$session_data);
		echo \"ok\";
	}else{
		echo \"failed\";
	}
}

}elseif(Config::eq_module('register'))
{
	if(\$core->method_post('submit'))
	{
	\$email=\$core->method_post('email');
	\$username=\$core->method_post('username');
	\$password=\$core->hashm(\$core->method_post('password'),'sha1');
	\$repassword=\$core->hashm(\$core->method_post('rpassword'),'sha1');

	if(\$password==\$repassword)
	{
		\$data = ['',\$email,\$username,\$password];
		\$db->insert('table',\$data);
		echo \"ok\";
	}else{
		echo \"password tidak sama\";
	}
	}
}
";

		return $r;
	}
	public function configurationTemplate($path = array(),$url = array(),$db = array(),$route = array())
	{
		$tt="

########## THIS CONFIGURATION WAS GENERATED BY PANICODE ##########
### GENERATED DATE ".date('D, d M Y H:i:s')." 
##################################################################
\$config = [];

###### PATH SETTING CONFIGURATION #################
\$config['path']['includes']		= '".$path['includes']."';
\$config['path']['modules']			= '".$path['modules']."';
\$config['path']['views']			= '".$path['views']."';
\$config['path']['class']			= '".$path['class']."';
\$config['path']['admin']			= '".$path['admin']."';
########### END PATH CONFIGURATION ################


########## URL CONFIGURATION ######################
\$config['url']['base']				= '".$url['base']."';
\$config['url']['admin']			= '".$url['admin']."';
\$config['url']['module']			= '".$url['module']."';
\$config['url']['page']				= '".$url['page']."';
\$config['url']['id']				= '".$url['id']."'; 
############## END URL CONFIGURATION  #############


### DATABASE CONFIGURATION #######################
\$config['db']['hostname']			= '".$db['hostname']."';
\$config['db']['username']			= '".$db['username']."';
\$config['db']['password']			= '".$db['password']."';
\$config['db']['database']			= '".$db['database']."';
############### END DATABASE CONFIGURATION #######


########## ROUTE CONFIGURATION #####################
\$config['route']['default']  		= '".$route['default']."';
\$config['route']['default_admin'] 	= '".$route['default_admin']."';
\$config['route']['static_header'] 	= '".$route['static_header']."';
\$config['route']['static_footer'] 	= '".$route['static_footer']."';
\$config['route']['static_sidebar']	= '".$route['static_sidebar']."';

// Except. kecuali

\$config['route']['except_header'] 	= [];
\$config['route']['except_footer'] 	= [];
\$config['route']['except_sodebar'] = [];

##################### END ROUTE CONFIGURATION #######







################# CHECKING CONFIGURATION ##############

if(file_exists(__DIR__.'/'.\$config['path']['class'].'/config.pclass.php'))
{
	require_once(__DIR__.'/'.\$config['path']['class'].'/config.pclass.php');
	\$conf = new Config(\$config);

}else{
	print __DIR__.'/'.\$config['path']['class'].'/config.class.php : Not found';
	exit;
}
######################################################
";
return $tt;
	}
}
?>