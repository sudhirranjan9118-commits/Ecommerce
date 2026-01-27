<?php 
session_start(); 
include_once('connection.php'); 
if(isset($_SESSION['auth_user'])) { 
?> 
<!DOCTYPE html> 
<html lang="en"> 
<?php include 'admin/head.php'; ?> 
<!-- body start --> 
<body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": {"color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'> 
    <div id="wrapper"> 
        <?php include 'admin/header.php'; ?> 
        <?php include 'admin/sidebar.php'; ?> 
        <div class="content-page"> 
            <div class="content"> 
                <!-- Start Content--> 
                <div class="container-fluid"> 
                    <div class="row"> 
                        <div class="col-12"> 
                            <?php include 'admin/flash-message.php'; ?> 
                            <div class="card"> 
                                <div class="card-body "> 
                                    <h4 class="page-title">ORDERS</h4> 
                                    <div class="card-body my-0"></div> 
                                    <div class="row mb-2"> 
                                        <div class="col-lg-8"> 
                                            <form class="d-flex flex-wrap align-items-center"> 
                                                <label for="inputPassword2" class="visually-hidden">Search</label> 
                                                <div class="me-3"> 
                                                    <input type="search" class="form-control my-1 my-lg-0" id="inputPassword2" placeholder="Search..."> 
                                                </div> 
                                                <label for="status-select" class="me-2">Status</label> 
                                                <div class="me-sm-3"> 
                                                    <select class="form-select form-select my-1 my-lg-0" id="status-select"> 
                                                        <option selected>Choose...</option> 
                                                        <option value="1">Paid</option> 
                                                        <option value="2">Awaiting Authorization</option> 
                                                        <option value="3">Payment failed</option> 
                                                        <option value="4">Cash On Delivery</option> 
                                                        <option value="5">Fulfilled</option> 
                                                        <option value="6">Unfulfilled</option> 
                                                    </select> 
                                                </div> 
                                            </form> 
                                        </div> 
                                        <div class="col-lg-4"> 
                                            <div class="text-lg-end"> 
                                                <a href="add-order.php" class="btn btn-danger waves-effect waves-light mb-2 me-2"><i class="mdi mdi-basket me-1"></i> Add New Order</a> 
                                                <button type="button" class="btn btn-light waves-effect mb-2">Export</button> 
                                            </div> 
                                        </div><!-- end col--> 
                                    </div> 
                                    <div class="table-responsive"> 
                                        <table class="table table-centered table-nowrap mb-0"> 
                                            <thead class="table-light"> 
                                                <tr> 
                                                    <th style="width: 20px;"> 
                                                        <div class="form-check"> 
                                                            <input type="checkbox" class="form-check-input" id="customCheck1"> 
                                                            <label class="form-check-label" for="customCheck1">&nbsp;</label> 
                                                        </div> 
                                                    </th> 
                                                    <th>Order ID</th> 
                                                    <th>Products</th> 
                                                    <th>Date</th> 
                                                    <th>Payment Status</th> 
                                                    <th>Total</th> 
                                                    <th>Payment Method</th> 
                                                    <th>Order Status</th> 
                                                    <th style="width: 125px;">Action</th> 
                                                </tr> 
                                            </thead> 
                                            <tbody> 
                                                <?php 
                                                    $query="SELECT *FROM orders"; 
                                                    $orders = $conn->query($query); 
                                                    if ($orders->num_rows > 0) { 
                                                        while($order = $orders->fetch_object()) { 
                                                ?> 
                                                            <tr> 
                                                                <td> 
                                                                    <div class="form-check"> 
                                                                        <input type="checkbox" class="form-check-input" id="customCheck1"> 
                                                                        <label class="form-check-label" for="customCheck1">&nbsp;</label> 
                                                                    </div> 
                                                                </td> 
                                                                <td><?php echo $order->id; ?></td> 
                                                                <td><?php echo $order->product_name; ?></td> 
                                                                <td><?php echo $order->created_at; ?></td> 
                                                                <td> 
                                                                    <?php 
                                                                        if ($order->payment_status == 1) { 
                                                                            echo "Paid"; 
                                                                        } elseif ($order->payment_status == 2) { 
                                                                            echo "Awaiting Authorization"; 
                                                                        } elseif ($order->payment_status == 3) { 
                                                                            echo "Payment failed"; 
                                                                        } elseif ($order->payment_status == 4) { 
                                                                            echo "Cash On Delivery"; 
                                                                        } 
                                                                    ?> 
                                                                </td> 
                                                                <td><?php echo $order->price; ?></td> 
                                                                <td><?php echo $order->payment_method; ?></td> 
                                                                <td> 
                                                                    <?php 
                                                                        if ($order->order_status == 1) { 
                                                                            echo "Fulfilled"; 
                                                                        } elseif ($order->order_status == 2) { 
                                                                            echo "Unfulfilled"; 
                                                                        } 
                                                                    ?> 
                                                                </td> 
                                                                <td> 
                                                                    <a href="view-order.php?id=<?php echo $order->id; ?>" class="action-icon"> 
                                                                        <i class="mdi mdi-eye"></i></a> 
                                                                    <a href="edit-order.php?id=<?php echo $order->id; ?>" class="action-icon"> 
                                                                        <i class="mdi mdi-square-edit-outline"></i></a> 
                                                                    <a href="delete-order.php?id=<?php echo $order->id; ?>" class="action-icon" onclick="return confirm('Are you sure to delete this order?')"> 
                                                                        <i class="mdi mdi-delete"></i></a> 
                                                                </td> 
                                                            </tr> 
                                                <?php 
                                                        } 
                                                    } else { 
                                                        echo "<tr><td colspan='9'>No orders found.</td></tr>"; 
                                                    } 
                                                ?> 
                                            </tbody> 
                                        </table> 
                                    </div> 
                                    <ul class="pagination pagination-rounded justify-content-end my-2"> 
                                        <li class="page-item"> 
                                            <a class="page-link" href="javascript: void(0);" aria-label="Previous"> 
                                                <span aria-hidden="true">«</span> 
                                                <span class="visually-hidden">Previous</span> 
                                            </a> 
                                        </li> 
                                        <li class="page-item active"><a class="page-link" href="javascript: void(0);">1</a></li> 
                                        <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li> 
                                        <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li> 
                                        <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li> 
                                        <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li> 
                                        <li class="page-item"> 
                                            <a class="page-link" href="javascript: void(0);" aria-label="Next"> 
                                                <span aria-hidden="true">»</span> 
                                                <span class="visually-hidden">Next</span> 
                                            </a> 
                                        </li> 
                                    </ul> 
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
<?php 
 } 
else { header('Location: index.php');
 }
?>