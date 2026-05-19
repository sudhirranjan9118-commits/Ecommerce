<?php
session_start();
include_once('connection.php');

if(!isset($_SESSION['auth_user']))
{
    header("Location: login.php");
    exit();
}

/* Insert Data */
if(isset($_POST['save_enumtype']))
{
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // slug generate
    $slug = strtolower(trim($name));
    $slug = str_replace(' ', '-', $slug);

    // duplicate slug check
    $check_slug = mysqli_query($conn,
        "SELECT * FROM enum_types WHERE slug='$slug'");

    if(mysqli_num_rows($check_slug) > 0)
    {
        $slug = $slug . '-' . rand(100,999);
    }

    $insert_query = "INSERT INTO enum_types
    (name, slug, position, status, created_at, updated_at)

    VALUES

    ('$name', '$slug', '$position', '$status', NOW(), NOW())";

    $insert_query_run = mysqli_query($conn, $insert_query);

    if($insert_query_run)
    {
        $_SESSION['message'] = "Enum Type Added Successfully";
        header("Location: enumtype.php");
        exit();
    }
    else
    {
        $_SESSION['message'] = "Something Went Wrong : ".mysqli_error($conn);
    }
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
                                 Add Enum Type 
                             </h4>
                             <div>
                                <a class="btn btn-secondary" href="Enum_type.php"><i class="mdi mdi-arrow-left"></i>Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Enum Type</label>
                                    <input type="text"name="name"class="form-control"placeholder="Enter Enum Type"required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Position</label>
                                    <input type="number"name="position"class="form-control"value="1"required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">
                                        Status
                                    </label>
                                    <select name="status" class="form-control">
                                        <option>---Select---</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <div>
                                    <button type="submit"name="save_enum_type"class="btn btn-primary">
                                        <i class="mdi mdi-content-save"></i>Save Enum Type
                                    </button>
                                </div>
                            </form>
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