<?php 

	session_start();

	require_once 'connection.php';

	$username = $_POST['username'];
	$password = sha1($_POST['password']);

	$query = "SELECT id, username, email, isAdmin FROM users WHERE username = '$username' AND password = '$password'";
	$result = mysqli_fetch_assoc(mysqli_query($cn, $query));

	if($result) {
		$_SESSION['user_details'] = $result;
		header('location: /');
	} else {
		echo "Please check your credentials.";
		echo "<br>";
		echo "<a href='/views/forms/login.php'>Go back to Login</a>";
	}

 ?>