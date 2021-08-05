<?php 
     if(!isset($_COOKIE['user_id'])){
        header("Location: login.php");
         }else{

         }
    
?>
<?php include('includes/header.php');
?>
                      

    <!-- Breadcrumb Area Start -->
    <div class="section breadcrumb-area bg-name-bright">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-wrapper">
                        <h2 class="breadcrumb-title">My Account</h2>
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li style="color:#ffffff">My Account</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End -->

    <!-- My Account Section Start -->
    <div class="section section-margin">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">

                    <!-- My Account Page Start -->
                    <div class="myaccount-page-wrapper">
                        <div class="row">

                            <!-- My Account Tab Menu Start -->
                            <div class="col-lg-3 col-md-4">
                                <div class="myaccount-tab-menu nav" role="tablist">
                                    <a href="#dashboad" class="active" data-bs-toggle="tab"><i class="fa fa-tachometer"></i>
                                        Dashboard</a>
                                    <a href="#orders" data-bs-toggle="tab"><i class="fa fa-arrow-right"></i> Your Bids</a>
                                    <a href="#address-edit" data-bs-toggle="tab"><i class="fa fa-map-marker"></i> address</a>
                                    <a href="#account-info" data-bs-toggle="tab"><i class="fa fa-user"></i> Account Details</a>
                                    <a href='core/actions.php?signout=1'><i class='fa fa-sign-out'></i> Logout</a>
                                </div>
                            </div>
                            <!-- My Account Tab Menu End -->

                            <!-- My Account Tab Content Start -->
                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content" id="myaccountContent">

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3 class="title">Dashboard</h3>
                                            <div class="welcome">
<?php
include 'assets/db.php';
$user_id = $_COOKIE['user_id'];
$prod = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM user WHERE id = '$user_id'"));
?>
                                                <p>Hello, <strong><?php echo $prod['user_name'];?></strong> </p>
                                            </div>
                                            <p class="mb-0">From your account dashboard. you can easily check & view your recent orders, manage your shipping and billing addresses and edit your password and account details.</p>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                    


                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="orders" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3 class="title">Orders</h3>
                                            <div class="myaccount-table table-responsive text-center">
                                                <table class="table table-bordered">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Your Bid Price</th>
                                                            <th>Product Name</th>
                                                            <th>Product Bid Price</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <?php 
                    $s = 0;
                   $sql ="SELECT * FROM user_bid WHERE user_id = '$user_id'";
                   $query =mysqli_query($conn,$sql);
                   while ($data = mysqli_fetch_array($query)) {
                       $pid=$data['p_id'];
                       $sql1 ="SELECT * FROM products WHERE id = '$pid'";
                       $query1 =mysqli_query($conn,$sql1);
                   while ($data1 = mysqli_fetch_array($query1)) {
                    $s++;
                ?>
                    <tbody>
                                                        <tr>
                                                            <td><?php echo $s;?></td>
                                                            <td>Rs.<?php echo $data['price'];?></td>
                                                            <td><?php echo $data1['name'];?></td>
                                                            <td>Rs.<?php echo $data1['price'];?></td>
                                                            <td>  <?php 
                        $status = $data['status'];
                        if($status == 0){
                    ?>
                    Bid In Process
                    <?php }
                    elseif($status == 1){ ?>
                    <form id="COD" method="post">
                    <input type="hidden" name="COD" value="1">
                    <input type="hidden" name="p_id" value="<?php echo $pid;?>">
                    <input type="hidden" name="b_id" value="<?php echo $data['id'];?>">
                    <input type="hidden" name="p_method" value="COD">
                    <button type="submit" class="btn btn btn-primary btn-hover-dark rounded-0 mb-2">COD</button>
                    </form>                    
                    <form action="strip.php" method="GET">
                    <input type="hidden" name="p_id" value="<?php echo $pid;?>">
                    <input type="hidden" name="b_id" value="<?php echo $data['id'];?>">
                    <input type="hidden" name="price" value="<?php echo $data1['price'];?>">
                    <input type="hidden" name="p_method" value="Card">
                    <input type="hidden" name="bidorder" value="1">
                    <button type="submit" class="btn btn btn-primary btn-hover-dark rounded-0">Pay With Card</button>
                    </form>  
                    <?php }
                    elseif($status == 2){ ?>
                    Order Placed For This Bid
                    <?php } 
                    elseif($status == 3){ ?>
                        Bid Rejected
                    <?php }
                    elseif($status == 4){
                         ?>
                        Bid Completed 
                    <?php } ?>
                    </td>
                                                           
                                                        </tr>
                                                        
                                                        
                                                    </tbody>
                                                    <?php } }?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                 


                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3 class="title">Billing Address</h3>
                                            <address>
                                            <?php $user_id = $_COOKIE['user_id'];
$user = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM user WHERE id = '$user_id'"));
?>
                                                <p><strong><?php echo $user['user_name'];?></strong></p>
                                                <p>Mobile: <?php echo $user['user_mobile'];?></p>
                                            </address>
                                            
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->
                                    <?php $user_id = $_COOKIE['user_id'];
$user = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM user WHERE id = '$user_id'"));
?>
                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="account-info" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3 class="title">Account Details</h3>
                                            <div class="account-details-form">
                                                <form id="updateuser" method="post">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item m-b-15">
                                                                <label for="first-name" class="required m-b-10">User Name</label>
                                                                <input type="text" name="user_name" value="<?php echo $user['user_name'];?>" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item m-b-15">
                                                                <label for="email" class="required m-b-10">Email</label>
                                                                <input type="email" name="user_email" value="<?php echo $user['user_email'];?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="single-input-item m-b-15">
                                                        <label for="password" class="required m-b-10">Password</label>
                                                        <input type="text" name="user_password" value="<?php echo $user['user_password'];?>" />
                                                    </div>
                                                    <div class="single-input-item m-b-15">
                                                        <label for="number" class="required m-b-5">Ph#</label>
                                                        <input type="text" name="user_mobile" value="<?php echo $user['user_mobile'];?>" />
                                                    </div>
                                                    <input type="hidden" name="updateuser" value="1">
                                                    <div class="single-input-item single-item-button m-t-30">
                                                        <button  type="submit" class="btn btn btn-primary btn-hover-dark rounded-0">Save Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div> <!-- Single Tab Content End -->

                                </div>
                            </div>
                            <!-- My Account Tab Content End -->

                        </div>
                    </div>
                    <!-- My Account Page End -->

                </div>
            </div>

        </div>
    </div>
    <!-- My Account Section End -->
    <script>
      $('#updateuser').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
          type: 'post',
          url: 'core/actions.php',
          data: $('#updateuser').serialize(),
          success: function (val) {
            console.log(val);
            if (val == 1) {
              setTimeout(function () {
                location.reload();
              }, 500);
            } else {
              setTimeout(function () {
                location.reload();
              }, 500);
            }
          }
        });
      });
      $('#COD').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
          type: 'post',
          url: 'core/actions.php',
          data: $('#COD').serialize(),
          success: function (val) {
            console.log(val);
            if (val == 1) {
              setTimeout(function () {
                location.reload();
              }, 500);
            } else {
              setTimeout(function () {
                location.reload();
              }, 500);
            }
          }
        });
      });
    </script>
    <?php include('includes/footer.php');
?>