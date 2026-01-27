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
                                                <h3>Add Role Menu</h3>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="role_menu.php" class="btn btn-secondary float-end">
                                                    <i class="mdi mdi-arrow-left me-1"></i> Back
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-md-6">
                                                <form action="save-role_menu.php" method="POST" class="px-3">

                                                    <!-- 🔹 Role Selection -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Select Role</label>
                                                        <select class="form-control" name="role_id" required>
                                                            <option value="">-- Select Role --</option>
                                                            <option >Admin</option>
                                                            <option >Manager</option>
                                                            <option >Customer</option>
                                                            <?php
                                                            $roles = $conn->query("SELECT id, name FROM roles WHERE status='active'");
                                                            if($roles && $roles->num_rows > 0){
                                                                while($role = $roles->fetch_assoc()){
                                                                    echo "<option value='{$role['id']}'>{$role['name']}</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <!-- 🔹 Menu Name -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Menu Name</label>
                                                        <input type="text" name="menu_name" class="form-control" placeholder="Enter Menu Name" required>
                                                    </div>

                                                    <!-- 🔹 Permissions -->
                                                    <div class="mb-3">
                                                        <label class="form-label d-block mb-2">Permissions</label>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="can_view" value="1" id="viewCheck">
                                                            <label class="form-check-label" for="viewCheck">View</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="can_add" value="1" id="addCheck">
                                                            <label class="form-check-label" for="addCheck">Add</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="can_edit" value="1" id="editCheck">
                                                            <label class="form-check-label" for="editCheck">Edit</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="can_delete" value="1" id="deleteCheck">
                                                            <label class="form-check-label" for="deleteCheck">Delete</label>
                                                        </div>
                                                    </div>

                                                    <!-- 🔹 Status -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Status</label>
                                                        <select class="form-control" name="status" required>
                                                            <option value="active">Active</option>
                                                            <option value="inactive">Inactive</option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3 text-end">
                                                        <button class="btn btn-primary" type="submit" name="save-role_menu" value="save-role_menu">
                                                            Save Role Menu
                                                        </button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end card -->
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
    exit;
} 
?>
