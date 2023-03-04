<?php

$conn = new mysqli('localhost', 'root', 'root@123', 'stockmanagement');
  
if ($conn->connect_errno) {
    echo "Error: " . $conn->connect_error;
}
?>