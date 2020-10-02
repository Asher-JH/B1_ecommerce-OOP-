<?php 
	session_start();
	require_once('Model.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/interfaces/Database.php');

	class Cart extends Model implements Database{
		public static function empty_cart() {
			unset($_SESSION['cart']);
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}

		public static function delete_cart_item($get) {
			$id = $get['id'];

			unset($_SESSION['cart'][$id]);

			header('Location: '.$_SERVER['HTTP_REFERER']);
		}

		public static function update_cart($post) {

			$id = $post['id'];
			$quantity = $post['quantity'];

			$_SESSION['cart'][$id] = $quantity;
			header('Location: '.$_SERVER['HTTP_REFERER']);

		}

		public static function checkout($get) {
			$isPaypal;
			if($get['isPaypal'] == true) {
				$isPaypal = 1;
			} else {
				$isPaypal = 0;
			}

			if(isset($_SESSION['cart'])) {
				$user_id = $_SESSION['user_details']['id'];
				$total = 0;
				$order_query = "INSERT INTO orders(user_id, isPaypal) VALUES ($user_id, $isPaypal)";
				Model::get_db($order_query);
				$order_id = mysqli_insert_id(Model::get_cn());

				foreach($_SESSION['cart'] as $id => $quantity) {
					$item_query = "SELECT * FROM items WHERE id = $id";
					$item = mysqli_fetch_assoc(Model::get_db($item_query));
					$subtotal = ($item['price'] * $quantity);
					$total += $subtotal;

					$item_order_query = "INSERT INTO item_order (item_id, order_id, quantity, subtotal) VALUES ($id, $order_id, $quantity, $subtotal)";
					Model::get_db($item_order_query);
				}
			$update_order = "UPDATE orders SET total = $total WHERE id = $order_id";
			Model::get_db($update_order);
			unset($_SESSION['cart']);
			header('Location: /');
			}
		}


	}

 ?>