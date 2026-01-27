<?php 
session_start(); 
include_once('connection.php'); 
if(isset($_SESSION['auth_user'])) { 
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
                <div class="container-fluid mt-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3>Edit Brand</h3>
                                        </div>
                                        <div class="col-md-6">
                                            <a type="button" class="btn btn-secondary waves-effect waves-light float-end" href="brand.php">
                                                <i class="mdi mdi-arrow-left me-1"></i> Back
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <?php 
                                if(isset($_GET['id'])) {
                                    $brand_id = $_GET['id'];
                                    $stmt = $conn->prepare("SELECT * FROM brands WHERE id = ?");
                                    $stmt->bind_param("i", $brand_id);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $brand = $result->fetch_object();
                                    $stmt->close();
                                } else {
                                    $_SESSION['error'] = "Invalid Request.";
                                    header("Location: brand.php");
                                    exit();
                                }
                                ?>

                                <div class="card-body">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-md-6">
                                            <form class="px-3" action="update-brand.php" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="id" value="<?php echo $brand->id; ?>">

                                                <!-- Brand Name -->
                                                <div class="mb-3">
                                                    <label for="brand_name" class="form-label">Brand Name</label>
                                                    <input class="form-control" type="text" name="brand_name" required value="<?php echo htmlspecialchars($brand->brand_name); ?>">
                                                </div>

                                                <!-- Brand Slug -->
                                                <div class="mb-3">
                                                    <label for="brand_slug" class="form-label">Brand Slug</label>
                                                    <input class="form-control" type="text" name="brand_slug" value="<?php echo htmlspecialchars($brand->brand_slug); ?>">
                                                </div>

                                                <!-- Brand Description -->
                                                <div class="mb-3">
                                                    <label for="brand_description" class="form-label">Description</label>
                                                    <textarea class="form-control" name="brand_description" rows="3"><?php echo htmlspecialchars($brand->brand_description); ?></textarea>
                                                </div>

                                                <!-- Current Logo -->
                                                <div class="mb-3">
                                                    <label class="form-label d-block">Current Logo</label>
                                                    <?php if(!empty($brand->brand_logo)) { ?>
                                                        <img src="uploads/brands/<?php echo $brand->brand_logo; ?>" alt="Logo" width="80" height="80" style="object-fit:contain; border:1px solid #ddd; border-radius:5px;">
                                                    <?php } else { ?>
                                                        <p class="text-muted">No logo uploaded</p>
                                                    <?php } ?>
                                                </div>

                                                <!-- Upload New Logo -->
                                                <div class="mb-3">
                                                    <label for="brand_logo" class="form-label">Change Logo</label>
                                                    <input class="form-control" type="file" name="brand_logo" accept="image/*">
                                                    <small class="text-muted">Leave blank to keep existing logo</small>
                                                </div>

                                                <!-- Status -->
                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Status</label>
                                                    <select class="form-control" name="status" required>
                                                        <option value="active" <?php if($brand->status == 'active') echo 'selected'; ?>>Active</option>
                                                        <option value="inactive" <?php if($brand->status == 'inactive') echo 'selected'; ?>>Inactive</option>
                                                    </select>
                                                </div>

                                                <!-- Submit -->
                                                <div class="mb-3 text-end">
                                                    <button class="btn btn-primary" type="submit" name="update-brand" value="update-brand">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- card-body end -->
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

<?php } else { header('Location: index.php'); } ?>
