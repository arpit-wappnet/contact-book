
<?php
include "config.php"; 

$name_msg = "";
$email_msg = "";
$number_msg = "";
$image_msg = "";
if(isset($_POST['submit']))
{
	$name = $_POST['name'];
	$email = $_POST['email'];
	$number =  $_POST['number'];
	if (isset($_FILES['image']) &&  isset($_FILES['image']['tmp_name'])) 
	{
		$image_name = time().'_'.$_FILES['image']['name'];
		$image_tmp_name = $_FILES['image']['tmp_name'];
		move_uploaded_file($image_tmp_name,'image/'.$image_name);

		 
	}
	if (trim($name)=="") {
		$name_msg = "plz enter your name";
	}elseif (trim($email)=="") {
		$email_msg = "plz enter your emailID";
	}elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		$email_msg = "plz enter valid your emailID";
	}elseif (trim($number)=="") {
		$number_msg = "plz enter phone number";
	}elseif(strlen($_POST['number']) != 10){
		$number_msg = 'Invalid Number!';
	}elseif (trim($image_tmp_name)=="") {
		$image_msg = "plz upload your photo";
	}else{
		
		$sql = "INSERT INTO users (`user_name`,`user_email`,`user_mobile_no`,`user_image`) VALUES ('".$name."','".$email."','".$number."','".$image_name."')";

	 
		$result = mysqli_query($con,$sql);

		header('location: http://localhost/contact_book/index.php');
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title> Add data </title>
</head>
<body>
	<form method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<label>Name</label>
			<input type="text" name="name"/>
			<span class="color-massage"><?=$name_msg?></span>
		</div>

		<div class="form-group">
			<label>Email</label>
			<input type="text" name="email">
			<span class="color-massage"><?=$email_msg?></span>
		</div>

		<div class="form-group">
			<label>Phone Number</label>
			<input type="number" name="number">
			<span class="color-massage"><?=$number_msg?></span>
		</div>
		<div class="form-group">
			<label>Photo</label>
			<input type="file" name="image">
			<span class="color-massage"><?=$image_msg?></span>
		</div>
		<input type="submit" name="submit" class="btn-submit">
	</form>
</body>
</html>