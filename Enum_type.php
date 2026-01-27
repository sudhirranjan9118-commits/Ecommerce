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
                            <?php include 'Admin/flash-message.php'; ?>
                            <div class="card">
                                <div class="card-header bg-info">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3>Enum Types</h3>
                                        </div>
                                        <div class="col-md-6">
                                            <a type="button" class="btn btn-danger waves-effect waves-light float-end" href="add-enum_type.php"><i class="mdi mdi-plus-circle me-1"></i> Add Enum Type</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-centered table-nowrap table-striped" id="products-datatable">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th style="width: 20px;">id</th>
                                                    <th>Name</th>
                                                    <th>Name Alias</th>
                                                    <th>Status</th>
                                                    <th>Enum Type</th>
                                                    <th>Created At</th>
                                                    <th style="width: 85px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $query="SELECT * from enum_types;";
                                                $result = $conn->query($query);
                                                if ($result->num_rows > 0) { 
                                                    $index=1;
                                                    while($enum_type = $result->fetch_object()) { 
                                                ?>
                                                    <tr>
                                                        <td><?php echo $index++; ?></td>
                                                        <td><?php echo $enum_type->name; ?></td>
                                                        <td><?php echo $enum_type->name_alias; ?></td>
                                                          <td>
    <?php if ($enum_type->status == 1) { ?>
        <a href="change-enum_type-status.php?id=<?php echo $enum_type->id; ?>&status=0" 
           title="Click to deactivate" 
           onclick="return confirm('Are you sure you want to deactivate this role?')">
            <span class="badge bg-success text-white rounded-pill px-2">Active</span>
        </a>
    <?php } else { ?>
        <a href="change-enum_type-status.php?id=<?php echo $enum_type->id; ?>&status=1" 
           title="Click to activate" 
           onclick="return confirm('Are you sure you want to activate this role?')">
            <span class="badge bg-danger text-white rounded-pill px-2">Inactive</span>
        </a>
    <?php } ?>
</td>

                                                        <td><?php echo $enum_type->enum_type; ?></td>
                                                        <td><?php echo $enum_type->created_at; ?></td>
                                                        <td>
                                                            <a href="edit-enum_type.php?id=<?php echo $enum_type->id; ?>" class="action-icon"> 
                                                                <i class="mdi mdi-square-edit-outline"></i> 
                                                            </a>
                                                            <a href="delete-enum_type.php?id=<?php echo $enum_type->id; ?>" class="action-icon" onclick="return confirm('Are you sure to delete this enum type?')"> 
                                                                <i class="mdi mdi-delete"></i> 
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php 
                                                    } 
                                                } else { 
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
</body>
</html>
<?php } else { header('Location: index.php'); } ?>