<?php
require_once(dirname(__DIR__).'/autoloader.php');

if($core->get_session('pc_username') == 'empty' && $core->get_session('pc_password'))
{
	$core->redirect(Config::base_admin('login.php'));
	exit;
}else{

require 'header.php';

require 'top_nav.php';

require 'sidebar.php';

require 'container.php';


require 'footer.php';

}