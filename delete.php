<?php

include("config.php");

$id=$_POST["id"];

$sql='delete from products where id='.$id;
$result=mysqli_query($conn,$sql);
?>