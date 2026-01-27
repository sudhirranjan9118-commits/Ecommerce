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
                                                <h3>Add Customer Detail</h3>
                                            </div>
                                            <div class="col-md-6">
                                                <a type="button" class="btn btn-secondary waves-effect waves-light float-end" href="customers-list.php"><i class="mdi mdi-plus-circle me-1"></i> Back</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-md-6">
                                                <form class="px-3" action="save-customer.php" method="POST">
                                                    <div class="mb-3">
                                                        <label for="first_name" class="form-label">First Name</label>
                                                        <input class="form-control" type="text" name="first_name" required="" placeholder="Michael Zenaty">
                                                        <?php if(isset($_SESSION['errors']['first_name'])) { echo '<span class="text-danger">'.$_SESSION['errors']['first_name'].'</span>'; unset($_SESSION['errors']['first_name']); } ?>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="last_name" class="form-label">Last Name</label>
                                                        <input class="form-control" type="text" name="last_name" required="" placeholder="Michael Zenaty">
                                                    </div>
                                                    
                                                    <div class="mb-3">
                                                        <label for="mobile_number" class="form-label">Mobile Number</label>
                                                        <input class="form-control" type="number" step="any" name="mobile" id="mobile_number" required placeholder="Enter your mobile number">

                                                        <?php if(isset($_SESSION['errors']['mobile'])) { echo '<span class="text-danger">'.$_SESSION['errors']['mobile'].'</span>'; unset($_SESSION['errors']['mobile']); } ?>

                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="balance" class="form-label">Balance</label>
                                                        <input class="form-control" type="number" name="balance" id="balance" required placeholder="Enter balance">
                                                        <?php if(isset($_SESSION['errors']['balance'])) { echo '<span class="text-danger">'.$_SESSION['errors']['balance'].'</span>'; unset($_SESSION['errors']['balance']); } ?>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="order" class="form-label">Order</label>
                                                        <input class="form-control" type="number" name="order" id="order" required placeholder="Enter order">
                                                        <?php if(isset($_SESSION['errors']['order'])) { echo '<span class="text-danger">'.$_SESSION['errors']['order'].'</span>'; unset($_SESSION['errors']['order']); } ?>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="last_order" class="form-label">Last Order</label>
                                                        <input class="form-control" type="date" name="last_order" id="last_order" required placeholder="Enter last order date">
                                                        <?php if(isset($_SESSION['errors']['last_order'])) { echo '<span class="text-danger">'.$_SESSION['errors']['last_order'].'</span>'; unset($_SESSION['errors']['last_order']); } ?>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="password" class="form-label">Password</label>
                                                        <input class="form-control" type="password" name="password" required="" placeholder="Enter your password">
                                                        <?php if(isset($_SESSION['errors']['password'])) { echo '<span class="text-danger">'.$_SESSION['errors']['password'].'</span>'; unset($_SESSION['errors']['password']); } ?>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="confirm_password" class="form-label">Confirm Password</label>
                                                        <input class="form-control" type="password" name="confirm_password" required="" placeholder="Enter your confirm password">
                                                    </div>
                                                    <div class="mb-3 text-end">
                                                        <button class="btn btn-primary" type="submit" name="save-customer" value="save-customer">Save</button>
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
            </div>
            <?php include 'Admin/footer.php'; ?>
        </div>
        <?php include 'Admin/script.php'; ?>
    </body>
    </html>
    <?php } else { header('Location: index.php'); } ?>