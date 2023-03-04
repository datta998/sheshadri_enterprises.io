<?php

include("config.php");

$id=$_POST["id"];

$sql='select p.*,s.StockName from products p,StockType s where p.isactive=1 and p.stocktype=s.Id and p.id='.$id;
$result=mysqli_query($conn,$sql);
$rows = array();
while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
}
print json_encode($rows);
?>