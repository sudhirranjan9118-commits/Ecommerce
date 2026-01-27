<?php
session_start();
include 'connection.php';

// Authentication check (optional)
if(!isset($_SESSION['auth_user'])) {
    header('Location: login.php');
    exit;
}

// Get role ID
if(!isset($_GET['id'])) {
    die("Invalid Role ID!");
}
$role_id = intval($_GET['id']);

// Fetch Role Name
$role_query = mysqli_query($conn, "SELECT * FROM roles WHERE id = $role_id");
if(mysqli_num_rows($role_query) == 0) {
    die("Role not found!");
}
$role = mysqli_fetch_assoc($role_query);

// Define Modules (You can customize these according to your project)
$modules = [
    'Dashboard',
    'Products',
    'Categories',
    'Orders',
    'Customers',
    'Reports',
    'Brands',
    'Users',
    'Settings'
];

// Save permissions
if(isset($_POST['save_permissions'])) {
    foreach($modules as $module) {
        $view = isset($_POST['view'][$module]) ? 1 : 0;
        $add = isset($_POST['add'][$module]) ? 1 : 0;
        $edit = isset($_POST['edit'][$module]) ? 1 : 0;
        $delete = isset($_POST['delete'][$module]) ? 1 : 0;

        // Check if permission record already exists
        $check = mysqli_query($conn, "SELECT * FROM role_permissions WHERE role_id='$role_id' AND module_name='$module'");
        if(mysqli_num_rows($check) > 0) {
            mysqli_query($conn, "UPDATE role_permissions 
                                 SET can_view='$view', can_add='$add', can_edit='$edit', can_delete='$delete' 
                                 WHERE role_id='$role_id' AND module_name='$module'");
        } else {
            mysqli_query($conn, "INSERT INTO role_permissions (role_id, module_name, can_view, can_add, can_edit, can_delete)
                                 VALUES ('$role_id', '$module', '$view', '$add', '$edit', '$delete')");
        }
    }

    echo "<script>alert('Permissions updated successfully!'); window.location='role-page.php?id=$role_id';</script>";
    exit;
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
        <div class="content container-fluid p-4">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-light">
                    <h4 class="mb-0 text-primary">
                        Manage Permissions for: <?php echo htmlspecialchars($role['name']); ?>
                    </h4>
                </div>

                <div class="card-body">
                    <form method="POST">
                        <table class="table table-bordered align-middle text-center">
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
                                foreach($modules as $module) {
                                    $perm_result = mysqli_query($conn, "SELECT * FROM role_permissions WHERE role_id='$role_id' AND module_name='$module'");
                                    $perm = mysqli_fetch_assoc($perm_result);
                                ?>
                                <tr>
                                    <td class="text-start fw-semibold"><?php echo $module; ?></td>
                                    <td><input type="checkbox" name="view[<?php echo $module; ?>]" <?php if(!empty($perm['can_view'])) echo "checked"; ?>></td>
                                    <td><input type="checkbox" name="add[<?php echo $module; ?>]" <?php if(!empty($perm['can_add'])) echo "checked"; ?>></td>
                                    <td><input type="checkbox" name="edit[<?php echo $module; ?>]" <?php if(!empty($perm['can_edit'])) echo "checked"; ?>></td>
                                    <td><input type="checkbox" name="delete[<?php echo $module; ?>]" <?php if(!empty($perm['can_delete'])) echo "checked"; ?>></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <div class="mt-3">
                            <button type="submit" name="save_permissions" class="btn btn-success">
                                <i class="bi bi-save"></i> Save Permissions
                            </button>
                            <a href="role-page.php?id=<?php echo $role_id; ?>" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
