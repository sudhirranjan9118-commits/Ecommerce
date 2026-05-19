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
                                    <h4 class="card-title mb-0">
                                        Users List [Total: 10]
                                    </h4>
                                    <div>
                                        <a class="btn btn-secondary me-1" href="users-export.php">
                                            <i class="mdi mdi-download-circle-outline"></i>
                                            Export
                                        </a>
                                        <a class="btn btn-success me-1" href="users-import.php">
                                            <i class="mdi mdi-progress-upload"></i>
                                            Import
                                        </a>
                                        <a class="btn btn-primary" href="users-add.php">
                                            <i class="mdi mdi-plus-circle"></i>
                                            Add New
                                        </a>
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
                                            <input class="form-control form-control-sm rounded-pill"
                                            type="search"placeholder="Search name...">
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-centered table-nowrap table-striped">
                                            <thead class="table">
                                                <tr>
                                                    <th>SN #</th>
                                                    <th>Customer<i class="fas fa-sort margin-30"></i></th>
                                                    <th>Phone<i class="fas fa-sort margin-30"></i></th>
                                                    <th>Email<i class="fas fa-sort margin-30"></i></th>
                                                    <th>Location<i class="fas fa-sort margin-30"></i></th>
                                                    <th>Create Date<i class="fas fa-sort margin-30"></i></th>
                                                    <th>Status<i class="fas fa-sort margin-30"></i></th>
                                                    <th width="100">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td class="table-user">
                                                        <img src="../assets/images/users/user-4.jpg"alt="user"class="me-2 rounded-circle"width="40"height="40">
                                                        <a href="#" class="text-body fw-semibold">Paul J. Friend</a>
                                                    </td>
                                                    <td>937-330-1634</td>
                                                    <td>pauljfrnd@jourrapide.com</td>
                                                    <td>New York</td>
                                                    <td>07/07/2018</td>
                                                    <td>
                                                        <span class="badge bg-success rounded-pill">Active</span>
                                                    </td>
                                                    <td>
                                                        <a href="edit-user.php?id=1" class="action-icon text-success">
                                                            <i class="mdi mdi-square-edit-outline"></i>
                                                        </a>
                                                        <a href="delete-user.php?id=1"
                                                        class="action-icon text-danger"
                                                        onclick="return confirm('Are you sure to delete this user?')">
                                                        <i class="mdi mdi-delete"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td class="table-user">
                                                    <img src="../assets/images/users/user-1.jpg"alt="user"class="me-2 rounded-circle"
                                                    width="40"height="40">
                                                    <a href="#" class="text-body fw-semibold">Timothy Kauper</a>
                                                </td>
                                                <td>(216) 75 612 706</td>
                                                <td>thykauper@rhyta.com</td>
                                                <td>Denmark</td>
                                                <td>09/08/2018</td>
                                                <td>
                                                    <span class="badge bg-danger rounded-pill">
                                                        Blocked
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="edit-user.php?id=2" class="action-icon text-success">
                                                        <i class="mdi mdi-square-edit-outline"></i>
                                                    </a>
                                                    <a href="delete-user.php?id=2"class="action-icon text-danger"
                                                    onclick="return confirm('Are you sure to delete this user?')"><i class="mdi mdi-delete"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                <ul class="pagination pagination-rounded mb-0">
                                    <li class="page-item">
                                        <a class="page-link" href="#">«</a>
                                    </li>
                                    <li class="page-item active">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">4</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">5</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">»</a>
                                    </li>
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