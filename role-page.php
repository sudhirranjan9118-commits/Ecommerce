<?php
session_start();
include 'connection.php';

// Authentication check (optional)
if(!isset($_SESSION['auth_user'])) {
    header('Location: login.php');
    exit;
}

// Role ID check
$role = null;
if(isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM roles WHERE id = $id";
    $result = mysqli_query($conn, $query);
    if($result && mysqli_num_rows($result) > 0) {
        $role = mysqli_fetch_assoc($result);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'Admin/head.php'; ?>
<body class="loading">

<div id="wrapper">
    <!-- Header -->
    <?php include 'Admin/header.php'; ?>

    <!-- Sidebar -->
    <?php include 'Admin/sidebar.php'; ?>

    <!-- Content -->
    <div class="content-page">
        <div class="content container-fluid p-4">

            <?php if($role) { ?>
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h2 class="card-title mb-3 text-primary">
                            <?php echo htmlspecialchars($role['name']); ?> Role Page
                        </h2>
                        <p><strong>Alias:</strong> <?php echo htmlspecialchars($role['name_alias']); ?></p>
                        <p><strong>Created At:</strong> <?php echo htmlspecialchars($role['created_at']); ?></p>
                        <p><strong>Status:</strong>
                            <?php if($role['status'] == 'active') { ?>
                                <span class="badge bg-success">Active</span>
                            <?php } else { ?>
                                <span class="badge bg-danger">Inactive</span>
                            <?php } ?>
                        </p>

                        <div class="mt-4">
                            <a href="edit-role.php?id=<?php echo $role['id']; ?>" class="btn btn-warning">
                                <i class="bi bi-pencil-square"></i> Edit Role
                            </a>
                            <a href="role-permission.php?id=<?php echo $role['id']; ?>" class="btn btn-primary">
                                <i class="bi bi-shield-lock"></i> Manage Permissions
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Permissions Summary -->
                <div class="card mt-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Assigned Permissions</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered align-middle">
                            <thead class="table-secondary">
                                <tr>
                                    <th>Module</th>
                                    <th>View</th>
                                    <th>Add</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $perm_query = "SELECT * FROM role_permissions WHERE role_id = $id";
                                $perm_result = mysqli_query($conn, $perm_query);

                                if(mysqli_num_rows($perm_result) > 0) {
                                    while($perm = mysqli_fetch_assoc($perm_result)) {
                                        echo "<tr>
                                            <td>".htmlspecialchars($perm['module_name'])."</td>
                                            <td>".($perm['can_view'] ? '✅' : '❌')."</td>
                                            <td>".($perm['can_add'] ? '✅' : '❌')."</td>
                                            <td>".($perm['can_edit'] ? '✅' : '❌')."</td>
                                            <td>".($perm['can_delete'] ? '✅' : '❌')."</td>
                                        </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5' class='text-center text-muted'>No permissions assigned yet.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php } else { ?>
                <div class="alert alert-danger">Role not found!</div>
            <?php } ?>

        </div>
    </div>

</div>

</body>
</html>
