<?php
require '../assets/db.php';


if (isset($_POST['signUpForm'])) {
    $user_name=$_POST['user_name'];
    $user_email=$_POST['user_email'];
    $user_mobile=$_POST['user_mobile'];
    $user_password=$_POST['user_password'];
    $sql_e = "SELECT * FROM user WHERE user_email='$user_email'";
    $res_e = mysqli_query($conn, $sql_e);	
    if(mysqli_num_rows($res_e) > 0){
        echo 0;
      }
    elseif ($user_name==""|| $user_email==""|| $user_password==""|| $user_mobile=="") {
        echo 1;
    }

    else {
        $sql="INSERT into `user` (user_name,user_email,user_password,user_mobile) VALUES ('$user_name','$user_email' , '$user_password', '$user_mobile')";

        $query=mysqli_query($conn, $sql);

        if ($query) {
            echo 2;
        }

        else {
            echo 1;
        }
    }
}


if (isset($_POST['contactForm'])) {
    $name=$_POST['name'];
    $email=$_POST['email'];
    $subject=$_POST['subject'];
    $message=$_POST['message'];
 if ($name==""|| $email==""|| $subject==""|| $message=="") {
        echo 0;
    }

    else {
        $sql="INSERT into `contact` (name,email,subject,message) VALUES ('$name','$email' , '$subject', '$message')";

        $query=mysqli_query($conn, $sql);

        if ($query) {
            echo 1;
        }

        else {
            echo 0;
        }
    }
}



if (isset($_POST['updateuser'])) {
    $user_name=$_POST['user_name'];
    $user_email=$_POST['user_email'];
    $user_mobile=$_POST['user_mobile'];
    $user_password=$_POST['user_password'];
    $userId=$_COOKIE['user_id'];
    if ($user_name==""|| $user_email==""|| $user_password==""|| $user_mobile=="") {
        echo 0;
    }

    else {
        $sql="UPDATE user SET `user_name` = '$user_name' , `user_email`='$user_email' , `user_mobile`='$user_mobile' , `user_password`='$user_password' WHERE id = '$userId'";

        $query=mysqli_query($conn, $sql);

        if ($query) {
            echo 1;
        }

        else {
            echo 0;
        }
    }
}


if (isset($_POST['signInForm'])) {
    $user_email=$_POST['user_email'];
    $user_password=$_POST['user_password'];

    if ($user_email==""|| $user_password=="") {
        echo "0";
    }
    else {
            $sql="SELECT * FROM `user` WHERE user_email = '$user_email' AND `user_password` = '$user_password'";

            $query=mysqli_query($conn, $sql);

            if (mysqli_num_rows($query) > 0) {

                $data=mysqli_fetch_array($query);

                setcookie("user_id", $data['id'], time() + (86400 * 3), '/');

                echo $data['id'];

            }

            else {
                echo "0";
            }
        }
    }

    if (isset($_GET['signout'])) {

        setcookie("user_id", "", time() - 3600, '/');
    
        header("Location: ../index.php");
    }

  

    
if (isset($_POST['COD'])) {
    $user_id=$_COOKIE['user_id'];
    $b_id=$_POST['b_id'];
    $p_method=$_POST['p_method'];
    $p_id=$_POST['p_id'];
    if ($user_id=="" || $p_id=="" || $p_method=="" || $b_id=="") {
        echo "0";
    }

    else {
        $sql="INSERT INTO `orders`(`user_id`, `p_method`, `p_id`,`b_id`) VALUES ('$user_id','$p_method','$p_id','$b_id')";       
        $query=mysqli_query($conn, $sql);
        if ($query) {
            $sql1="UPDATE user_bid SET `status` = '2' WHERE id = '$b_id'";
            $query1=mysqli_query($conn, $sql1);
            if($query1){
            echo "1";
        }else {
            echo "0";
        }
        }
        else {
            echo "0";
        }
    }
}

if(isset($_POST['bidform'])) {
    $price = $_POST['price'];
    $productid = $_POST['productid'];
    $userId = $_COOKIE['user_id'];
    $sql_e = "SELECT * FROM user_bid WHERE p_id='$productid' AND user_id='$userId'";
    $res_e = mysqli_query($conn, $sql_e);	
    if(mysqli_num_rows($res_e) > 0){
        echo "2";
      }else{
        $insert = mysqli_query($conn, "INSERT into user_bid (`user_id`,`p_id`,`price` ) VALUES ('$userId','$productid','$price')");
        if($insert){
            echo "1";
        }else{
            echo "0";
        }
    } 
}




?>