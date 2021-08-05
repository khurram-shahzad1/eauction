<?php 
// Include configuration file  
require_once 'config.php'; 
 
$payment_id = $statusMsg = ''; 
$ordStatus = 'error'; 
 
// Check whether stripe token is not empty 
if(!empty($_POST['stripeToken'])){ 
     
	\Stripe\Stripe::setVerifySslCerts(false);
    // Retrieve stripe token, card and user info from the submitted form data 
    $token  = $_POST['stripeToken']; 
    $name = $_POST['name']; 
    $email = $_POST['email'];
    $user_id=$_COOKIE['user_id'];
    $p_id=$_GET['p_id'];
    $b_id=$_GET['b_id'];
    $p_method=$_GET['p_method'];
    $price=$_GET['price']; 
     
    // Add customer to stripe 
    try {  
        $customer = \Stripe\Customer::create(array( 
            'email' => $email, 
            'source'  => $token 
        )); 
    }catch(Exception $e) {  
        $api_error = $e->getMessage();  
    } 
     
    if(empty($api_error) && $customer){  
         
        // Convert price to cents 
        $itemPriceCents = ($price*100); 
        $currency = "usd"; 
        // Charge a credit or a debit card 
        try {  
            $charge = \Stripe\Charge::create(array( 
                'customer' => $customer->id, 
                'amount'   => $itemPriceCents, 
                'currency' => $currency, 
                'description' => $token 
            )); 
        }catch(Exception $e) {  
            $api_error = $e->getMessage();  
        }  
            if($charge){
            
                require 'assets/db.php'; 
                 
                $sql="INSERT INTO `orders`(`user_id`, `p_method`, `p_id`,`b_id`) VALUES ('$user_id','$p_method','$p_id','$b_id')";       
                $query=mysqli_query($conn, $sql);
                if ($query) {
                    $update="UPDATE user_bid SET `status` = '2' WHERE id = '$b_id'";
                    $run_update=mysqli_query($conn, $update);
                    $payment_status = "succeeded";
                }
                // Insert tansaction data into the database 
                else{
            $payment_status = "Failed"; 
        }
        if($payment_status == 'succeeded'){ 
                    $ordStatus = 'success'; 
                    $statusMsg = 'Your Payment has been Successful!'; 
        }else{ 
                    $statusMsg = "Your Payment has Failed!"; 
            } 
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en-US">
<head>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="stripe-php-master/img/favicon.ico">
        <link rel="apple-touch-icon-precomposed" href="stripe-php-master/img/apple-touch-icon/180x180.png">
        <link rel="icon" href="stripe-php-masterimg/apple-touch-icon/180x180.png">
        <meta name="description" content="Live Demo at CodexWorld - Stripe Payment Gateway Integration in PHP by CodexWorld">
        <meta name="keywords" content="demo, codexworld demo, project demo, live demo, tutorials, programming, coding">
        <meta name="author" content="CodexWorld">
        <title>Stripe Payment Gateway Integration </title>
        <!-- Bootstrap core CSS -->
        <link href="http://demos.codexworld.com/includes/css/bootstrap.css" rel="stylesheet">
        <!-- Add custom CSS here -->
        <link href="http://demos.codexworld.com/includes/css/style.css" rel="stylesheet">
		
		<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        
<!-- Stylesheet file -->
<link rel="stylesheet" href="stripe-php-master/css/style.css">
	

</head>
<body>
<div class="container">
    <div class="status">
        <?php if($payment_status=="succeeded"){ ?>
            <h1 class="<?php echo $ordStatus; ?>"><?php echo $statusMsg; ?></h1>
        <?php }else{ ?>
            <h1 class="error">Your Payment has Failed</h1>
        <?php } ?>
    </div>
    <a href="index.php" class="btn-link">Back to Home</a>
</div>

</body>
</html>