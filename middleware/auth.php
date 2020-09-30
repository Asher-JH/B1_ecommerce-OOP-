<?php 


	session_start();
	if(isset($_SESSION['user_details']) && !$_SESSION['user_details']['isAdmin']) {
		header('Location: /');
	}


 ?>