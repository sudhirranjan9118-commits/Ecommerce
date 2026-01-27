<?php 
session_start(); 
include_once('connection.php'); 

if(isset($_SESSION['auth_user'])) { 
    if(isset($_GET['id'])) { 
        $customer_id = intval($_GET['id']);

        // Get customer details
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $customer_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $customer = $result->fetch_object();
        $stmt->close();

        if(!$customer) {
            $_SESSION['error'] = "Customer not found.";
            header('Location: customers-list.php');
            exit();
        }

        // Get order stats for this customer
        $stmt2 = $conn->prepare("SELECT COUNT(*) as total_orders, MAX(created_at) as last_order FROM orders WHERE user_id = ?");
        $stmt2->bind_param("i", $customer_id);
        $stmt2->execute();
        $order_result = $stmt2->get_result()->fetch_object();
        $stmt2->close();

        $total_orders = $order_result->total_orders ?? 0;
        $last_order = $order_result->last_order ?? 'No orders yet';
    } else {
        header('Location: customers-list.php');
        exit();
    }
} else { 
    header('Location: index.php'); 
    exit();
} 
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
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h3>Customer Details</h3>
                                        <a href="customers-list.php" class="btn btn-light">Back</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4><?php echo htmlspecialchars($customer->first_name . ' ' . $customer->last_name); ?></h4>
                                            <p><strong>Phone:</strong> <?php echo htmlspecialchars($customer->mobile); ?></p>
                                            <?php if(!empty($customer->email)): ?>
                                                <p><strong>Email:</strong> <?php echo htmlspecialchars($customer->email); ?></p>
                                            <?php endif; ?>
                                            <p><strong>Balance:</strong> ₹<?php echo number_format($customer->balance ?? 0, 2); ?></p>
                                            <p><strong>Status:</strong> 
                                                <?php if($customer->status == 'active' || $customer->status == 1) { ?>
                                                    <span class="badge bg-success">Active</span>
                                                <?php } else { ?>
                                                    <span class="badge bg-danger">Inactive</span>
                                                <?php } ?>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <h5>Order Information</h5>
                                            <p><strong>Total Orders:</strong> <?php echo $total_orders; ?></p>
                                            <p><strong>Last Order:</strong> <?php echo $last_order; ?></p>
                                            <hr>
                                            <a href="orders-list.php?user_id=<?php echo $customer_id; ?>" class="btn btn-primary">View Orders</a>
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
    </div>
</body>
</html>
