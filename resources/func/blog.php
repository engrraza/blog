<?php
ini_set('display_errors', 'On');
error_reporting(-1);

include_once('resources/init.php');

function add_post($title, $contents, $category) {
	
	$title 		= mysql_real_escape_string($title);
	$contents 	= mysql_real_escape_string($contents);
	$category 	= (int) $category;

	mysql_query("INSERT INTO `posts` SET

					`cat_id`		= {$category},
					`title`			= '{$title}',
					`contents`		= '{$contents}',
					`date_posted`	=	 NOW()");	

	
}

	 
function edit_post($id, $title, $contents, $category) {

	$id 		= (int) $id;
	$title 		= mysql_real_escape_string($title);
	$contents 	= mysql_real_escape_string($contents);
	$category 	= (int) $category;


	mysql_query("UPDATE `posts` SET

					`cat_id`		= {$category},
					`title`			= '{$title}',
					`contents`		= '{$contents}'
				WHERE `id` = {$id} ");
}
	

function add_category($name){

	$name = mysql_real_escape_string($name);

	if(mysql_query("INSERT INTO `Categories` SET `names` = '{$name}'") === false) {
		die("Something wrong with the add query");
	}
}



function delete($table, $id) {

	$table  = mysql_real_escape_string($table);
	$id = (int) $id;

	mysql_query("DELETE FROM `{$table}` WHERE `id` = {$id}");	
}

function get_posts($id = null, $cat_id = null) {
		$posts = array();

		$query = "SELECT `posts`.`id` AS `post_id`, `Categories`.`id` AS `category_id`,
						`title`, `contents`, `date_posted`, `Categories`.`names`

						FROM `posts`
						INNER JOIN `Categories` ON `Categories`.`id` = `posts`.`cat_id`";
						

		if (isset($id)) {
			$id = (int) $id;
			$query .= "WHERE `posts`.`id`= {$id}";
		}	

		if (isset($cat_id) )	{

			$cat_id = (int) $cat_id;
			$query .= "WHERE `cat_id` = {$cat_id}";
		}
				

	$query .= " ORDER by `posts`.`id` DESC";			
	$query = mysql_query($query);					

	while ($row = mysql_fetch_assoc($query)) {
		$posts[] = $row;
	}

	return $posts;
}

function get_categories($id = null) {
	
	$categories = array();

	$query = mysql_query("SELECT `id`,`names` FROM `Categories`");
	echo mysql_error();
	while ($row = mysql_fetch_assoc($query)) {
		 $categories[] = $row	;
	}
	return $categories;	
}
 
function category_exists($field, $value) {

	$field = mysql_real_escape_string($field); 
	$value = mysql_real_escape_string($value); 


	$query = mysql_query("SELECT COUNT(1) FROM `Categories` WHERE `{$field}` = '{$value}'");	

	// 	echo mysql_error();
	return(mysql_result($query, 0) == '0') ? false : true;
 

}
?>	