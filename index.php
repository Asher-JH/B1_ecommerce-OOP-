<?php
$title = "Catalog";
function get_content() {
	require 'models/Model.php';
	$query = "SELECT * FROM items";
	if(isset($_POST['categories'])) {
		$sort_value = $_POST['categories'];
		$query = "SELECT * FROM items WHERE category_id = $sort_value";
	}
	$items = Model::get_db($query);
	?>

	<form method="POST" action="#">
		<select name="categories">
			<option value="1">Breakfast</option>
			<option value="2">Lunch</option>
			<option value="3">Dinner</option>
		</select>
		<button class="btn btn-primary">Sort</button>
	</form>

	<div class="container">
		<h2 class="py-5">Catalog</h2>
		<div class="row">
			<?php 
			foreach($items as $item):
				?>
				<div class="col-md-4 py-5">
					<div class="card">
						<img src="<?php echo $item['image'] ?>">
						<div class="card-body">
							<a href="/views/item_details.php?id=<?php echo $item['id']; ?>"><h5 class="cacrd-title"><?php echo $item['name']; ?></h5></a>
							<p class="card-text"><?php echo $item['description']; ?></p>
							<small class="font-weight-bold"><?php echo $item['price'] ?></small>
								<div class="input-group">
									<input type="number" name="quantity" class="form-control" min="1">
									<div class="input-group-append">
										<button data-id="<?php echo $item['id'] ?>" class="btn btn-primary addToCart"> + 
									</button>
								</div>
							</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>


<script type="text/javascript">
	let addToCartButtons = document.querySelectorAll('.addToCart');
	addToCartButtons.forEach(indiv_button => {
		indiv_button.addEventListener('click', () => {
			let id = indiv_button.getAttribute("data-id");
			let quantity = indiv_button.parentElement.previousElementSibling.value
			
			let formBody = new FormData;
			formBody.append('id', id);
			formBody.append('quantity', quantity);
			fetch('routes/add_to_cart.php', {
				method: 'POST',
				body: formBody
			})
			.then(res => res.text())
			.then(data => {
				// alert('Items added to cart');
				let cartCount = document.getElementById('cart_count');
				if(parseInt(cartCount.innerHTML) == 0) {
					cartCount.innerHTML = parseInt(quantity);
				} else {
					cartCount.innerHTML = parseInt(cartCount.innerHTML) + parseInt(quantity);
				}
			})
		})
	})
</script>


<?php 
}
require_once 'views/partials/layout.php';
?>