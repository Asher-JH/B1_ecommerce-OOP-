<?php 
	$title = 'Login';
	function get_content() {
 ?>


 <form class="col-md-6 mx-auto py-5" method="POST" action="/routes/login.php">
 	<div class="form-group">
 		<label>Username</label>
 		<input type="text" name="username" class="form-control">
 	</div>
 	<div class="form-group">
 		<label>Password</label>
 		<input type="password" name="password" class="form-control">
 	</div>
 	<button class="btn btn-primary">Log In</button>
 </form>


 <?php 
 	}
 	require_once '../partials/layout.php';
  ?>