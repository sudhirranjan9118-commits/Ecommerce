<!DOCTYPE html>
<html lang="en">
   <?php include'Admin/head.php'?>
    <body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>

        <!-- Begin page -->
        <div id="wrapper">
          <?php include'Admin/header.php'?>
           <?php include'Admin/sidebar.php'?>
            <div class="content-page">
                <div class="content">

                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                                            <li class="breadcrumb-item active">Shopping Cart</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Shopping Cart</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="table-responsive">
                                                    <table class="table table-borderless table-nowrap table-centered mb-0">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th>Product</th>
                                                                <th>Price</th>
                                                                <th>Quantity</th>
                                                                <th>Total</th>
                                                                <th style="width: 50px;"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <img src="assets/images/products/product-1.png" alt="contact-img"
                                                                        title="contact-img" class="rounded me-3" height="48" />
                                                                    <p class="m-0 d-inline-block align-middle font-16">
                                                                        <a href="ecommerce-product-detail.html" class="text-reset font-family-secondary">Polo Navy blue T-shirt</a>
                                                                        <br>
                                                                        <small class="me-2"><b>Size:</b> Large </small>
                                                                        <small><b>Color:</b> Light Green
                                                                        </small>
                                                                    </p>
                                                                </td>
                                                                <td>
                                                                    $148.66
                                                                </td>
                                                                <td>
                                                                    <input type="number" min="1" value="5" class="form-control" placeholder="Qty" style="width: 90px;">
                                                                </td>
                                                                <td>
                                                                    $743.30
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div> 

                                                <div class="mt-3">
                                                    <label for="example-textarea" class="form-label">Add a Note:</label>
                                                    <textarea class="form-control" id="example-textarea" rows="3" placeholder="Write some note.."></textarea>
                                                </div>

                                                <div class="row mt-4">
                                                    <div class="col-sm-6">
                                                        <a href="ecommerce-products.html" class="btn text-muted d-none d-sm-inline-block btn-link fw-semibold">
                                                            <i class="mdi mdi-arrow-left"></i> Continue Shopping </a>
                                                    </div> <!-- end col -->
                                                    <div class="col-sm-6">
                                                        <div class="text-sm-end">
                                                            <a href="ecommerce-checkout.php" class="btn btn-danger"><i class="mdi mdi-cart-plus me-1"></i> Checkout </a>
                                                        </div>
                                                    </div> <!-- end col -->
                                                </div> <!-- end row-->
                                            </div>
                                            <!-- end col -->

                                            <div class="col-lg-4">
                                                <div class="border p-3 mt-4 mt-lg-0 rounded">
                                                    <h4 class="header-title mb-3">Order Summary</h4>

                                                    <div class="table-responsive">
                                                        <table class="table mb-0">
                                                            <tbody>
                                                                <tr>
                                                                    <td>Grand Total :</td>
                                                                    <td>$1571.19</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- end table-responsive -->
                                                </div>

                                                <div class="alert alert-warning mt-3" role="alert">
                                                    Use coupon code <strong>UBTF25</strong> and get 25% discount !
                                                </div>

                                                <div class="input-group mt-3">
                                                    <input type="text" class="form-control form-control-light" placeholder="Coupon code" aria-label="Recipient's username">
                                                    <button class="btn input-group-text btn-light" type="button">Apply</button>
                                                </div>

                                            </div> <!-- end col -->

                                        </div> <!-- end row -->
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container -->

                </div> <!-- content -->

                <?php include'Admin/footer.php'?>
            </div>
        </div>
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        
    </body>
</html>