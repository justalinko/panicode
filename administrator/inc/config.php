<?php

require dirname(dirname(__DIR__)).'/configuration.php';

ini_set( "display_errors", true );
define( "HOST",$PANICODE['db']['hostname']);
//nama database
define( "DATABASE_NAME", $PANICODE['db']['database']);
define( "DB_USERNAME", $PANICODE['db']['username']);
//password mysql
define( "DB_PASSWORD",$PANICODE['db']['password']);
//dir admin
define( "DIR_ADMIN", $PANICODE['site']['admin_dir']);
//main directory
define( "DIR_MAIN", $PANICODE['site']['base_dir']);


define('DB_CHARACSET', 'utf8');

require_once ('Database.php');
require_once ('Datatable.php');
require_once ('My_pagination.php');
require_once ('url.php');

$db=new Database();
$pg=New My_pagination();
$dtable = new TableData();

function handleException( $exception ) {
  echo  $exception->getMessage();
}

set_exception_handler( 'handleException' );


?>
