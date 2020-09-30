<?php 
	
	require_once 'connection.php';
	require_once '../vendor/autoload.php';

	//sanitize inputs
	$firstname = htmlspecialchars($_POST['firstname']);
	$lastname = htmlspecialchars($_POST['lastname']);
	$username = htmlspecialchars($_POST['username']);
	$email = htmlspecialchars($_POST['email']);
	$password = htmlspecialchars(sha1($_POST['password']));
	$password2 = htmlspecialchars(sha1($_POST['password2']));

	$errors = 0;

	// all inputs should not be empty
	foreach($_POST as $key => $value) {
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
		$result = mysqli_fetch_assoc(mysqli_query($cn, $query));
		if($result) {
			echo "Username or email already taken.";
			$errors++;
			mysqli_close($cn);
		}
	}

	// process register
	if($errors === 0) {
		$query = "INSERT INTO users (firstname, lastname, username, email, password) VALUES ('$firstname', '$lastname', '$username', '$email', '$password')";

		mysqli_query($cn, $query);
		mysqli_close($cn);

		//send an email
		// Create the Transport
		$transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
		  ->setUsername('ecomownerb1@gmail.com')
		  ->setPassword('Qwerty123_')
		;

		// Create the Mailer using your created Transport
		$mailer = new Swift_Mailer($transport);

		// Create a message
		$message = (new Swift_Message('Registration Succesfull'))
		  ->setFrom(['ecomownerb1@gmail.com' => 'John Doe'])
		  ->setTo([$_POST['email'] => $_POST['firstname']])
		  ->setBody('Thank you regisering on B1_ecom')
		  ;

		// Send the message
		$result = $mailer->send($message);



		header('Location: /');
	}


 ?>