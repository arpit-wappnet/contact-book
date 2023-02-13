<?php 
include "config.php";

$sql = "SELECT * FROM `users`";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) 
{
 ?>


<!doctype html>
    <html>
    <head>
  
       <style type="text/css">
       a.space {
        padding-left: 40px;
    }
    </style>
</head>
<body>

</head>
<body>
  
<div id="wrapper">
    <div id="header">
        <h1>Contact list</h1>
    </div>
    <div id="menu">
        <ul>

            <li>
                <a href="add.php">Add</a>
            </li>
        </ul>
    </div>
    
    <h2>All Records</h2>
    <table cellpadding="7px">
        <thead>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>phone</th>
            <th>Image</th>
            <th>Action</th>
        </thead>
        <tbody>

            
             <?php
            while ($row = mysqli_fetch_assoc($result))
            {
             ?>
             <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['user_name']; ?></td>
                <td><?php echo $row['user_email']; ?></td>
                <td><?php echo $row['user_mobile_no']; ?></td>
                <td><img src="<?php echo 'image/'.$row['user_image']; ?>" width="100"></td>
                <td>
                    <a href='edit.php?id=<?php echo $row['id']; ?>'>Edit</a>
                   <a href='delete.php?id=<?php echo $row['id']; ?>'>Delete</a>
                </td>
            </tr>
            <tr>

           <?php 

            }
}
           ?>

    </tr>
</tbody>

</table>
<tfoot>
   



</tfoot>

</body>
</html>