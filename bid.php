<?php 
     if(!isset($_COOKIE['user_id'])){
        header("Location: login.php");
         }else{

         }
    
?>
<?php include('includes/header.php');
?>
 <?php
include 'assets/db.php';
if(isset($_GET['prodid'])){
    $prodid = $_GET['prodid'];
    }
?>  

<!-- Breadcrumb Area Start -->
<div class="section breadcrumb-area bg-name-bright">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="breadcrumb-wrapper">
                    <h2 class="breadcrumb-title">Bid For Product Here</h2>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li>Bid Here</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->
<!-- Contact Us Section Start -->
<div class="section section-margin">

    <div class="container">
  
        <div class="row m-b-n50">
            <div class="col-12 col-lg-12 m-b-50 order-2 order-lg-1" data-aos="fade-up" data-aos-duration="1000">
    <!--contact area start-->
    <div class="contact_area">
        <div class="container ">   
            <div class="row ">
            <div class="col-lg-2 col-md-12"></div>               
                <div class="col-lg-8 col-md-12 shadow p-5">
                   <div class="contact_message ">
                        <h3>Bid Here</h3> 
                        <form id="bidform">
                                <div class="form-group mb-3">
                                    <label>Enter Your Bid</label>
                                    <input type="number" class="form-control" name="price" min="0" required placeholder="Add Your Bid Price">
                                </div>
                                <input type="hidden" name="bidform" value="1">
                            <input type="hidden" name="productid" value="<?php echo $prodid;?>">
                                <div class="col-12">
                                        <button type="submit" id="submit" name="submit"
                                            class="btn btn-primary btn-hover-dark">Bid Now</button>
                                    </div>
                        </form> 

                    </div> 
                </div>
        </div>    
    </div>

    <!--contact area end-->
<br>
<br><br>
            </div>

        </div>

    </div>
</div>
<!-- Contact us Section End -->



<?php include('includes/footer.php');
?>
<script>
      $('#bidform').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
          type: 'post',
          url: 'core/actions.php',
          data: $('#bidform').serialize(),
          success: function (val) {
            console.log(val);
            if (val == 1) {
              setTimeout(function () {
                location.replace("my-account.php");
              }, 500);
            } else if(val == 2) {
              setTimeout(function () {
                alert("You Have Already Bid For This Product!");
              }, 500);
            }
            else{
              setTimeout(function () {
                alert("Error Occur!");
              }, 500);
            }
          }
        });
      });

</script>