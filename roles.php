<?php
session_start();
include_once('connection.php');

if (!isset($_SESSION['auth_user'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include 'admin/head.php'; ?>

<body class="loading"
data-layout='{"mode":"light","width":"fluid","menuPosition":"fixed","sidebar":{"color":"light","size":"default","showuser":false},"topbar":{"color":"dark"}}'>

<div id="wrapper">

    <?php include 'admin/header.php'; ?>
    <?php include 'admin/sidebar.php'; ?>

    <div class="content-page">
        <div class="content">
            <div class="container-fluid mt-1">

                <!-- PAGE TITLE -->
                <div class="row">
                    <div class="col-12">
                        <?php include 'admin/flash-message.php'; ?>
                        <div class="page-title-box">
                            <h4 class="page-title">Roles</h4>
                        </div>
                    </div>
                </div>

                <!-- CARD -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <!-- ACTION BAR -->
                                <div class="row mb-2">
                                    <div class="col-sm-4">
                                        <a href="add-role.php" class="btn btn-danger">
                                            <i class="mdi mdi-plus-circle me-1"></i> Add Role
                                        </a>
                                    </div>
                                </div>

                                <!-- TABLE -->
                                <div class="table-responsive">
                                    <table class="table table-centered table-striped w-100">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Icon</th>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Status</th>
                                                <th>Created</th>
                                                <th>Updated</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $query = "SELECT * FROM roles ORDER BY position ASC";
                                            $roles = mysqli_query($conn, $query);
                                            $i = 1;

                                            if ($roles && mysqli_num_rows($roles) > 0) {
                                                while ($role = mysqli_fetch_assoc($roles)) {
                                                    ?>
                                                    <tr>
                                                        <td><?= $i++; ?></td>

                                                        <!-- ICON (FIXED 🔥) -->
                                                        <td class="text-center">
                                                            <i class="<?= htmlspecialchars($role['icon']); ?> fs-3"></i>
                                                            <br>
                                                            <small class="text-muted">
                                                                <?= htmlspecialchars($role['icon']); ?>
                                                            </small>
                                                        </td>

                                                        <td><?= htmlspecialchars($role['name']); ?></td>

                                                        <td><?= (int)$role['position']; ?></td>

                                                        <td>
                                                            <?php if ($role['status'] == 1) { ?>
                                                                <a href="change-role-status.php?id=<?= $role['id']; ?>">
                                                                    <span class="badge bg-success">Active</span>
                                                                </a>
                                                            <?php } else { ?>
                                                                <a href="change-role-status.php?id=<?= $role['id']; ?>">
                                                                    <span class="badge bg-danger">Inactive</span>
                                                                </a>
                                                            <?php } ?>
                                                        </td>

                                                        <td><?= $role['created_at']; ?></td>
                                                        <td><?= $role['updated_at'] ?? '-'; ?></td>

                                                        <td>
                                                            <a href="edit-role.php?id=<?= $role['id']; ?>" class="action-icon">
                                                                <i class="mdi mdi-square-edit-outline"></i>
                                                            </a>

                                                            <a href="delete-role.php?id=<?= $role['id']; ?>"
                                                             class="action-icon"
                                                             onclick="return confirm('Are you sure?')">
                                                             <i class="mdi mdi-delete"></i>
                                                         </a>
                                                     </td>
                                                 </tr>
                                                 <?php
                                             }
                                         } else {
                                            echo '<tr><td colspan="8" class="text-center">No Roles Found</td></tr>';
                                        }
                                        ?>
                                    </tbody>

                                </table>
                            </div>
                            <!-- END TABLE -->

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

</div>

<?php include 'admin/footer.php'; ?>
<?php include 'admin/script.php'; ?>

</body>
</html>
