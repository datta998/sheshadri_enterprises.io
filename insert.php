<?php
include("config.php");


$action = isset($_POST['action']) != '' ? $_POST['action'] : '';

$pname=  $_POST["productname"];
$wprice=  $_POST["wholesaleprice"];
$rprice=  $_POST["retailprice"];
$squantity=  $_POST["stockquantity"];
$stype=  $_POST["stocktype"];
$id=$_POST["pid"];
$currenttime=date('Y-m-d H:i:s');;
if($action=="add")
{
$sql="INSERT into products(name,wholesaleprice,retailprice,stock,isactive,stocktype,createddate,updateddate) 
values('$pname','$wprice','$rprice','$squantity',1,$stype,'$currenttime','$currenttime')";
$result=mysqli_query($conn,$sql);
}
else if($action=="edit")
{
    $sql="Update products set name='".$pname."',wholesaleprice='".$wprice."',retailprice='".$rprice."',stock='".$squantity."',isactive=1,stocktype='".$stype."',updateddate='".$currenttime."'where id=".$id; 
    $result=mysqli_query($conn,$sql);
}

?>