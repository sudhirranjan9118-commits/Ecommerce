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
                                                <h3>Add Enum Type Detail</h3>
                                            </div>
                                            <div class="col-md-6">
                                                <a type="button" class="btn btn-secondary waves-effect waves-light float-end" href="enum_type.php"><i class="mdi mdi-plus-circle me-1"></i> Back</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-md-6">
                                                <form class="px-3" action="save-enum_type.php" method="POST">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Name</label>
                                                        <input class="form-control" type="text" name="name" required="" placeholder="Role Name">
                                                        <?php if(isset($_SESSION['errors']['name'])) { echo '<span class="text-danger">'.$_SESSION['errors']['name'].'</span>'; unset($_SESSION['errors']['name']); } ?>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="name_alias" class="form-label">Name Alias</label>
                                                        <input class="form-control" type="text" name="name_alias" required="" placeholder="Role Alias">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="enum_type" class="form-label">Enum type</label>
                                                        <input class="form-control" type="text" name="enum_type" required="" placeholder="Enum type">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="status" class="form-label">Status</label>
                                                        <select class="form-control" name="status" required="">
                                                            <option >---select---</option>
                                                            <option value="active">Active</option>
                                                            <option value="inactive">Inactive</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" name="remember" id="customCheck1">
                                                            <label class="form-check-label" for="customCheck1">I accept <a href="#">Terms and Conditions</a></label>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 text-end">
                                                        <button class="btn btn-primary" type="submit" name="save-enum_type" value="save-enum_type">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-md-6">
                                            </div>
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
        <?php include 'Admin/script.php'; ?>
    </body>
    </html>
    <?php } else { header('Location: index.php'); } ?>