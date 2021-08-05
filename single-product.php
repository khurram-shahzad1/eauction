<?php include('includes/header.php');
?>
 <?php
include 'assets/db.php';
if(isset($_GET['prodid'])){
    $prodid = $_GET['prodid'];
    $sql = "SELECT * FROM products WHERE id = '$prodid'";
    $query = mysqli_query($GLOBALS['conn'], $sql);
    $data = mysqli_fetch_array($query);
    }
?>                      

    <!-- Breadcrumb Area Start -->
    <div class="section breadcrumb-area bg-name-bright">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-wrapper">
                        <h2 class="breadcrumb-title">Single Product</h2>
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li>Single Product</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End -->

    <!-- Single Product Section Start -->
    <div class="section section-margin">
        <div class="container">
            <div class="row">

                <div class="col-lg-5 offset-lg-0 col-md-8 offset-md-2">

                    <!-- Product Details Image Start -->
                    <div class="product-details-img">

                        <!-- Single Product Image Start -->
                        <div class="single-product-img swiper-container product-gallery-top">
                            <div class="swiper-wrapper popup-gallery">

                                <a class="swiper-slide w-100" href="assets/images/products/<?php echo $data['image']?>">
                                    <img class="w-100" src="assets/images/products/<?php echo $data['image']?>" alt="Product">
                                </a>
                        

                            </div>
                        </div>
                        <!-- Single Product Image End -->

                        <!-- Single Product Thumb Start -->
                        <div class="single-product-thumb swiper-container product-gallery-thumbs">
                        </div>
                        <!-- Single Product Thumb End -->

                    </div>
                    <!-- Product Details Image End -->

                </div>

                <div class="col-lg-7">

                    <!-- Product Summery Start -->
                    <div class="product-summery position-relative">

                        <!-- Product Head Start -->
                        <div class="product-head m-b-15">
                            <h2 class="product-title"><?php echo $data['name']?></h2>
                        </div>
                        <!-- Product Head End -->


                        <h3>Product Description</h3>
                        <!-- Description Start -->
                        <p class="desc-content m-b-25"><?php echo $data['discription']?></p>
                        <!-- Description End -->
                        <h3>Product Details</h3>
                        <p class="desc-content m-b-5"><?php echo $data['details']?></p>
                        <p class="desc-content m-b-5">Color:<?php echo $data['color']?></p>
                        <p class="desc-content m-b-5">Bidding starts from:Rs.<?php echo $data['price']?></p>
                        <!-- Cart Button Start -->
                        <div class="cart-btn action-btn m-b-30">
                            <div class="action-cart-btn-wrapper d-flex">
                                <div class="add-to_cart">
                                    <a class="btn btn-primary btn-hover-dark rounded-0" href="bid.php?prodid=<?php echo $prodid;?>">Bid Here</a>
                                </div>
                               
                            </div>
                        </div>
                        <!-- Cart Button End -->

                        <!-- Social Shear Start -->
                        <div class="social-share">
                            <div class="widget-social justify-content-start m-b-30">
                                <a title="Twitter" href="#/"><i class="icon-social-twitter"></i></a>
                                <a title="Instagram" href="#/"><i class="icon-social-instagram"></i></a>
                                <a title="Linkedin" href="#/"><i class="icon-social-linkedin"></i></a>
                                <a title="Skype" href="#/"><i class="icon-social-skype"></i></a>
                                <a title="Dribble" href="#/"><i class="icon-social-dribbble"></i></a>
                            </div>
                        </div>
                        <!-- Social Shear End -->

                       

                    </div>
                    <!-- Product Summery End -->

                </div>

            </div>
        </div>
    </div>
    <!-- Single Product Section End -->

    <?php include('includes/footer.php');
?>