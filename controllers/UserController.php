<?php 
	session_start();
	require('../models/User.php');
	class UserController extends User {
		public static function create($post) {
			//sanitize inputs
			$firstname = htmlspecialchars($post['firstname']);
			$lastname = htmlspecialchars($post['lastname']);
			$username = htmlspecialchars($post['username']);
			$email = htmlspecialchars($post['email']);
			$password = htmlspecialchars(sha1($post['password']));
			$password2 = htmlspecialchars(sha1($post['password2']));

			$errors = 0;

			// all inputs should not be empty
			foreach($post as $key => $value) {
				if(strlen($value) == 0) {
					echo "Please type in something";
					$errors++;
				}
			}

			// username should be greater than 8 characters
			if(strlen($username) < 8) {
				echo "Username must be greater than 8 characters";
				$errors++;
			}
			// password should be greater than 8 characters
			if(strlen($password) < 8) {
				echo "Password must be greater than 8 characters";
				$errors++;
			}
			// password and password2 should macth
			if($password != $password2) {
				echo "Passwords do not match";
				$errors++;
			}

			// check if username and email already exists
			if($username && $email) {
				$query = "SELECT username, email FROM users WHERE username = '$username' OR email = '$email'";
				$result = mysqli_fetch_assoc(Model::get_db($query));
				if($result) {
					echo "Username or email already taken.";
					$errors++;
					mysqli_close(Model::get_cn());
				}
			}

			// process register
			if($errors === 0) {
				$query = "INSERT INTO users (firstname, lastname, username, email, password) VALUES ('$firstname', '$lastname', '$username', '$email', '$password')";

				Model::get_db($query);
				mysqli_close(Model::get_cn());
		}

		Model::send_email($post);
	}

	public static function login($post) {

		$result = User::check_user($post);

		if($result) {
			$_SESSION['user_details'] = $result;
			header('location: /');
		} else {
			echo "Please check your credentials.";
			echo "<br>";
			echo "<a href='/views/forms/login.php'>Go back to Login</a>";
		}
	}

	public static function logout(){
			session_unset();
			session_destroy();
			header('location: /');
		}
	}
 ?>
