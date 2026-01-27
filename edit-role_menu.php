<?php
session_start();
include_once('connection.php');

if (!isset($_SESSION['auth_user'])) {
    header('Location: index.php');
    exit();
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error'] = "Invalid Role Menu ID!";
    header('Location: role_menu.php');
    exit();
}

$role_menu_id = intval($_GET['id']);

// Fetch role_menu detail
$stmt = $conn->prepare("SELECT * FROM role_menu WHERE id = ?");
$stmt->bind_param("i", $role_menu_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    $_SESSION['error'] = "Role menu not found!";
    header('Location: role_menu.php');
    exit();
}

$role_menu = $result->fetch_object();
$stmt->close();
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
                                            <h3>Edit Role Menu Detail</h3>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="role_menu.php" class="btn btn-secondary float-end">
                                                <i class="mdi mdi-arrow-left"></i> Back
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-md-6">

                                            <form class="px-3" action="update-role_menu.php" method="POST">
                                                <input type="hidden" name="role_menu_id" value="<?php echo $role_menu->id; ?>">

                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Name</label>
                                                    <input class="form-control" type="text" name="name" required value="<?php echo htmlspecialchars($role_menu->name); ?>">
                                                    <?php
                                                    if (isset($_SESSION['errors']['name'])) {
                                                        echo '<span class="text-danger">' . $_SESSION['errors']['name'] . '</span>';
                                                        unset($_SESSION['errors']['name']);
                                                    }
                                                    ?>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="name_alias" class="form-label">Name Alias</label>
                                                    <input class="form-control" type="text" name="name_alias" required value="<?php echo htmlspecialchars($role_menu->name_alias); ?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Status</label>
                                                    <select class="form-control" name="status" required>
                                                        <option value="active" <?php echo ($role_menu->status == 'active') ? 'selected' : ''; ?>>Active</option>
                                                        <option value="inactive" <?php echo ($role_menu->status == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="position" class="form-label">Position</label>
                                                    <input class="form-control" type="number" name="position" required value="<?php echo htmlspecialchars($role_menu->position); ?>">
                                                    <?php
                                                    if (isset($_SESSION['errors']['position'])) {
                                                        echo '<span class="text-danger">' . $_SESSION['errors']['position'] . '</span>';
                                                        unset($_SESSION['errors']['position']);
                                                    }
                                                    ?>
                                                </div>

                                                <div class="mb-3 text-end">
                                                    <button class="btn btn-primary" type="submit" name="update-role_menu" value="update-role_menu">Save Changes</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div> <!-- card-body end -->
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
	