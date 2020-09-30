<?php 



$title = "Transactions";
function get_content() {
require '../controllers/connection.php';
 ?>


<div class="container py-4">
	<div class="row">
		<?php 
		$user_id = $_SESSION['user_details']['id'];

		if(!$_SESSION['user_details']['isAdmin']) {
			$query = "SELECT * FROM orders WHERE user_id = $user_id";
			$orders = mysqli_query($cn, $query);
		} else {
			$query = "SELECT * FROM orders";
			$orders = mysqli_query($cn, $query);
		}

		foreach($orders as $id => $order):
			$orderId = $order['id'];
		 ?>
		 <pre>
		 	<h4>Order id: #<?php echo $orderId ?></h4>
		 	<small>Date: <?php echo $order['date_pruchased']; ?></small>
		 </pre>

		<table class="table table-hover">
			<thead class="thead-dark">
				<tr>
					<th>Name</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Subtotal</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$query = "SELECT * FROM item_order WHERE order_id = $orderId";
					$item_orders = mysqli_query($cn, $query);
					$total = $order['total'];
					foreach($item_orders as $id => $item_order):
						$item_id = $item_order['item_id'];
						$query = "SELECT * FROM items WHERE id = $item_id";
						$item_name = mysqli_fetch_assoc(mysqli_query($cn, $query));
				?>
				<tr>
					<td><?php echo $item_name['name'] ; ?></td>
					<td><?php echo $item_order['subtotal'] / $item_order['quantity']; ?></td>
					<td><?php echo $item_order['quantity']; ?></td>
					<td><?php echo $item_order['subtotal']; ?></td>
				</tr>
			<?php endforeach; ?>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td>Total: MYR <?php echo number_format($total, 2) ?></td>
			</tr>
			</tbody>
		</table>
	<?php endforeach; ?>

	</div>
</div>
 <?php 
 	}
 	require 'partials/layout.php';  
 ?>