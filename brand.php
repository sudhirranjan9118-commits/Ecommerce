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
                                            <h3>Brands</h3>
                                        </div>
                                        <div class="col-md-6">
                                            <a type="button" class="btn btn-danger waves-effect waves-light float-end" href="add-brand.php">
                                                <i class="mdi mdi-plus-circle me-1"></i> Add Brand
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-centered table-nowrap table-striped" id="brands-datatable">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th style="width: 20px;">id</th>
                                                    <th>Brand Name</th>
                                                    <th>Slug</th>
                                                    <th>Logo</th>
                                                    <th>Description</th>
                                                    <th>Status</th>
                                                    <th>Created At</th>
                                                    <th style="width: 85px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $query = "SELECT * FROM brands ORDER BY id DESC;";
                                                $result = $conn->query($query);
                                                if ($result && $result->num_rows > 0) { 
                                                    $index = 1;
                                                    while($brand = $result->fetch_object()) { 
                                                ?>
                                                    <tr>
                                                        <td><?php echo $index++; ?></td>
                                                        <td><?php echo htmlspecialchars($brand->brand_name); ?></td>
                                                        <td><?php echo htmlspecialchars($brand->brand_slug); ?></td>
                                                        <td>
                                                            <?php if(!empty($brand->brand_logo)) { ?>
                                                                <img src="uploads/brands/<?php echo $brand->brand_logo; ?>" alt="Logo" width="50" height="50" style="object-fit:contain;">
                                                            <?php } else { echo 'No Logo'; } ?>
                                                        </td>
                                                        <td><?php echo nl2br(htmlspecialchars($brand->brand_description)); ?></td>
                                                        <td>
                                                            <?php if($brand->status == 'active') { ?>
                                                                <a href="change-brand-status.php?id=<?php echo $brand->id; ?>&status=inactive">
                                                                    <span class="badge bg-success rounded-pill px-2">Active</span>
                                                                </a>
                                                            <?php } else { ?>
                                                                <a href="change-brand-status.php?id=<?php echo $brand->id; ?>&status=active">
                                                                    <span class="badge bg-danger rounded-pill px-2">Inactive</span>
                                                                </a>
                                                            <?php } ?>
                                                        </td>
                                                        <td><?php echo $brand->created_at; ?></td>
                                                        <td>
                                                            <a href="edit-brand.php?id=<?php echo $brand->id; ?>" class="action-icon"> 
                                                                <i class="mdi mdi-square-edit-outline"></i>
                                                            </a>
                                                            <a href="delete-brand.php?id=<?php echo $brand->id; ?>" class="action-icon" onclick="return confirm('Are you sure you want to delete this brand?')">
                                                                <i class="mdi mdi-delete"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php 
                                                    } 
                                                } else { 
                                                    echo "<tr><td colspan='8' class='text-center'>No brands found</td></tr>"; 
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

<?php 
} else { 
    header('Location: index.php'); 
} 
?>
