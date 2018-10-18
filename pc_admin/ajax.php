<?php 
require_once(dirname(__DIR__).'/autoloader.php');


if(Config::eq_module('auth_login'))
{
	$username = $core->method_post('username');
	$password = $core->hashm($core->method_post('password'),'sha1');
	$c = $db->check_exist('pc_users',['username' => $username,'password' => $password,'aktif' => 'Y']);

	if($c)
	{
		$d = $db->fetch_rows_where('pc_users',['username' => $username,'password' => $password,'aktif' => Y]);
		$ses = ['pc_username' => $d['username'],
				'pc_password' => $d['password'],
				'first_name' => $d['first_name'],
				'last_name' => $d['last_name'],
				'email' => $d['email'],
				'id_group' => $d['id_group'],
				'logged_in' => date('D, d M Y H:i:s')
				];
		$core->create_session($ses);
		echo "good";
	}else{
		echo "Username / password salah";
	}
}