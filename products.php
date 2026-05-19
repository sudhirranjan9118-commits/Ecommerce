
<?php
include_once('connection.php');
session_start();

if(isset($_SESSION['auth_user']))
{
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <?php include 'admin/head.php'; ?>
    <body class="loading">
        <div id="wrapper">
            <?php include 'admin/header.php'; ?>
            <?php include 'admin/sidebar.php'; ?>
            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Products</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row justify-content-between">
                                            <div class="col-auto">
                                                <form class="d-flex flex-wrap align-items-center">
                                                    <label for="inputPassword2" class="visually-hidden">Search</label>
                                                    <div class="me-3">
                                                        <input type="search" class="form-control my-1 my-lg-0" id="inputPassword2" placeholder="Search...">
                                                    </div>
                                                    <label for="status-select" class="me-2">Sort By</label>
                                                    <div class="me-sm-3">
                                                        <select class="form-select my-1 my-lg-0" id="status-select">
                                                            <option selected="">All</option>
                                                            <option value="1">Popular</option>
                                                            <option value="2">Price Low</option>
                                                            <option value="3">Price High</option>
                                                            <option value="4">Sold Out</option>
                                                        </select>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-auto">
                                                <div class="text-lg-end my-1 my-lg-0">
                                                    <button type="button" class="btn btn-success waves-effect waves-light me-1"><i class="mdi mdi-cog"></i></button>
                                                    <a href="add-products.php" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-plus-circle me-1"></i> Add New</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php
                            $query="SELECT *from products;";
                            $products = $conn->query($query);
                            if ($products->num_rows > 0)
                            {
                                $index=1;
                                while($product = $products->fetch_object())
                                {
                                    ?>
                                    <div class="col-md-1 col-xl-3">
                                        <div class="card product-box">
                                            <div class="card-body">
                                                <div class="product-action"> 
                                                  <a href="update-products.php?id=<?php echo $product->id; ?>" class="btn btn-success btn-xs waves-effect waves-light">
                                                   <i class="mdi mdi-pencil"></i>
                                               </a> 
                                               <a href="delete-products.php?id=<?php echo $product->id; ?>" class="btn  btn-danger btn-xs waves-effect waves-light" onclick="return confirm(' Are you sure you want to delete this product?');">
                                                 <i class="mdi mdi-close"></i>
                                             </a> 
                                         </div>
                                         <div class="bg-light" style="width: 200px; height: 200px; overflow: hidden;">
                                          <img src="<?php echo $product->file ?>" alt="product-pic" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;" />
                                      </div>

                                      <div class="product-info">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h5 class="font-16 mt-0 sp-line-1"><a href="ecommerce-product-detail.html" class="text-dark"><?php echo $product->name ?></a> </h5>
                                                <div class="text-warning mb-2 font-13">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <h5 class="m-0"> <span class="text-muted"> Stocks : <?php echo $product->quantity ?></span></h5>
                                            </div>
                                            <div class="col-auto">
                                                <div class="product-price-tag">
                                                    INR <?php echo $product->unit_price ?>
                                                </div>
                                                <div class="View Details my-lg-3 mx-3"> 
                                                    <a href="products-detail.php?id=<?php echo $product->id; ?>">View Details</a> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include 'admin/footer.php'; ?>
</div>

<div class="rightbar-overlay"></div>

<script src="assets/js/vendor.min.js"></script>

<script src="assets/js/app.min.js"></script>


</body>
</html>
<?php
}
else
{
    header('Location: index.php');
}

?>