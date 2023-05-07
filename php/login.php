<?php
    session_start();
    include_once "config.php";
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $encrypt_pass = md5($password);
    if(!empty($email) && !empty($password)){
        $sql = mysqli_query($conn , "SELECT * FROM users WHERE email = '{$email}' AND password = '{$encrypt_pass}'"); // Checking email and password in database
        if(mysqli_num_rows($sql) > 0){ //if users found
            $row = mysqli_fetch_assoc($sql);
            $status = "Active now";
            //Updating users status to Active now
            $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
            if($sql2){
                $_SESSION['unique_id'] = $row['unique_id'];
                echo "success";
            }
        }else{
            echo "Email or Password is incrorrect";
        }
    }else{
        echo "All Inputs are required";
    }
?>