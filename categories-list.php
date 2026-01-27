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
                            <div class="card-header bg-info text-white">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>Categories</h3>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <a href="add-category.php" class="btn btn-danger">
                                            <i class="mdi mdi-plus-circle me-1"></i> Add Category
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped align-middle">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>id</th>
                                                <th>Category Name</th>
                                                <th>Slug</th>
                                                <th>Image</th>
                                                <th>Parent</th>
                                                <th>Status</th>
                                                <th>Created</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $query = "
                                            SELECT c.*, p.name AS parent_name
                                            FROM categories c
                                            LEFT JOIN categories p ON c.parent_id = p.id
                                            ORDER BY c.created_at DESC
                                        ";
                                        $result = $conn->query($query);

                                        if($result->num_rows > 0) {
                                            $i = 1;
                                            while($category = $result->fetch_object()) {
                                                $imagePath = !empty($category->image) ? 'uploads/categories/' . htmlspecialchars($category->image) : 'assets/images/no-image.png';
                                                $statusBadge = $category->status 
                                                    ? '<span class="badge bg-success">Active</span>' 
                                                    : '<span class="badge bg-danger">Inactive</span>';
                                        ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= htmlspecialchars($category->name); ?></td>
                                                <td><?= htmlspecialchars($category->slug); ?></td>
                                                <td>
                                                   <img src="<?php echo htmlspecialchars($category->image); ?>" 
     alt="Category Icon" 
     width="70" 
     height="70" 
     class="rounded border shadow-sm">
                                                </td>
                                                <td><?= $category->parent_name ? htmlspecialchars($category->parent_name) : '—'; ?></td>
                                                <td>
                                                    <a href="change-category-status.php?id=<?= $category->id; ?>">
                                                        <?= $statusBadge; ?>
                                                    </a>
                                                </td>
                                                <td><?= date('d M Y', strtotime($category->created_at)); ?></td>
                                                <td>
                                                    <a href="edit-category.php?id=<?= $category->id; ?>" class="btn btn-sm btn-info text-white">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>
                                                    <a href="delete-category.php?id=<?= $category->id; ?>" class="btn btn-sm btn-danger text-white" onclick="return confirm('Delete this category?')">
                                                        <i class="mdi mdi-delete"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php 
                                            }
                                        } else {
                                            echo "<tr><td colspan='8' class='text-center text-danger'>No categories found.</td></tr>";
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

        <?php include 'Admin/footer.php'; ?>
    </div>
</div>

<?php include 'Admin/script.php'; ?>
</body>
</html>

<?php 
} else { 
    header('Location: index.php'); 
} 
?>
