<?php 
	$title = "Register";
	function get_content() {
 ?>


 <form class="col-md-6 mx-auto py-5" method="POST" action="/routes/add_user.php" enctype="multipart/form">
	<div class="form-group">
		<label>Firstname</label>
		<input type="text" name="firstname" class="form-control">
	</div> 
	<div class="form-group">
		<label>Lastname</label>
		<input type="text" name="lastname" class="form-control">
	</div>	
	<div class="fomr-group">
		<label>Usrname</label>
		<input type="text" name="username" class="form-control">
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="email" name="email" class="form-control">
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="password" name="password" class="form-control">
	</div>
	<div class="form-group">
		<label>Confirm Password</label>
		<input type="password" name="password2" class="form-control">
	</div>
	<button class="btn btn-primary">Register</button>
 </form>


 <?php 
 	}
 	require '../partials/layout.php';
  ?>