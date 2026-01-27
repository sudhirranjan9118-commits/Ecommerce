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
                                            <h3>Add Brand</h3>
                                        </div>
                                        <div class="col-md-6">
                                            <a type="button" class="btn btn-secondary waves-effect waves-light float-end" href="brand.php">
                                                <i class="mdi mdi-arrow-left me-1"></i> Back
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-md-6">
                                            <!-- Brand Add Form -->
                                            <form class="px-3" action="save-brand.php" method="POST" enctype="multipart/form-data">
                                                
                                                <!-- Brand Name -->
                                                <div class="mb-3">
                                                    <label for="brand_name" class="form-label">Brand Name</label>
                                                    <input class="form-control" type="text" name="brand_name" required placeholder="Enter Brand Name">
                                                    <?php 
                                                    if(isset($_SESSION['errors']['brand_name'])) { 
                                                        echo '<span class="text-danger">'.$_SESSION['errors']['brand_name'].'</span>'; 
                                                        unset($_SESSION['errors']['brand_name']); 
                                                    } 
                                                    ?>
                                                </div>

                                                <!-- Brand Slug -->
                                                <div class="mb-3">
                                                    <label for="brand_slug" class="form-label">Brand Slug</label>
                                                    <input class="form-control" type="text" name="brand_slug" placeholder="e.g. nike, samsung">
                                                </div>

                                                <!-- Brand Description -->
                                                <div class="mb-3">
                                                    <label for="brand_description" class="form-label">Description</label>
                                                    <textarea class="form-control" name="brand_description" rows="3" placeholder="Write short description..."></textarea>
                                                </div>

                                                <!-- Brand Logo -->
                                                <div class="mb-3">
                                                    <label for="brand_logo" class="form-label">Brand Logo</label>
                                                    <input class="form-control" type="file" name="brand_logo" accept="image/*">
                                                    <small class="text-muted">Upload PNG, JPG or JPEG format only</small>
                                                </div>

                                                <!-- Brand Status -->
                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Status</label>
                                                    <select class="form-control" name="status" required>
                                                        <option value="">--- Select ---</option>
                                                        <option value="active">Active</option>
                                                        <option value="inactive">Inactive</option>
                                                    </select>
                                                </div>

                                                <!-- Terms -->
                                                <div class="mb-3">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="customCheck1" required>
                                                        <label class="form-check-label" for="customCheck1">
                                                            I accept <a href="#">Terms and Conditions</a>
                                                        </label>
                                                    </div>
                                                </div>

                                                <!-- Submit Button -->
                                                <div class="mb-3 text-end">
                                                    <button class="btn btn-primary" type="submit" name="save-brand" value="save-brand">Save Brand</button>
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

<?php 
} else { 
    header('Location: index.php'); 
} 
?>
