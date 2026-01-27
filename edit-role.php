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
                            <div class="card">
                                <div class="card-header bg-info">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3>Edit Support Role Detail</h3>
                                        </div>
                                        <div class="col-md-6">
                                            <a type="button" class="btn btn-secondary waves-effect waves-light float-end" href="users-list.php"><i class="mdi mdi-plus-circle me-1"></i> Back</a>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                $user_id=$_GET['id'];
                                $stmt = $conn->prepare("SELECT *from roles where id=?");
                                $stmt->bind_param("i", $user_id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $stmt->close();
                                $conn->close();
                                $role=$result->fetch_object();
                                ?>
                                <div class="row d-flex justify-content-center">
                                    <div class="col-md-6">
                                        <form class="px-3" action="update-role.php" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="id" value="<?php echo $role->id; ?>">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input class="form-control" type="text" name="name" required="" value="<?php echo $role->name; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="name_alias" class="form-label">Name Alias</label>
                                                <input class="form-control" type="text" name="name_alias" required="" value="<?php echo $role->name_alias; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="icon" class="form-label">Icon</label>
                                                <input class="form-control" type="file" name="icon" accept="image/*">
                                                <img src="<?php echo $role->icon; ?>" alt="Icon" width="100">
                                            </div>
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-control" name="status" required="">
                                                    <option value="active" <?php if($role->status == 'active') echo 'selected'; ?>>Active</option>
                                                    <option value="inactive" <?php if($role->status == 'inactive') echo 'selected'; ?>>Inactive</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="position" class="form-label">Position</label>
                                                <input class="form-control" type="number" name="position" required="" value="<?php echo $role->position; ?>">
                                            </div>
                                            <div class="mb-3 text-end">
                                                <button class="btn btn-primary" type="submit" name="update-role" value="update-role">Save</button>
                                            </div>
                                        </form>
                                    </div>
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
</body>
</html>
<?php 
} 
else { 


	header('Location: index.php'); 
}

 ?>