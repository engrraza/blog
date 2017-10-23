<?php 
ini_set('display_errors', 'On');
error_reporting(-1);

include_once('config.php');

mysql_connect(DB_HOST, DB_USER, DB_PASS);
$link =  mysql_connect(DB_HOST, DB_USER, DB_PASS);
mysql_select_db(DB_NAME);


require_once('func/blog.php');
// echo "muhammad ali";


?>	 