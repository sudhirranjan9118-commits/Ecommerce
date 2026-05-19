<?php
session_start();
include_once('connection.php');
$enum_query = "SELECT * FROM enum_types WHERE status='1' ORDER BY name ASC";
$enum_query_run = mysqli_query($conn, $enum_query);
if(isset($_POST['save_enum']))
{
    $enum_type_id = mysqli_real_escape_string($conn, $_POST['enum_type_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);

    $check_query = "SELECT * FROM enums
    WHERE enum_type_id='$enum_type_id'
    AND name='$name'";

    $check_query_run = mysqli_query($conn, $check_query);

    if(mysqli_num_rows($check_query_run) > 0)
    {
        $_SESSION['message'] = "Enum Already Exists!";
    }
    else
    {
        $insert_query = "INSERT INTO enums
        (
            enum_type_id,
            name,
            position
            )

        VALUES
        (
            '$enum_type_id',
            '$name',
            '$position'
        )";

        $insert_query_run = mysqli_query($conn, $insert_query);

        if($insert_query_run)
        {
            $_SESSION['message'] = "Enum Added Successfully";
            header("Location: enum.php");
            exit();
        }
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
                                        Add Enum
                                    </h4>
                                    <div>
                                        <a class="btn btn-secondary" href="enums.php"><i class="mdi mdi-arrow-left"></i>Back</a>
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
                                <div class="card-body">
                                    <form method="POST">
                                        <div class="mb-3">

                                            <label class="form-label">Enum Type</label>
                                            <select name="enum_type_id"class="form-control"required>
                                                <option value="">--- Select Enum Type ---</option>
                                                <?php
                                                if(mysqli_num_rows($enum_query_run) > 0)
                                                {
                                                    foreach($enum_query_run as $enum)
                                                    {
                                                        ?>
                                                        <option value="<?= $enum['id']; ?>">
                                                            <?= $enum['name']; ?>
                                                        </option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Enum Name</label>
                                            <input type="text"name="name"class="form-control"placeholder="Enter Enum Name"required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Position</label>
                                            <input type="number"name="position"class="form-control"value="1"required>
                                        </div>
                                        <div>
                                            <button type="submit"name="save-enums.php"class="btn btn-primary">
                                                <i class="mdi mdi-content-save"></i>Save Enum</button>
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