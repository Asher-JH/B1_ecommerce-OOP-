<?php 
	require_once('Model.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/interfaces/Database.php');

	class User extends Model implements Database{
		public function check_user($post) {
			$username = $post['username'];
			$password = sha1($post['password']);

			$query = "SELECT id, username, email, isAdmin FROM users WHERE username = '$username' AND password = '$password'";
			$result = mysqli_fetch_assoc(Model::get_db($query));
			return $result;
		}


	}

 ?>