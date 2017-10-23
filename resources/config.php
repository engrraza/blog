<?php
ini_set('display_errors', 'On');
error_reporting(-1);

$config['db_host'] = 'localhost';
$config['db_user'] = 'root';
$config['db_pass'] = 'raza7292';
$config['db_name'] = 'blog';

foreach ($config as $k => $v) {
	define(strtoupper($k), $v);
}

 	// 	echo "muhammad";
?>