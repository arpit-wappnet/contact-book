<?php
include "config.php";
if (!empty($_POST['update_id'])) {

	$name_msg = "";
	$email_msg = "";
	$number_msg = "";
	$image_msg = "";

	if(isset($_POST['submit']))
	{
		$name = $_POST['name'];
		$email = $_POST['email'];
		$number =  $_POST['number'];
		$old_image = $_POST['old_image'];

		if (!empty($_FILES['image']['name'])) 
		{
			$image_name = time().'_'.$_FILES['image']['name'];
			$image_tmp_name = $_FILES['image']['tmp_name'];
			move_uploaded_file($image_tmp_name,'image/'.$image_name);
			if($old_image != null && !empty($old_image)){
				 @unlink('image/'.$old_image);
			}
		}else{
			if($old_image != null && !empty($old_image)){
				$image_name = $old_image;
			}
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
		}else{
			$sql = "UPDATE `users` SET `user_name` = '".$name."',`user_email` = '".$email."',`user_mobile_no` = '".$number."',`user_image` = '".$image_name."' WHERE `id` = '".$_POST['update_id']."'";

			$result = mysqli_query($con,$sql);	
			header('location: http://localhost/contact_book');
		}
	}
}
?>
<?php

 if (isset($_GET['id'])) {
 	$id = $_GET['id'];
 	$sql = "SELECT * FROM users WHERE id = ".$id."";
 	$result = mysqli_query($con, $sql) or die("query unsuccessfull.");

 	if (mysqli_num_rows($result) == 1) {
 		while ($row = mysqli_fetch_assoc($result)) {

 			?>
 			<!DOCTYPE html>
 			<html>
 			<head>
 				<title> EDIT PAGE </title>
 			</head>
 			<body>
 				<form method="POST" enctype="multipart/form-data">
 					<div class="form-group">
 						<label>Name</label>
 						<input type="text" name="name" value="<?php echo $row['user_name']; ?>" />
 						<span class="color-massage"><?=@$name_msg?></span>
 					</div>

 					<div class="form-group">
 						<label>Email</label>
 						<input type="text" name="email" value="<?php echo $row['user_email']; ?>">
 						<span class="color-massage"><?=@$email_msg?></span>
 					</div>

 					<div class="form-group">
 						<label>Phone Number</label>
 						<input type="number" name="number" value="<?php echo $row['user_mobile_no']; ?>">
 						<span class="color-massage"><?=@$number_msg?></span>
 					</div>
 					<div class="form-group">
 						<label>Photo</label>
 						<input type="file" name="image" value="<?=$row['user_image'];?>">
 						<input type="hidden" name="old_image" value="<?=$row['user_image'];?>">
 						<img src="image/<?= $row['user_image']; ?>" width="50">
 						<span class="color-massage"><?=@$image_msg?></span>
 					</div>
 					<input type="hidden" name="update_id" value="<?=$row['id'];?>">
                    <input class="submit" type="submit" name="submit" value="Update" >
 				</form>
 			<?php } 
 		} 
 	}  
 	?>
 </body>
 </html>