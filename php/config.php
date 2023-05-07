<?php
$conn = mysqli_connect("localhost","root","","chat");
if(!$conn){
    echo "Databse connected" . mysqli_connect_error() ;
}
?>