<?php

// database connection 
// database name is " contact_book " 

$con = mysqli_connect("localhost", "root","","contact_book");


if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}