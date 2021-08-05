<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
</head>

<body>




    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                    <a class="nav-link" href="users.php">Users <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="order.php">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="bid.php">User Bids</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Messages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="core/actions.php?signout=1">Sign Out</a>
                </li>

            </ul>

        </div>
    </nav>
    <div class="container">
        <center>
            <!--  center Begin  -->

            <h1> All Bids</h1>


        </center><!--  center Finish  -->


        <div class="table-responsive">
            <!--  table-responsive Begin  -->

            <table class="table">
                    <thead class=" text-dark">
                      <th> Id </th>
                      <th >Product Name</th>
                      <th >Product Image</th>
                      <th >Product Bid Price</th>
                      <th> User Name</th>
                      <th> User Email</th>
                      <th> User Bid Price</th>
                      <th >Status </th>
                    </thead>
                    <?php 
                    include '../assets/db.php';
                    $s = 0;
                   $sql ="SELECT * FROM user_bid";
                   $query =mysqli_query($conn,$sql);
                   while ($data = mysqli_fetch_array($query)) {
                       $prodId = $data['p_id'];
                       $userId = $data['user_id'];
                       $prod = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM products WHERE id = '$prodId'"));
                       $user = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM user WHERE id = '$userId'"));
                    $s++;
                ?>
                    <tbody>
                     <tr>
                     <td><?php echo $s;?></td>
                     <td><?php echo $prod['name'];?></td>
                     <td><img src="../assets/images/products/<?php echo $prod['image'];?>" width="100px" height="100px"></td>
                     <td><?php echo $prod['price'];?></td>
                     <td><?php echo $user['user_name'];?></td>
                     <td><?php echo $user['user_email'];?></td>
                     <td><?php echo $data['price'];?></td>
                    <td>
                    <?php 
                        $status = $data['status'];
                        if($status == 0){
                    ?>
                     <button class="btn btn-success acceptbid " bid="<?php echo $data['id']; ?>">Accept</button>
                    <button class="btn btn-danger rejectbid" bid="<?php echo $data['id']; ?>">Reject</button>
                    <?php }
                    elseif($status == 1){ ?>
                    Bid Accepted
                    <?php }
                    elseif($status == 2){ ?>
                    Order Placed
                    <?php } 
                    elseif($status == 3){?>
                        Rejected
                    <?php }
                    elseif($status == 4){ ?>
                    Completed
                    <?php } ?>
                    </td>
          
                     </tr>
                    </tbody>
                    <?php } ?>
                  </table>

        </div><!--  table-responsive Finish  -->
    </div>
    <script>
      
        $(function () {
        $('.acceptbid').on('click', function (e) {
            e.preventDefault();
            var bidId = $(this).attr('bid');
            $.ajax({
                url: 'core/actions.php',
                type: 'POST',
                data: {
                    acceptbid: bidId
                },
                success: function (val) {
                    console.log(val);
                    location.reload();
                }
            })
        })
        $('.rejectbid').on('click', function (e) {
            e.preventDefault();
            var bidId  = $(this).attr('bid');
            $.ajax({
                url: 'core/actions.php',
                type: 'POST',
                data: {
                    rejectbid: bidId 
                },
                success: function (val) {
                    console.log(val);
                    location.reload();
                }
            })
        })
    })
    </script>
</body>

</html>