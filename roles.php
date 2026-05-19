<?php
session_start();
include_once('connection.php');

if(!isset($_SESSION['auth_user']))
{
    header("Location: login.php");
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
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title mb-0">Users List [Total: 10]</h4>
                                    <div>
                                        <a class="btn btn-primary" href="add-role.php"><i class="mdi mdi-plus-circle"></i>Add New</a>
                                    </div>
                                </div>
                                <div class="card-body min-height-500">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="paginate-box">
                                            <select class="form-select form-select-sm" style="width:100px;">
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                                <option value="200">200</option>
                                                <option value="500">500</option>
                                            </select>
                                        </div>
                                        <div class="search-box-right">
                                            <input class="form-control form-control-sm rounded-pill"type="search"
                                            placeholder="Search name...">
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-centered table-nowrap table-striped">
                                            <thead class="table">
                                                <tr>
                                                    <th style="width: 20px;">SN #</th>
                                                    <th>Icon<i class="fas fa-sort margin-30"></i></th>
                                                    <th>Name<i class="fas fa-sort margin-30"></i></th>
                                                    <th>Position<i class="fas fa-sort margin-30"></i></th>
                                                    <th>Status<i class="fas fa-sort margin-30"></i></th>
                                                    <th>Created<i class="fas fa-sort margin-30"></i></th>
                                                    <th>Updated<i class="fas fa-sort margin-30"></i></th>
                                                    <th style="width: 100px;">Action</th>
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
                                <div class="d-flex justify-content-center mt-4">
                                    <ul class="pagination pagination-rounded mb-0">
                                        <li class="page-item"><a class="page-link" href="#">«</a></li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                                        <li class="page-item"><a class="page-link" href="#">»</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include 'Admin/footer.php'; ?>
        </div>
    </div>
</div>
<?php include 'Admin/script.php'; ?>
</body>
</html>