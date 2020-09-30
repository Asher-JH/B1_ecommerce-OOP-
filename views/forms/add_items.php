<?php 
	require_once '../../middleware/auth.php';
	$title = "Add Item";
	function get_content() {
	require '../../controllers/connection.php';
	$query = "SELECT * FROM categories";
	$categories = mysqli_query($cn, $query);
 ?>

<div class="container">
	<div class="row">
		<div class="col-md-6 mx-auto py-4">
			<form method="POST" action="/controllers/add_item.php" enctype="multipart/form-data">
				<div class="form-group">
					<label>Name</label>
					<input type="text" name="product_name" class="form-control">
				</div>
				<div class="form-group">
					<label>Price</label>
					<input type="text" name="price" class="form-control">
				</div>
				<div class="form-group">
					<label>Description</label>
					<input type="text" name="description" row="3" placeholder="Enter your description here..." class="form-control">
				</div>
				<div class="form-group">
					<label>Image</label>
					<input type="file" name="image" class="form-control">
				</div>
				<div class="form-group">
					<label>Categories</label>
					<select class="form-control" name="category_id">
						<?php foreach($categories as $key => $value): ?>
							<option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<button class="btn btn-success">Add Item</button>
			</form>
		</div>
	</div>
</div>

 <?php 
 	}
 	require_once '../partials/layout.php';
  ?>