<?php
session_start();
include_once('connection.php');

if(!isset($_SESSION['auth_user']))
{
    header("Location: login.php");
    exit();
}

/*
|--------------------------------------------------------------------------
| FETCH ENUM DATA WITH ENUM TYPE NAME
|--------------------------------------------------------------------------
*/

$query = "SELECT enums.*, enum_types.name AS enum_type_name

FROM enums

LEFT JOIN enum_types
ON enums.enum_type_id = enum_types.id

ORDER BY enums.id DESC";

$query_run = mysqli_query($conn, $query);

$total = mysqli_num_rows($query_run);

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
                                        Enum List [Total: <?= $total; ?>]
                                    </h4>

                                    <div>
                                        <a class="btn btn-primary" href="add-enum.php">
                                            <i class="mdi mdi-plus-circle"></i>
                                            Add Enum
                                        </a>
                                    </div>

                                </div>

                                <?php
                                if(isset($_SESSION['message']))
                                {
                                    ?>

                                    <div class="alert alert-success m-3">
                                        <?= $_SESSION['message']; ?>
                                    </div>

                                    <?php
                                    unset($_SESSION['message']);
                                }
                                ?>

                                <div class="card-body min-height-500">

                                    <!-- FILTER -->

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
                                            type="search"
                                            placeholder="Search name...">

                                        </div>

                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-centered table-nowrap table-striped">
                                            <thead class="table">
                                                <tr>
                                                    <th>SN #</th>
                                                    <th>Enum Type<i class="fas fa-sort margin-30"></i></th>
                                                    <th>Name<i class="fas fa-sort margin-30"></i></th>
                                                    <th>Position<i class="fas fa-sort margin-30"></i></th>
                                                    <th>Status</th>
                                                    <th>Create Date<i class="fas fa-sort margin-30"></i></th>
                                                    <th>Update Date<i class="fas fa-sort margin-30"></i></th>
                                                    <th>Action</th>
                                                </tr>

                                            </thead>

                                            <tbody>

                                                <?php

                                                if(mysqli_num_rows($query_run) > 0)
                                                {
                                                    $sn = 1;

                                                    foreach($query_run as $row)
                                                    {
                                                        ?>

                                                        <tr>

                                                            <!-- SN -->

                                                            <td>
                                                                <?= $sn++; ?>
                                                            </td>

                                                            <!-- ENUM TYPE -->

                                                            <td>
                                                                <?= isset($row['enum_type_name']) ? $row['enum_type_name'] : ''; ?>
                                                            </td>

                                                            <!-- NAME -->

                                                            <td>
                                                                <?= isset($row['name']) ? $row['name'] : ''; ?>
                                                            </td>

                                                            <!-- POSITION -->

                                                            <td>
                                                                <?= isset($row['position']) ? $row['position'] : ''; ?>
                                                            </td>

                                                            <!-- STATUS -->

                                                            <td>

                                                                <?php
                                                                if(isset($row['status']) && $row['status'] == 1)
                                                                {
                                                                    echo '<span class="badge bg-success">Active</span>';
                                                                }
                                                                else
                                                                {
                                                                    echo '<span class="badge bg-danger">Inactive</span>';
                                                                }
                                                                ?>

                                                            </td>
                                                            <td>
                                                                <?= isset($row['created_at']) ? $row['created_at'] : ''; ?>
                                                            </td>
                                                            <td>
                                                                <?= isset($row['updated_at']) ? $row['updated_at'] : ''; ?>
                                                            </td>
                                                            <td>
                                                                <a href="edit-enum.php?id=<?= $row['id']; ?>"
                                                                   class="btn btn-success btn-sm">
                                                                   Edit
                                                               </a>
                                                               <a href="delete-enum.php?id=<?= $row['id']; ?>"class="btn btn-danger btn-sm"onclick="return confirm('Are you sure delete this data?')">
                                                                   Delete
                                                               </a>
                                                           </td>
                                                       </tr>
                                                       <?php
                                                   }
                                               }
                                               else
                                               {
                                                ?>

                                                <tr>

                                                    <td colspan="8" class="text-center">
                                                        No Record Found
                                                    </td>

                                                </tr>

                                                <?php
                                            }
                                            ?>

                                        </tbody>

                                    </table>

                                </div>

                                <!-- PAGINATION -->

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

        </div>

        <?php include 'Admin/footer.php'; ?>

    </div>

</div>

<?php include 'Admin/script.php'; ?>

</body>
</html>