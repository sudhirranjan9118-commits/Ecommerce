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
                                        <div class="card-header bg-info text-white">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h3>Add Category</h3>
                                                </div>
                                                <div class="col-md-6 text-end">
                                                    <a href="categories-list.php" class="btn btn-secondary">
                                                        <i class="mdi mdi-arrow-left"></i> Back
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <div class="row d-flex justify-content-center">
                                                <div class="col-md-6">
                                                    <form class="px-3" 
                                                    action="save-category.php" 
                                                    method="POST" 
                                                    enctype="multipart/form-data">

                                                    <!-- Category Name -->
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Category Name</label>
                                                        <input class="form-control" type="text" name="name" required placeholder="Enter category name">
                                                        <?php 
                                                        if(isset($_SESSION['errors']['name'])) { 
                                                            echo '<span class="text-danger">'.$_SESSION['errors']['name'].'</span>'; 
                                                            unset($_SESSION['errors']['name']); 
                                                        } 
                                                        ?>
                                                    </div>

                                                    <!-- Slug / Alias -->
                                                    <div class="mb-3">
                                                        <label for="name_alias" class="form-label">Slug / Name Alias</label>
                                                        <input class="form-control" type="text" name="name_alias" placeholder="e.g. electronics">
                                                    </div>

                                                    <!-- Parent Category -->
                                                    <div class="mb-3">
                                                        <label for="parent_id" class="form-label">Parent Category</label>
                                                        <select class="form-control" name="parent_id">
                                                            <option value="">-- None (Main Category) --</option>
                                                            <?php 
                                                            $parentQuery = "SELECT id, name FROM categories WHERE parent_id IS NULL ORDER BY name ASC";
                                                            $parentResult = $conn->query($parentQuery);
                                                            while($parent = $parentResult->fetch_object()) {
                                                                echo '<option value="'.$parent->id.'">'.$parent->name.'</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <!-- Image -->
                                                    <div class="mb-3">
                                                        <label for="image" class="form-label">Category Image</label>
                                                        <input class="form-control" type="file" name="image" accept=".jpg,.jpeg,.png,.gif">
                                                        <?php 
                                                        if(isset($_SESSION['errors']['image'])) { 
                                                            echo '<span class="text-danger">'.$_SESSION['errors']['image'].'</span>'; 
                                                            unset($_SESSION['errors']['image']); 
                                                        } 
                                                        ?>
                                                    </div>

                                                    <!-- Status -->
                                                    <div class="mb-3">
                                                        <label for="status" class="form-label">Status</label>
                                                        <select class="form-control" name="status" required>
                                                            <option value="">Select Status</option>
                                                            <option value="1">Active</option>
                                                            <option value="0">Inactive</option>
                                                        </select>
                                                    </div>

                                                    <!-- Terms Checkbox -->
                                                    <div class="mb-3">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="customCheck1" required>
                                                            <label class="form-check-label" for="customCheck1">
                                                                I accept <a href="#">Terms and Conditions</a>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <!-- Submit -->
                                                    <div class="mb-3 text-end">
                                                        <button class="btn btn-primary" type="submit" name="save-category">
                                                            <i class="mdi mdi-content-save"></i> Save
                                                        </button>
                                                    </div>

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

    <?php 
} else { 
    header('Location: index.php'); 
} 
?>
