<?php 
session_start(); 
include_once('connection.php'); 
if(isset($_SESSION['auth_user'])) { 
?> 
<!DOCTYPE html> 
<html lang="en"> 
<?php include 'admin/head.php'; ?> 
<body class="loading"> 
    <div id="wrapper"> 
        <?php include 'admin/header.php'; ?> 
        <?php include 'admin/sidebar.php'; ?> 
        <div class="content-page"> 
            <div class="content"> 
                <div class="container-fluid mt-3"> 
                    <div class="row"> 
                        <div class="col-12"> 
                            <?php include 'admin/flash-message.php'; ?> 
                            <div class="card"> 
                                <div class="card-header bg-info"> 
                                    <div class="row"> 
                                        <div class="col-12"> 
                                            <div class="page-title-box"> 
                                                <h4 class="page-title">Add Order</h4> 
                                            </div> 
                                        </div> 
                                    </div> 
                                    <div class="row"> 
                                        <div class="col-lg-12"> 
                                            <div class="card"> 
                                                <div class="card-body"> 
                                                    <form action="save-order.php" method="POST"> 
                                                        <div class="row mb-3"> 
                                                            <div class="col-lg-4"> 
                                                                <label class="form-label">Product Name <span class="text-danger">*</span></label> 
                                                                <input type="text" name="product_name" class="form-control"> 
                                                                <?php if(isset($_SESSION['errors']['product_name'])) { echo '<span class="text-danger">'.$_SESSION['errors']['product_name'].'</span>'; unset($_SESSION['errors']['product_name']); } ?> 
                                                            </div> 
                                                            <div class="col-lg-4"> 
                                                                <label class="form-label">Quantity <span class="text-danger">*</span></label> 
                                                                <select class="form-control" name="quantity"> 
                                                                    <option value="">--Select--</option> 
                                                                    <?php for ($i=1; $i <=30 ; $i++) { echo "<option value='".$i."'>$i</option>"; } ?> 
                                                                </select> 
                                                                <?php if(isset($_SESSION['errors']['quantity'])) { echo '<span class="text-danger">'.$_SESSION['errors']['quantity'].'</span>'; unset($_SESSION['errors']['quantity']); } ?> 
                                                            </div> 
                                                            <div class="col-lg-4"> 
                                                                <label class="form-label">Price <span class="text-danger">*</span></label> 
                                                                <input type="number" name="price" class="form-control"> 
                                                                <?php if(isset($_SESSION['errors']['price'])) { echo '<span class="text-danger">'.$_SESSION['errors']['price'].'</span>'; unset($_SESSION['errors']['price']); } ?> 
                                                            </div> 
                                                        </div> 
                                                        <div class="row mb-3"> 
                                                            <div class="col-lg-4"> 
                                                                <label class="form-label">Payment Status <span class="text-danger">*</span></label> 
                                                                <select class="form-control" name="payment_status"> 
                                                                    <option value="">--Select--</option> 
                                                                    <option value="1">Paid</option> 
                                                                    <option value="2">Awaiting Authorization</option> 
                                                                    <option value="3">Payment failed</option> 
                                                                    <option value="4">Cash On Delivery</option> 
                                                                </select> 
                                                                <?php if(isset($_SESSION['errors']['payment_status'])) { echo '<span class="text-danger">'.$_SESSION['errors']['payment_status'].'</span>'; unset($_SESSION['errors']['payment_status']); } ?> 
                                                            </div> 
                                                            <div class="col-lg-4"> 
                                                                <label class="form-label">Payment Method <span class="text-danger">*</span></label> 
                                                                <select class="form-control" name="payment_method"> 
                                                                    <option value="">--Select--</option> 
                                                                    <option value="Cash">Cash</option> 
                                                                    <option value="Card">Card</option> 
                                                                    <option value="Online Banking">Online Banking</option> 
                                                                    <option value="UPI">UPI</option> 
                                                                </select> 
                                                                <?php if(isset($_SESSION['errors']['payment_method'])) { echo '<span class="text-danger">'.$_SESSION['errors']['payment_method'].'</span>'; unset($_SESSION['errors']['payment_method']); } ?> 
                                                            </div> 
                                                            <div class="col-lg-4"> 
                                                                <label class="form-label">Order Status <span class="text-danger">*</span></label> 
                                                                <select class="form-control" name="order_status"> 
                                                                    <option value="">--Select--</option> 
                                                                    <option value="1">Pending</option> 
                                                                    <option value="2">Fulfilled</option> 
                                                                    <option value="3">Unfulfilled</option> 
                                                                </select> 
                                                                <?php if(isset($_SESSION['errors']['order_status'])) { echo '<span class="text-danger">'.$_SESSION['errors']['order_status'].'</span>'; unset($_SESSION['errors']['order_status']); } ?> 
                                                            </div> 
                                                        </div> 
                                                        <div class="col-lg-12"> 
                                                            <div class="text-end mt-3"> 
                                                                <button type="submit" class="btn w-sm btn-success waves-effect waves-light" name="add_order" value="add_order">Save</button> 
                                                            </div> 
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
            </div> 
        </div> 
        <?php include 'admin/footer.php'; ?> 
    </div> 
    <?php include 'admin/script.php'; ?> 
</body> 
</html> 
<?php } else { header('Location: index.php'); } ?>
