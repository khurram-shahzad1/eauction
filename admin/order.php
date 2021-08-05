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

            <h1> Orders </h1>


        </center><!--  center Finish  -->


        <div class="table-responsive">
            <!--  table-responsive Begin  -->

            <table class="table">
                    <thead class=" text-dark">
                      <th> Id </th>
                      <th> UserName</th>
                      <th >User Biding Price</th>
                      <th >Product Name</th>
                      <th >Product Image</th>
                      <th >Product Biding Price</th>
                      <th >Payment Method </th>
                      <th >Status </th>
                    </thead>
                    <?php 
                    include '../assets/db.php';
                    $s = 0;
                   $sql ="SELECT * FROM orders ";
                   $query =mysqli_query($conn,$sql);
                   while ($data = mysqli_fetch_array($query)) {
                       $user = $data['user_id'];
                       $prodId = $data['p_id'];
                       $bId = $data['b_id'];
                       $fn = mysqli_fetch_array(mysqli_query($conn, "SELECT user_name FROM user WHERE id = '$user'"))[0];
                       $prod = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM products WHERE id = '$prodId'"));
                       $brod = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM user_bid WHERE id = '$bId'"));
                    $s++;
                ?>
                    <tbody>
                     <tr>
                     <td><?php echo $s;?></td>
                     <td><?php echo $fn;?></td>
                     <td><?php echo $brod['price'];?></td>
                     <td><?php echo $prod['name'];?></td>
                     <td><img src="../assets/images/products/<?php echo $prod['image'];?>" width="100px" height="100px"></td>
                     <td><?php echo $prod['price'];?></td>
                     <td><?php echo $data['p_method'];?></td>
                    <td>
                    <?php 
                        $status = $data['status'];
                        if($status == 0){
                    ?>
                     <form id="acceptOrder" method="post">
                    <input type="hidden" name="acceptOrder" value="1">
                    <input type="hidden" name="b_id" value="<?php echo $bId;?>">
                    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                     <button type="submit" class="btn btn-success mb-2">Accept</button>
                     </form>
                     <form id="rejectOrder" method="post">
                    <input type="hidden" name="rejectOrder" value="1">
                    <input type="hidden" name="b_id" value="<?php echo $bId;?>">
                    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                    <button type="submit" class="btn btn-danger">Reject</button>
                    </form>
                    <?php }
                    elseif($status == 1){ ?>
                    Completed
                    <?php }
                    elseif($status == 2){ ?>
                    Rejected
                    <?php } ?>
                    </td>
          
                     </tr>
                    </tbody>
                    <?php } ?>
                  </table>

        </div><!--  table-responsive Finish  -->
    </div>
    <script>
        
        $('#acceptOrder').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
          type: 'post',
          url: 'core/actions.php',
          data: $('#acceptOrder').serialize(),
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
      $('#rejectOrder').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
          type: 'post',
          url: 'core/actions.php',
          data: $('#rejectOrder').serialize(),
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
</body>

</html>