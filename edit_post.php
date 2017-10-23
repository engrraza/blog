<?php
include_once('resources/init.php');

$post = get_posts($_GET['id']);

if (isset($_POST['title'], $_POST['contents'], $_POST['category'])) {
	$errors	= array();

	$title 			= trim($_POST['title']);
	$contents 		= trim($_POST['contents']);


	if (empty($title)) {
		$errors[]	= 'You must submit some title';
	}

	if (empty($contents)) {
		$errors[] = 'You must enter some text here';
	}

	if (! category_exists('id', $_POST['category']))	{

		$errors[] = "That category does not exist";

	}

	if (strlen($title) > 255) {
		$errors[] = "The title cannot be longer than 255 characters ";
	}

	if (empty($errors) ) {

		edit_post($_GET['id'], $title, $contents, $_POST['category']);

		header("Location: index.php?id={$post[0]['post_id']}");
		die();
	}


} 	
?>

<!DOCTYPE html>



<html lang="en">

<head>
	<meta charset ="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">

	<style>
		label{ display: block;}
	</style>

	<title> Edit a Post </title> 

</head>	

<body>
	
	<h1>Edit a Post</h1>

	<?php
		if (isset($errors)  && ! empty($errors)) {
			echo '<ul><li>', implode('</li><li>', $errors), '</li></ul>';		
		} 
	?>

	<form action="" method="Post"></form>
		<div>
			<label for="title">Title</label>
			<input type="text" name="title" value="<?php echo $post[0]['title']; ?>">
		</div>

		<div>
			<label for="contents">Contents</label>
			<textarea name="contents" rows="15" cols="50"> <?php echo $post[0]['contents']; ?></textarea>
		</div>

		<div>
			<label for="category">Category</label>
			<select name="category">
				<?php
					foreach (get_categories() as $category) {
						$selected = ($category['names'] == $post[0]['names']) ? 'selected' : '' ;
				?>
				
					<option value="<?php echo $category['id']; ?>" <?php echo $selected; ?>> <?php echo $category['names']; ?> </option> 
				<?php
				}

				?>
			</select>
		</div>

		<div>
			<input type="submit" value="Edit Post">
		</div>
	</form>	

</body>
</html>	

	