<?php 



$title = "Cart";
function get_content() {
require '../controllers/connection.php';
if(isset($_SESSION['cart']) && count($_SESSION['cart'])):
 ?>


<div class="container py-4">
	<div class="row">
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
				$total = 0;
				foreach($_SESSION['cart'] as $id => $quantity): 
					$query = "SELECT * FROM items WHERE id = $id";
					$item = mysqli_fetch_assoc(mysqli_query($cn, $query));
					$subtotal = $item['price'] * $quantity;
					$total += $subtotal;
				?>
				<tr>
					<td><?php echo $item['name']; ?></td>
					<td><?php echo $item['price']; ?></td>
					<td>
						<form method="POST" action="/controllers/update_cart.php">
							<input type="hidden" name="id" value="<?php echo $item['id']; ?>">
							<input type="number" name="quantity" value="<?php echo $quantity; ?>" class="form-control quantity_input">
						</form>
					</td>
					<td><?php echo number_format($subtotal, 2); ?></td>
					<td>
						<a href="/controllers/delete_cart_item.php?id=<?php echo $id ?>" class="btn btn-danger">Delete</a>
					</td>
				</tr>
			<?php endforeach; ?>
			<tr>
				<td>
					<a href="/controllers/empty_cart.php" class="btn btn-danger">Empty Cart</a>
				</td>
				<td>
					<button data-toggle="modal" data-target="#checkout_modal" class="btn btn-success">Checkout</button>

					<div class="modal fade" id="checkout_modal">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Confirm Checkout</h5>
								</div>
								<div class="modal-body">
									<p>Are you really sure about your orders?</p>
								</div>
								<div class="modal-footer">
									<button class="btn btn-secondary" data-dismiss='modal'>Close</button>
									<a href="/controllers/checkout.php" class="btn btn-success">Checkout</a>
								</div>
							</div>
						</div>
					</div>
				</td>
				<td id="paypal-button-container">
					
				</td>
				<td>Total: MYR <?php echo number_format($total, 2) ?></td>
			</tr>
			</tbody>
		</table>

		<script src="https://www.paypal.com/sdk/js?client-id=AaZS_njujnTyGvRMScyqE2se_zwtFT76bjJtypo4abrwCfh11pdE7lbm_0iXcfVC3scrEMFVWbcH_Sex"></script>
		<script>paypal.Buttons({
			createOrder: function(data, actions) {
				return actions.order.create({
					purchase_units: [{
						amount: {
							value: <?php echo number_format($total, 2); ?>
						}
					}]
				})
			},
			onApprove: function(data, actions) {
				return actions.order.capture().then(function(details) {
					alert('Transaction completed by ' + details.payer.name.given_name);
					fetch('/controllers/checkout.php')
				})
			}
		}).render('#paypal-button-container');</script>

		<script type="text/javascript">
			let quantityInputs = document.querySelectorAll('.quantity_input');
			quantityInputs.forEach( input => {
				input.addEventListener('change', () => {
					input.parentElement.submit();
				})
			})
		</script>
	</div>
</div>

<?php else: ?>
	<h2>Your cart is empty</h2>






 <?php 
	endif;
 	}
 	require 'partials/layout.php';  
 ?>