<?php
error_reporting(-1);

include_once('resources/init.php');
include_once('resources/func/blog.php');



if ( ! isset($_GET['id']) ) {

	header('Location: index.php');
	die();
}

delete('Categories', $_GET['id']) ;

header('Location: category_list.php');	

die();	