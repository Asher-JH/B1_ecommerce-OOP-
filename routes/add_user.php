<?php 
	require('../controllers/UserController.php');
	require_once '../vendor/autoload.php';
	UserController::create($_POST);
	header('location: /');
 ?>