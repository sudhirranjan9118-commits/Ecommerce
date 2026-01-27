<?php 
session_start(); 
include_once('connection.php'); 

if (!isset($_SESSION['auth_user'])) { 
    header('Location: index.php'); 
    exit();
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error'] = "Invalid Product ID!";
    header('Location: products.php');
    exit();
}

$product_id = intval($_GET['id']);

// ✅ Secure query
$stmt = $conn->prepare('SELECT * FROM products WHERE id = ?');
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_object();
$stmt->close();

// Agar product nahi mila
if (!$product) {
    $_SESSION['error'] = "Product not found!";
    header('Location: products.php');
    exit();
}

// ✅ Image path fix (show uploaded image or default)
$imagePath = (!empty($product->file) && file_exists($product->file)) 
    ? htmlspecialchars($product->file) 
    : 'uploads/no-image.png';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" /> 
    <title>Product Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="assets/css/config/default/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/config/default/app.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>
<body class="loading">

<div id="wrapper">
    <?php include 'Admin/header.php'; ?>
    <?php include 'Admin/sidebar.php'; ?>

    <div class="content-page">
        <div class="content">
            <div class="container-fluid mt-4">

                <div class="row">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-5 text-center">
                                        <img src="<?php echo $imagePath; ?>" 
                                             alt="product image" 
                                             class="img-fluid rounded border shadow-sm" 
                                             style="max-height: 350px; object-fit: cover;">
                                    </div>

                                    <div class="col-lg-7">
                                        <h3 class="mb-3 text-primary"><?php echo htmlspecialchars($product->name); ?></h3>

                                        <p class="text-muted">
                                            <strong>Category:</strong> <?php echo htmlspecialchars($product->category ?? 'N/A'); ?>
                                        </p>

                                        <h4 class="mb-3">
                                            Price: 
                                            <span class="text-muted me-2">
                                                <del>₹<?php echo number_format($product->unit_price * 1.2, 2); ?></del>
                                            </span> 
                                            <b>₹<?php echo number_format($product->unit_price, 2); ?></b>
                                        </h4>

                                        <span class="badge bg-success mb-3">In Stock</span>

                                        <p class="text-muted mb-4">
                                            <?php echo nl2br(htmlspecialchars($product->description)); ?>
                                        </p>

                                        <form method="post" action="add-to-cart.php">
    <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
    <button type="submit" name="add_to_cart" class="btn btn-primary">
        <i class="mdi mdi-cart me-1"></i> Add to Cart
    </button>
                                            <a href="products.php" class="btn btn-outline-secondary ms-2">
                                                <i class="mdi mdi-arrow-left"></i> Back to Products
                                            </a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php include 'Admin/footer.php'; ?>
    </div>
</div>

<?php include 'Admin/script.php'; ?>
</body>
</html>