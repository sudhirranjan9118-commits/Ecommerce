<?php 
session_start(); 
include_once('connection.php'); 
if(isset($_SESSION['auth_user'])) { 
    if(isset($_GET['id'])) { 
        $product_id = $_GET['id']; 
        $query = "SELECT * FROM products WHERE id = '$product_id'";
        $result = $conn->query($query);
        $product = $result->fetch_object();
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <?php include 'Admin/head.php'; ?>
        <body class="loading">
            <div id="wrapper">
                <?php include 'Admin/header.php'; ?>
                <?php include 'Admin/sidebar.php'; ?>
                <div class="content-page">
                    <div class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <?php include 'Admin/flash-message.php'; ?>
                                    <div class="page-title-box">
                                        <h4 class="page-title">Edit Product</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <form action="update-product-action.php" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
                                                <div class="form-group">
                                                    <label for="name">Product Name</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $product->name; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="unit_price">Unit Price</label>
                                                    <input type="number" class="form-control" id="unit_price" name="unit_price" value="<?php echo $product->unit_price; ?>">
                                                </div>
                                                <div class="form-group ">
                                                    <label for="old_price">Old Price</label>
                                                    <input type="number"class="form-control"id="old_price"name="old_price"value="<?php echo $product->old_price; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="quantity">Quantity</label>
                                                    <input type="number" class="form-control" id="quantity" name="quantity" value="<?$old_price = $_POST['old_price']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="quantity">Description</label>
                                                    <input type=" long text" class="form-control" id="description" name="description" value="<?php echo $product->description; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="file">Product Image</label>
                                                    <input type="file" class="form-control" id="file" name="file">
                                                    <img src="<?php echo $product->file; ?>" alt="product image" width="100">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Update Product</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include 'Admin/footer.php'; ?>
            </div>
            <?php include 'Admin/script.php'; ?>
        </body>
        </html>
        <?php } else { header('Location: products.php'); } } else { header('Location: index.php'); } ?>