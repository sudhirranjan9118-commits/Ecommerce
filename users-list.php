<?php
session_start();
include_once('connection.php');

if(isset($_SESSION['auth_user']))
{
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
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h3>Support User List</h3>
                                            </div>
                                            <div class="col-md-6">
                                                <a type="button" class="btn btn-danger waves-effect waves-light float-end" href="add-user.php"><i class="mdi mdi-plus-circle me-1"></i> Add Users</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-centered table-striped table-bordered align-middle" id="products-datatable">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th style="width: 20px;">id</th>
                                                        <th>User</th>
                                                        <th>Email</th>
                                                        <th>Mobile</th>
                                                        <th>Status</th>
                                                        <th>Create At</th>
                                                        <th style="width: 85px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query="SELECT *from users where type ='support';";
                                                    $users = $conn->query($query);
                                                    if ($users->num_rows > 0)
                                                    {
                                                        $index=1;
                                                        while($user = $users->fetch_object())
                                                        {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $index++; ?></td>
                                                                <td class="table-user">
                                                                    <img src="assets/images/users/user-4.jpg" alt="table-user" class="me-2 rounded-circle">
                                                                    <a href="javascript:void(0);" class="text-body fw-semibold"><?php echo $user->first_name.' '.$user->last_name ?></a>
                                                                </td>
                                                                <td>
                                                                    <?php echo $user->email ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $user->mobile ?? '+91-XXXXXXXXXX' ?>
                                                                </td>
                                                                <td>
                                                                 <?php if ($user->status == 1) { ?>
                                                                    <a href="change-status.php?id=<?php echo $user->id; ?>&status=0" 
                                                                       title="Click to deactivate" 
                                                                       onclick="return confirm('Are you sure you want to deactivate this role?')">
                                                                       <span class="badge bg-success text-white rounded-pill px-2">Active</span>
                                                                   </a>
                                                               <?php } else { ?>
                                                                <a href="change-status.php?id=<?php echo $user->id; ?>&status=1" 
                                                                   title="Click to activate" 
                                                                   onclick="return confirm('Are you sure you want to activate this role?')">
                                                                   <span class="badge bg-danger text-white rounded-pill px-2">Inactive</span>
                                                               </a>
                                                           <?php } ?>
                                                       </td>
                                                       <td>
                                                        07/07/2018
                                                    </td>
                                                    <td>
                                                        <a href="edit-user.php?id=<?php echo $user->id; ?>" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                        <a href="delete-user.php?id=<?php echo $user->id; ?>" class="action-icon" onclick="return confirm('Are you sure to delete this user?')"> <i class="mdi mdi-delete"></i></a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            echo "0 results";
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
</div>
<?php include 'Admin/footer.php'; ?>
</div>

<?php include 'Admin/script.php'; ?>

}
</body>
</html>
<?php
}
else
{
    header('Location: index.php');
}

?>

