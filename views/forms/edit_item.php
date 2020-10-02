<?php 
	$title = "Edit Item";
	function get_content() {
	$id = $_GET['id'];
	require '../../models/Model.php';
	$queryAll = "SELECT * FROM items WHERE id = $id";
	$item = mysqli_fetch_assoc(Model::get_db($queryAll));
	$queryCategories = "SELECT * FROM categories";
	$categories = Model::get_db($queryCategories);
 ?>

<div class="container">
	<h2 class="font-weight-bold py-3">Edit <?php echo $item['name']; ?> </h2>
	<div class="row">
		<div class="col-md-6 mx-auto py-4">
			<form method="POST" action="/routes/edit_item.php" enctype="multipart/form-data">
				<div class="form-group">
					<label>Name</label>
					<input type="text" name="product_name" class="form-control" value="<?php echo $item['name'] ?>">
				</div>
				<div class="form-group">
					<label>Price</label>
					<input type="text" name="price" class="form-control" value="<?php echo $item['price'] ?>">
				</div>
				<div class="form-group">
					<label>Description</label>
					<textarea class="form-control" name="description" rows="3">
						<?php echo $item['description'] ?>
					</textarea>
				</div>
				<div class="form-group">
					<label>Image</label>
					<img src="../<?php echo $item['image'] ?>">
					<input type="file" name="image" class="form-control" >
				</div>
				<div class="form-group">
					<label>Categories</label>
					<select class="form-control" name="category_id">
						<?php foreach($categories as $key => $value): ?>
							<?php if($category['id'] == $item['category_id']): ?>
								<option selected value="<?php echo $category['id']; ?>">
									<?php echo $category['name']; ?>
								</option>
								<?php else: ?>
							<option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
						<?php endif; ?>
						<?php endforeach; ?>
					</select>
				</div>
				<input type="hidden" name="id" value="<?php echo $item['id']; ?>">
				<button class="btn btn-success">Edit Item</button>
			</form>
		</div>
	</div>
</div>

 <?php 
 	}
 	require_once '../partials/layout.php';
  ?>