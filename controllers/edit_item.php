<?php

require 'connection.php';

$id = $_POST['id'];

$name = $_POST['product_name'];
$price = $_POST['price'];
$description = $_POST['description'];
$query = "SELECT * FROM `items` WHERE id = $id";
$item = mysqli_fetch_assoc(mysqli_query($cn, $query));

if(isset($_FILES['image']['name'])){
	$image_path = $item['image'];
} else{
	$image_path ='../assets/images/'. $_FILES['image']['name'];
	move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
}

$query = "
	UPDATE
 		`items` 
 	SET 
 		`name`= '$name',
 		`price`= $price,
 		`description`= '$description',
 		`image`= '$image_path' 
 	WHERE 
 		id = $id";
	
	mysqli_query($cn, $query);
	header('Location: /');
?>