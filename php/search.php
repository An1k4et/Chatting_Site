<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $output = "";
    $searchTerm = mysqli_real_escape_string($conn , $_POST['searchTerm']);
    $sql = mysqli_query($conn , "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%')");
    if(mysqli_num_rows($sql)){
         include_once "data.php";
    }else{
        $output .= "No users Found";
    }
    echo $output;
?>