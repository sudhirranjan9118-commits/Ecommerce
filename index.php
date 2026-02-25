<!DOCTYPE html>
<html lang="en">

<?php 
include_once('connection.php'); 
include('Front/head.php');
?>

<body class="loading" data-layout-mode="horizontal">
    <div id="wrapper">
        <?php include('front/header.php'); ?>
        <?php include('front/sidebar.php'); ?>

        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    
                    <!-- Page Title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Products</a></li>
                                        <li class="breadcrumb-item active">All Products</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Our Products</h4>
                            </div>
                        </div>
                    </div>

                    <!-- Products Grid -->
                    <div class="row">
                        <?php
                        $sql = "SELECT * FROM products ORDER BY created_at DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                ?>
                                <div class="col-md-4">
                                    <div class="card mb-4">
                                        <?php if($row['file']) { ?>
                                            <img class="card-img-top" src="<?= $row['file']; ?>" alt="<?= $row['name']; ?>">
                                        <?php } ?>
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $row['name']; ?></h5>
                                            <p class="card-text"><?= $row['description']; ?></p>
                                            <p class="card-text"><strong>Price:</strong> $<?= $row['unit_price']; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo "<div class='col-12'><p>No products found.</p></div>";
                        }
                        ?>
                    </div>

                </div> <!-- container-fluid -->
            </div> <!-- content -->
        </div> <!-- content-page -->

        <?php include('front/footer.php'); ?>
    </div> <!-- wrapper -->

    <?php include('front/script.php'); ?>
</body>
</html>
