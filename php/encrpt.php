<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $incoming_id = mysqli_real_escape_string($conn , $_POST['incoming_id']);
        $outgoing_id = mysqli_real_escape_string($conn , $_POST['outgoing_id']);
        $message = mysqli_real_escape_string($conn , $_POST['message']);

        $rand = rand(time() , 10000000);
        echo $rand;

        $enc_message = openssl_encrypt($message, "AES-128-CTR", $rand, 0, '1234567891011121');
        
       
        if(!empty($message)){
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_id, outgoing_id , msg)
                                VALUES ({$incoming_id}, {$outgoing_id} ,'{$enc_message}')") or die();
        }
    }else{
        header("login.php");
    }
?>