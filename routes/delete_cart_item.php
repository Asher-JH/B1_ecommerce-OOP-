<?php 
	require('../controllers/CartController.php');
	CartController::delete_cart_item($_GET);
 ?>