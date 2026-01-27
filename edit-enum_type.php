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
                                            <h3>Edit Enum type Detail</h3>
                                        </div>
                                        <div class="col-md-6">
                                            <a type="button" class="btn btn-secondary waves-effect waves-light float-end" href="enum_type.php"><i class="mdi mdi-plus-circle me-1"></i> Back</a>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                $user_id=$_GET['id'];
                                $stmt = $conn->prepare("SELECT *from enum_types where id=?");
                                $stmt->bind_param("i", $user_id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $stmt->close();
                                $conn->close();
                                $enum_type=$result->fetch_object();
                                ?>
                                <div class="row d-flex justify-content-center">
                                    <div class="col-md-6">
                                        <form class="px-3" action="update-enum_type.php" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="id" value="<?php echo $enum_type->id; ?>">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input class="form-control" type="text" name="name" required="" value="<?php echo $enum_type->name; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="name_alias" class="form-label">Name Alias</label>
                                                <input class="form-control" type="text" name="name_alias" required="" value="<?php echo $enum_type->name_alias; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-control" name="status" required="">
                                                    <option value="active" <?php if($enum_type->status == 'active') echo 'selected'; ?>>Active</option>
                                                    <option value="inactive" <?php if($enum_type->status == 'inactive') echo 'selected'; ?>>Inactive</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="enum_type" class="form-label">Enum type</label>
                                                <input class="form-control" type="text" name="enum_type" required="" value="<?php echo $enum_type->enum_type; ?>">
                                            </div>
                                            <div class="mb-3 text-end">
                                                <button class="btn btn-primary" type="submit" name="update-enum_type" value="update-enum_type">Save</button>
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
<?php } else { header('Location: index.php'); } ?>
