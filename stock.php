<?php
include("config.php");

$sname=  $_POST["stockname"];

$sql="INSERT into stocktype(stockname) 
values('$sname')";
$result=mysqli_query($conn,$sql);

?>