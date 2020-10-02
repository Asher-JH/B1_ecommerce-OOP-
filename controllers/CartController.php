<?php 
	session_start();
	require_once('../models/Cart.php');

	class CartController extends Cart{
		public static function add_to_cart($post) {
			echo "hi";
			$id = $post['id'];
			$quantity = $post['quantity'];
			if(!isset($_SESSION['cart'])) {
				$_SESSION['cart'][$id] = $quantity;
			} else {
				$_SESSION['cart'][$id] += $quantity;
			}

		}

	}

 ?>