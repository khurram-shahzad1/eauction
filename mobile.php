<?php include('includes/header.php');
?>

                     

    <!-- Breadcrumb Area Start -->
    <div class="section breadcrumb-area bg-name-brighto" >
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-wrapper">
                        <h2 class="breadcrumb-title">Mobiles</h2>
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li style="color:#ffffff">Mobiles</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End -->

    <!-- Shop Section Start -->
    <div class="section section-margin">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Shop Wrapper Start -->
                    <div class="row shop_wrapper grid_4">
                    <?php
include 'assets/db.php';
$sql = "SELECT * FROM products WHERE cat_id='1'";
$query = mysqli_query($conn, $sql);
$s = 1 ;


?>
 <?php while ($data = mysqli_fetch_array($query)) { 
            $prodId = $data['id'];
            $catId = $data['cat_id'];
            $sql1 = "SELECT * FROM categories where id='$catId' ";
$query1 = mysqli_query($conn, $sql1);
while ($data1 = mysqli_fetch_array($query1)) { 

            ?>
                        <!-- Single Product Start -->
                        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 product">
                            <div class="product-inner">
                                <div class="thumb">
                                    <a href="single-product.php?prodid=<?php echo $prodId; ?>" class="image">
                                        <img class="fit-image" src="assets/images/products/<?php echo $data['image']; ?>" alt="Product" />
                                    </a>
                                    <div class="action-wrapper">
                                       <a href="single-product.php?prodid=<?php echo $prodId; ?>" class="action cart" title="Cart"><i class="fa fa-eye"></i></a>
                                    </div>
                                </div>
                                <div class="content">
                                    <h5 class="title"><a href="single-product.php?prodid=<?php echo $prodId; ?>"><?php echo $data['name']; ?></a></h5>
                                    <span class="content">
                                            <span class="title"><?php echo  $data1['name']; ?></span>
                                   
                                    </span>
                                    <span class="price">
                                            <span class="new">$<?php echo  $data['price']; ?></span>
                                   
                                    </span>
                                     <!-- Cart Button Start -->
                                    <div class="cart-btn action-btn">
                                        <div class="action-cart-btn-wrapper d-flex">
                                            <div class="add-to_cart">
                                                <a class="btn btn-primary btn-hover-dark rounded-0" href="single-product.php?prodid=<?php echo $prodId; ?>">Add to cart</a>
                                            </div>
                                           </div>
                                    </div>
                                    <!-- Cart Button End -->
                                </div>
                            </div>
                        </div>
                        <!-- Single Product End -->
                        <?php } } ?>

            

                      

                    </div>
                    <!-- Shop Wrapper End -->


                </div>
            </div>
        </div>
    </div>
    <!-- Shop Section End -->
    <?php include('includes/footer.php');
?>