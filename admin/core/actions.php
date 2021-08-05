<?php 
include '../../assets/db.php';
   
if (isset($_POST['signin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `admin` WHERE email='$email' AND `password`='$password'";
    $query = mysqli_query($conn,$sql);
    $data = mysqli_num_rows($query);

    if ($data == "0") {
        echo 0;
    
    }else{
        echo 1;
        $info = mysqli_fetch_array($query);
        $uid = $info['id'];
        setcookie ('admin_id',$uid,time() + 84600*7 , '/');
    }
}

if (isset($_GET['signout'])) {
    setcookie ("admin_id", "", time() - 3600, '/');
    header("Location: ../index.php");
}

if(isset($_POST['newProduct'])) {
    $cat = $_POST['catId'];
    $details = $_POST['details'];
    $color = $_POST['color'];
    $name = $_POST['pname'];
    $price = $_POST['price'];
    $discription = $_POST['discription'];

    $target_dir = "../../assets/images/products/";
    $target_file = basename($_FILES["productImage"]["name"]);

    $path = $target_dir . $target_file;
    if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $path)) {
        $insert = mysqli_query($conn, "INSERT into products (cat_id ,`name`, `discription`, price, `image`,`details`,`color`) VALUES ('$cat', '$name', '$discription', '$price', '$target_file', '$details', '$color') ");
        if($insert){
            echo 1;
        }else{
            echo mysqli_error($conn);
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

if (isset($_POST['formpro'])) {
    $id = $_POST['proid'];
    $cat = $_POST['catId'];
    $name = $_POST['pname'];
    $price = $_POST['price'];
    $details = $_POST['details'];
    $color = $_POST['color'];
    $discription = $_POST['discription'];

    if($_FILES['productImage']['name'] != ""){
        $target_dir = "../../assets/images/products/";
        $target_file = basename($_FILES["productImage"]["name"]);
    
        $path = $target_dir . $target_file;
        
        if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $path)) {
            $update = mysqli_query($conn, "UPDATE products SET  cat_id ='$cat', `name`='$name' , `discription`='$discription' , price='$price', `image` = '$target_file' , `details` = '$details', `color` = '$color' WHERE id='$id'");
            if($update == '1'){
                echo '1';
            }else{
                echo mysqli_error($conn);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}


if(isset($_POST['delid'])){
    $id = $_POST['id'];

    $sql = "DELETE FROM user WHERE id='$id'";
    $query = mysqli_query($conn,$sql);

    if($query == "1"){
        echo 1;
    }else{
        echo 0;
        echo mysqli_error($conn);
    }
}


if(isset($_POST['delmsgid'])){
    $id = $_POST['id'];

    $sql = "DELETE FROM contact WHERE id='$id'";
    $query = mysqli_query($conn,$sql);

    if($query == "1"){
        echo 1;
    }else{
        echo 0;
        echo mysqli_error($conn);
    }
}



if (isset($_POST['delProduct'])) {
    $id = $_POST['id'];

    $image = mysqli_fetch_array(mysqli_query($conn, "SELECT `image` FROM products WHERE id = '$id'"))[0];

    unlink("../../assets/images/products/$image");

    $sql = "DELETE  FROM products WHERE id='$id'";
    $query = mysqli_query($conn,$sql);

    if ($query == "1") {
        echo 1;
    }else{
        echo 0;
        mysqli_error($conn);
    }
}


if(isset($_POST['acceptbid'])){
    $bid = $_POST['acceptbid'];

    echo mysqli_query($conn,"UPDATE user_bid SET `status` = '1' WHERE id = '$bid'");

}
if(isset($_POST['rejectbid'])){
    $bid = $_POST['rejectbid'];

    echo mysqli_query($conn,"UPDATE user_bid SET `status` = '3' WHERE id = '$bid'");
}


if (isset($_POST['acceptOrder'])) {
    $b_id=$_POST['b_id'];
    $id=$_POST['id'];
    if ($id==""|| $b_id=="") {
        echo "0";
    }
    else {
        $sql="UPDATE orders SET `status` = '1' WHERE id = '$id'";       
        $query=mysqli_query($conn, $sql);
        if ($query) {
            $sql1="UPDATE user_bid SET `status` = '4' WHERE id = '$b_id'";
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
if (isset($_POST['rejectOrder'])) {
    $b_id=$_POST['b_id'];
    $id=$_POST['id'];
    if ($id==""|| $b_id=="") {
        echo "0";
    }
    else {
        $sql="UPDATE orders SET `status` = '2' WHERE id = '$id'";       
        $query=mysqli_query($conn, $sql);
        if ($query) {
            $sql1="UPDATE user_bid SET `status` = '3' WHERE id = '$b_id'";
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

?>