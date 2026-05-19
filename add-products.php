<?php 
session_start(); 
include_once('connection.php'); 

if(isset($_SESSION['auth_user'])) { 
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <?php include 'Admin/head.php' ; ?>

    <!-- body start -->
    <body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>

        <!-- Begin page -->
        <div id="wrapper">

            <?php include 'Admin/header.php' ; ?>
            <?php include 'Admin/sidebar.php' ; ?>

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Add Product</h4>
                                </div>
                            </div>
                        </div>     
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <?php if(isset($_SESSION['errors'])) { ?>
                                            <div class="alert alert-danger">
                                                <?php foreach($_SESSION['errors'] as $error) { ?>
                                                    <p><?php echo $error; ?></p>
                                                <?php } ?>
                                            </div>
                                            <?php unset($_SESSION['errors']); ?>
                                        <?php } ?>
                                        <?php if(isset($_SESSION['success'])) { ?>
                                            <div class="alert alert-success">
                                                <p><?php echo $_SESSION['success']; ?></p>
                                            </div>
                                            <?php unset($_SESSION['success']); ?>
                                        <?php } ?>
                                        <form action="save-products.php" method="POST" enctype="multipart/form-data">
                                           <div class="row">
                                            <div class="col-lg-4">
                                                <label for="product-name" class="form-label">Product Name <span class="text-danger">*</span></label>
                                                <input type="text" id="product-name" name="name" class="form-control" placeholder="e.g : Apple iMac">
                                            </div>
                                            <br/> <br/> <br/> <br/>
                                            <div class="col-lg-4">
                                               <label for="product-category" class="form-label">Category <span class="text-danger">*</span></label>
                                               <select class="form-control " id="product-category" name="category_id">
                                                   <option >---select---</option>
                                                   <option value="2">Laptop</option>
                                                   <option value="3">Desktop</option>
                                                   <option value="4">Mobile</option>
                                                   <option value="5">Watches</option>
                                                   <option value="6">Electronics</option>
                                                   <option value="7">Grocery</option>
                                                   <option value="8">Fashion</option>
                                                   <option value="9">TV & Appliances</option>
                                                   <option value="10">16 inch Laptop</option>
                                                   <option value="11">18 inch Laptop</option>
                                               </select>
                                           </div>
                                           <br/> <br/> <br/> <br/>
                                           <div class="col-lg-4">
                                               <label for="product-brand" class="form-label">Brand <span class="text-danger">*</span></label>
                                               <select class="form-control " id="product-brand" name="brand_id">
                                                   <option >---select---</option>
                                                   <option value="2">Apple</option>
                                                   <option value="3">Noise</option>
                                                   <option value="3">vivo</option>
                                                   <option value="3">oneplus</option>
                                               </select>
                                           </div>
                                           <br/> <br/> <br/> <br/>
                                           <div class="col-lg-4">
                                               <label for="product-price">Price <span class="text-danger">*</span></label>
                                               <input type="Number" step="any" class="form-control" id="product-price" name="unit_price" placeholder="Enter amount">
                                           </div>
                                           <br/> <br/> <br/> <br/>
                                           <div class="col-lg-4">
                                            <label>Old Price<span class="text-danger">*</span></label><input type="number"class="form-control"name="old_price"placeholder="Enter old price">
                                        </div>
                                        <br/> <br/> <br/> <br/>
                                        <div class="col-lg-4">
                                           <label for="product-quantity">Quantity <span class="text-danger">*</span></label>
                                           <input type="Number" step="any" class="form-control" id="product-quantity" name="quantity" placeholder="Enter quantity">
                                       </div>
                                       <br/> <br/> <br/> <br/>
                                       <div class="col-lg-4">
                                           <label for="product-discount">Discount <span class="text-danger">*</span></label>
                                           <input type="Number" step="any" class="form-control" id="product-discount" name="discount" placeholder="Enter discount">
                                       </div>
                                       <br/> <br/> <br/> <br/>
                                       <div class="col-lg-4">
                                         <label for="product-tax-rate">Tax Rate <span class="text-danger">*</span></label>
                                         <input type="Number" step="any"class="form-control" id="product-tax-rate" name="tax_rate" placeholder="Enter tax rate">
                                     </div>
                                     <br/> <br/> <br/> <br/>
                                     <div class="col-lg-4">
                                         <label class="mb-2">Status <span class="text-danger">*</span></label>
                                         <div class="radio form-check-inline">
                                             <input type="radio" id="inlineRadio1" value="online" name="status" checked="">
                                             <label for="inlineRadio1"> Online </label>
                                         </div>
                                         <div class="radio form-check-inline">
                                             <input type="radio" id="inlineRadio2" value="offline" name="status">
                                             <label for="inlineRadio2"> Offline </label>
                                         </div>
                                         <div class="radio form-check-inline">
                                             <input type="radio" id="inlineRadio3" value="draft" name="status">
                                             <label for="inlineRadio3"> Draft </label>
                                         </div>
                                     </div>
                                     <div class="col-lg-12">
                                        <label for="product-description" class="form-label">Product Description <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="description"></textarea>
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="product-images" class="form-label">Product Images <span class="text-danger">*</span></label>
                                        <input type="file" name="file_name" class="form-control">
                                    </div>
                                    <div class="row">
                                      <div class="col-12">
                                        <div class="text-center mb-3">
                                            <button type="submit" name="save-products" class="btn btn-success">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div> 
</div> 

<?php include 'Admin/footer.php' ; ?>
</div>

</div>

<div class="rightbar-overlay"></div>

<!-- App js -->
<script src="assets/js/vendor.min.js"></script>

<!-- Select2 js-->
<script src="assets/libs/select2/js/select2.min.js"></script>
<!-- Dropzone file uploads-->
<script src="assets/libs/dropzone/min/dropzone.min.js"></script>

<!-- Quill js -->
<script src="assets/libs/quill/quill.min.js"></script>

<!-- Init js-->
<script src="assets/js/pages/form-fileuploads.init.js"></script>

<!-- Init js -->
<script src="assets/js/pages/add-product.init.js"></script>

<!-- App js -->
<script src="assets/js/app.min.js"></script>

</body>
</html>
<?php 
} else { 
    header('Location: index.php'); 
}
?>