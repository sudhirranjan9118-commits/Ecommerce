<?php
session_start();
include_once('connection.php');

if (!isset($_SESSION['auth_user'])) {
    header('Location: index.php');
    exit;
}

// Retain old input values
$oldName = $_SESSION['old']['name'] ?? '';
$oldIcon = $_SESSION['old']['icon'] ?? '';
$oldPosition = $_SESSION['old']['position'] ?? '';
unset($_SESSION['old']);
?>
<!DOCTYPE html>
<html lang="en">

<?php include 'admin/head.php'; ?>

<body class="loading">
    <div id="wrapper">

        <?php include 'admin/header.php'; ?>
        <?php include 'admin/sidebar.php'; ?>

        <div class="content-page">
            <div class="content">
                <div class="container-fluid mt-3">

                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-header bg-info text-white">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <h4 class="mb-0">Add Role</h4>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <a href="roles.php" class="btn btn-secondary">
                                                <i class="mdi mdi-arrow-left"></i> Back
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <?php
                                    if (isset($_SESSION['error'])) {
                                        echo "<div class='alert alert-danger'>" . htmlspecialchars($_SESSION['error']) . "</div>";
                                        unset($_SESSION['error']);
                                    }
                                    if (isset($_SESSION['success'])) {
                                        echo "<div class='alert alert-success'>" . htmlspecialchars($_SESSION['success']) . "</div>";
                                        unset($_SESSION['success']);
                                    }
                                    ?>

                                    <div class="row justify-content-center">
                                        <div class="col-md-6">

                                            <form action="save-role.php" method="POST">

                                                <!-- NAME -->
                                                <div class="mb-3">
                                                    <label class="form-label">Role Name</label>
                                                    <input type="text"
                                                           name="name"
                                                           class="form-control"
                                                           placeholder="Enter Role Name"
                                                           value="<?php echo htmlspecialchars($oldName); ?>"
                                                           required>
                                                </div>

                                                <!-- ICON -->
                                                <div class="mb-3">
                                                    <label class="form-label">Icon Class</label>
                                                    <input type="text"
                                                           name="icon"
                                                           class="form-control"
                                                           placeholder="mdi mdi-account"
                                                           value="<?php echo htmlspecialchars($oldIcon); ?>"
                                                           required>
                                                    <small class="text-muted">
                                                        Example: mdi mdi-account, mdi mdi-home
                                                    </small>
                                                </div>

                                                <!-- POSITION -->
                                                <div class="mb-3">
                                                    <label class="form-label">Position</label>
                                                    <input type="number"
                                                           name="position"
                                                           class="form-control"
                                                           placeholder="Enter Position"
                                                           min="1"
                                                           value="<?php echo htmlspecialchars($oldPosition); ?>"
                                                           required>
                                                </div>

                                                <!-- SUBMIT -->
                                                <div class="text-end">
                                                    <button type="submit"
                                                            name="save-role"
                                                            class="btn btn-primary">
                                                        Save Role
                                                    </button>
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
    </div>
</div>

<?php include 'admin/footer.php'; ?>
<?php include 'admin/script.php'; ?>

</body>
</html>
