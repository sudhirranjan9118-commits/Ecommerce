<?php 
session_start();
include_once('connection.php');

// Redirect if not logged in
if (!isset($_SESSION['auth_user'])) {
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
                            <?php include 'Admin/flash-message.php'; ?>

                            <div class="card">
                                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                                    <h3 class="mb-0">Role Menu</h3>
                                    <a href="add-role_menu.php" class="btn btn-danger waves-effect waves-light">
                                        <i class="mdi mdi-plus-circle me-1"></i> Add Role Menu
                                    </a>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-centered table-striped table-bordered align-middle" id="rolemenu-datatable">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Role Name</th>
                                                    <th>Menu Name</th>
                                                    <th>View</th>
                                                    <th>Add</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                    <th>Status</th>
                                                    <th>Created At</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $query = "
                                                    SELECT rm.*, r.name AS role_name, m.menu_name 
                                                    FROM role_menu rm 
                                                    LEFT JOIN roles r ON rm.role_id = r.id 
                                                    LEFT JOIN menus m ON rm.menu_id = m.id 
                                                    ORDER BY rm.id DESC
                                                ";

                                                $result = $conn->query($query);

                                                if ($result && $result->num_rows > 0) {
                                                    $index = 1;
                                                    while ($row = $result->fetch_assoc()) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $index++; ?></td>
                                                            <td><?= htmlspecialchars($row['role_name'] ?? ''); ?></td>
                                                            <td><?= htmlspecialchars($row['menu_name'] ?? ''); ?></td>

                                                            <td><?= ($row['can_view']) ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-secondary">No</span>'; ?></td>
                                                            <td><?= ($row['can_add']) ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-secondary">No</span>'; ?></td>
                                                            <td><?= ($row['can_edit']) ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-secondary">No</span>'; ?></td>
                                                            <td><?= ($row['can_delete']) ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-secondary">No</span>'; ?></td>

                                                            <td>
                                                                <?php if ($row['status'] === 'active') { ?>
                                                                    <a href="change-role_menu-status.php?id=<?= $row['id']; ?>&status=inactive" 
                                                                       onclick="return confirm('Deactivate this role menu?')" 
                                                                       title="Click to deactivate">
                                                                        <span class="badge bg-success">Active</span>
                                                                    </a>
                                                                <?php } else { ?>
                                                                    <a href="change-role_menu-status.php?id=<?= $row['id']; ?>&status=active" 
                                                                       onclick="return confirm('Activate this role menu?')" 
                                                                       title="Click to activate">
                                                                        <span class="badge bg-danger">Inactive</span>
                                                                    </a>
                                                                <?php } ?>
                                                            </td>

                                                            <td><?= htmlspecialchars($row['created_at']); ?></td>

                                                            <td>
                                                                <a href="edit-role_menu.php?id=<?= $row['id']; ?>" 
                                                                   class="action-icon text-primary me-2" title="Edit">
                                                                    <i class="mdi mdi-square-edit-outline"></i>
                                                                </a>
                                                                <a href="delete-role_menu.php?id=<?= $row['id']; ?>" 
                                                                   class="action-icon text-danger" 
                                                                   onclick="return confirm('Delete this role menu?')" 
                                                                   title="Delete">
                                                                    <i class="mdi mdi-delete"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else {
                                                    echo '<tr><td colspan="10" class="text-center text-muted">No Role Menus Found!</td></tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div> <!-- end table-responsive -->
                                </div> <!-- end card-body -->
                            </div> <!-- end card -->
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                </div> <!-- end container-fluid -->
            </div> <!-- end content -->
        </div> <!-- end content-page -->

        <?php include 'Admin/footer.php'; ?> 
    </div> <!-- end wrapper -->

    <?php include 'Admin/script.php'; ?>
</body>
</html>
