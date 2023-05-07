<?php 
    session_start();
    include_once "config.php";
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
        //checking email valid or not\
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            //checking email already exist
            $sql = mysqli_query($conn, "SELECT email FROM users where email = '{$email}' ");
            if(mysqli_num_rows($sql) > 0){
                echo "$email - This email already exist!"; //if email already exist
            }else{
                if(isset($_FILES['image'])){//checking file is uploaded or not
                    $img_name = $_FILES['image']['name'];
                    $tmp_name = $_FILES['image']['tmp_name'];
                    $img_explode = explode('.',$img_name);
                    $img_ext=end($img_explode);
                    $extension = ['png','jpeg','jpg'];
                    if(in_array($img_ext,$extension) == true){
                        $time = time(); //storing image with time

                        $new_img_name=$time.$img_name;
                        if(move_uploaded_file($tmp_name, "images/".$new_img_name)){
                            $status = 'Active now'; //if user uploaded two different image with same name then particular image name added with time
                            $rand_id = rand(time() , 10000000);// creating random unique id
                            $encypt_pass = md5($password);

                            $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status) VALUES ({$rand_id},'{$fname}','{$lname}','{$email}','{$encypt_pass}','{$new_img_name}','{$status}')");
                            if($sql2){
                                $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                                if(mysqli_num_rows($sql3) > 0){
                                    $row = mysqli_fetch_assoc($sql3);
                                    $_SESSION['unique_id'] = $row['unique_id'];
                                    echo "success"; //using this session we can used unique id in other php
                                }
                            }else{
                                echo "Something went wrong!";
                            }
                        }                       
                        
                    }else{
                        echo "Please select an Image file! - .jpg .jpeg .png";
                    }
                }else{
                    echo "Please select an Image file!"; 
                }
            }
        }else{
            echo "$email - This is not a valid email!";
        }
    }else{
        echo "All input required";
    }
?>