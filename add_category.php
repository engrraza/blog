<?php
ini_set('display_errors', 'On');
error_reporting(-1);
	
		include_once('resources/init.php');

if (isset($_POST['name']) ) {
	$name = trim($_POST['name']);

	if (empty($name) ) {
		$error = "You must submit a category name.";
	} else if (category_exists('names' , $name)) {
			$error = "That category already exists";
	} else if (strlen($name) > 24) {
		$error = "Category names can only be upto 24 characters";
	}

	if ( !isset($error)) {

		add_category($name);

		header('Location: add_post.php');
		die();
	}



}


?>


<!DOCTYPE html>


<html lang="en">

<head>
	<meta charset ="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">

	<title> Add a Category </title>

</head>

<body>
	<h1> Add a Category </h1>	

	<?php

		if (isset($error)) {
			echo "<p> {$error} </p> ";
		}

	?>


	<form action ="" method="post">
		<div>
			<label for="name"> Name </label>
			<input type="text" name="name" value="name">
		</div>
		<div>
			<input type="submit" value="Add a Category">
		</div>
	</form>

</body>

</html>