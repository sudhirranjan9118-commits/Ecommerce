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
                        <?php include 'Admin/flash-message.php'; ?>
                        <div class="card">
                            <div class="card-header bg-info">
                                <h3 class="text-white">Customer List</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover align-middle">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>id</th>
                                                <th>Customer</th>
                                                <th>Phone</th>
                                                <th>Balance</th>
                                                <th>Orders</th>
                                                <th>Last Order</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $query = "
                                            SELECT u.*, 
                                                   COALESCE(SUM(o.total_amount), 0) AS total_spent,
                                                   COUNT(o.id) AS order_count,
                                                   MAX(o.created_at) AS last_order_date
                                            FROM users u
                                            LEFT JOIN orders o ON u.id = o.user_id
                                            GROUP BY u.id
                                            ORDER BY u.created_at DESC
                                        ";
                                        $result = $conn->query($query);

                                        if($result->num_rows > 0) {
                                            $i = 1;
                                            while($user = $result->fetch_object()) {
                                                $full_name = htmlspecialchars($user->first_name . ' ' . $user->last_name);
                                                $phone = htmlspecialchars($user->mobile);
                                                $balance = number_format($user->balance, 2);
                                                $orders = $user->order_count;
                                                $last_order = $user->last_order_date ? date("d M Y", strtotime($user->last_order_date)) : "No Orders";
                                                $status_badge = $user->status 
                                                    ? '<span class="badge bg-success">Active</span>' 
                                                    : '<span class="badge bg-danger">Inactive</span>';
                                        ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $full_name; ?></td>
                                                <td><?= $phone; ?></td>
                                                <td>₹ <?= $balance; ?></td>
                                                <td><?= $orders; ?></td>
                                                <td><?= $last_order; ?></td>
                                                 <td>
    <?php if ($user->status == 1) { ?>
        <a href="change-customer-status.php?id=<?php echo $user->id; ?>&status=0" 
           title="Click to deactivate" 
           onclick="return confirm('Are you sure you want to deactivate this role?')">
            <span class="badge bg-success text-white rounded-pill px-2">Active</span>
        </a>
    <?php } else { ?>
        <a href="change-customer-status.php?id=<?php echo $user->id; ?>&status=1" 
           title="Click to activate" 
           onclick="return confirm('Are you sure you want to activate this role?')">
            <span class="badge bg-danger text-white rounded-pill px-2">Inactive</span>
        </a>
    <?php } ?>
</td>
                                                <td>
                                                    <a href="customer-details.php?id=<?= $user->id; ?>" class="btn btn-sm btn-info text-white">
                                                        <i class="mdi mdi-eye"></i> View
                                                    </a>
                                                    <a href="delete-customer.php?id=<?= $user->id; ?>" class="btn btn-sm btn-danger text-white" onclick="return confirm('Delete this customer?')">
                                                        <i class="mdi mdi-delete"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php 
                                            }
                                        } else {
                                            echo "<tr><td colspan='8' class='text-center text-danger'>No customers found.</td></tr>";
                                        }
                                        ?>
                                        </tbody>
                                    </table>
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
