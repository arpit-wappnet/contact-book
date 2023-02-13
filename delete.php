<?php

	$con_id = $_GET['id'];
    $con = mysqli_connect("localhost", "root","","contact_book");


	$sql = "DELETE FROM `users` WHERE `id` = '".$con_id."'";

	$result = mysqli_query($con, $sql);

	header('Location: http://localhost/contact_book'); 

?>