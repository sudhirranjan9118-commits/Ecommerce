<!DOCTYPE html>
<html lang="en">
<?php 
include_once('connection.php'); 
include('Front/head.php');
?>
<style>
    body{
        background:#f5f5f6;
    }
    .main-slider{
        margin-top: 110px;
    }

    .main-slider img{
        height: 500px;
        object-fit: cover;
        border-radius: 15px;
    }

    .offer-banner img{
        height: 220px;
        object-fit: cover;
        border-radius: 15px;
    }

    .carousel{
        overflow: hidden;
    }

    .carousel-caption{
        background: rgba(0,0,0,0.5);
        border-radius: 10px;
        padding: 15px;
    }

    .carousel-caption h2{
        font-weight: bold;
    }
    .product-card{
        background:#fff;
        border:none;
        border-radius:0;
        overflow:hidden;
        transition:0.3s;
        margin-bottom:25px;
    }
    .product-card:hover{
        box-shadow:0px 4px 20px rgba(0,0,0,0.12);
        transform:translateY(-5px);
    }
    .product-img{
        width:100%;
        height:320px;
        object-fit:cover;
        background:#f2f2f2;
    }
    .product-body{
        padding:12px;
    }

    .brand-name{
        font-size:18px;
        font-weight:700;
        color:#282c3f;
        margin-bottom:2px;
    }
    .product-name{
        font-size:15px;
        color:#535766;
        height:45px;
        overflow:hidden;
        margin-bottom:8px;
    }
    .price{
        font-size:18px;
        font-weight:700;
        color:#282c3f;
    }
    .old-price{
        text-decoration:line-through;
        color:#94969f;
        font-size:14px;
        margin-left:5px;
    }
    .discount{
        color:#ff905a;
        font-size:14px;
        margin-left:5px;
    }
    .view-btn{
        width:100%;
        margin-top:12px;
        border-radius:4px;
        font-weight:600;
    }

    /* Rating */
    .rating-box{
        position:absolute;
        bottom:10px;
        left:10px;
        background:white;
        padding:3px 8px;
        font-size:13px;
        font-weight:600;
        border-radius:3px;
    }
    .product-image-box{
        position:relative;
    }
    .modal-product-img{
        width:100%;
        height:450px;
        object-fit:cover;
        border-radius:10px;
    }
</style>
<body class="loading" data-layout-mode="horizontal">
    <div id="wrapper">
        <?php include('front/header.php'); ?>
        <?php include('front/sidebar.php'); ?>
        <div class="content-page">
            <div class="content">
                <div class="container-fluid main-slider mt-4">
                    <div id="ecommerceSlider" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#ecommerceSlider" data-bs-slide-to="0" class="active"></button>
                            <button type="button" data-bs-target="#ecommerceSlider" data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#ecommerceSlider" data-bs-slide-to="2"></button>
                            <button type="button" data-bs-target="#ecommerceSlider" data-bs-slide-to="3"></button>
                        </div>
                        <!-- Images -->
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                            <img src="front/banner/banner-fashion.jpg" class="d-block w-100" alt="Fashion Sale">
                            <div class="carousel-caption">
                                <h2>New Fashion Collection</h2>
                                <p>Up To 50% OFF On Trending Products</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="front/banner/electronic banner-2.jpg" class="d-block w-100" alt="Electronics">
                            <div class="carousel-caption">
                                <h2>Latest Electronics</h2>
                                <p>Smart Gadgets At Best Prices</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="front/banner/Shoes banner-1.jpg" class="d-block w-100" alt="Shoes">
                            <div class="carousel-caption">
                                <h2>Premium Shoes</h2>
                                <p>Comfort + Style Together</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="front/banner/Beauty banner-5.jpg" class="d-block w-100" alt="Beauty">
                            <div class="carousel-caption">
                                <h2>Beauty & Skincare</h2>
                                <p>Glow Everyday With New Deals</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#ecommerceSlider" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#ecommerceSlider" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>


<!-- OFFER BANNER -->
<div class="container mt-4">
    <div class="offer-banner">
        <img src="front/banner/offer 2.jpg" class="w-100" alt="Offer Banner">
    </div>
</div>

</div>
</div>
</div>
<div class="row">
    <?php
    $sql = "SELECT * FROM products ORDER BY created_at DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product-card">
                    <div class="product-image-box">
                        <img src="<?= $row['file']; ?>" alt="<?= $row['name']; ?>"class="product-img"><div class="rating-box">4.3 ★</div>
                    </div>
                    <div class="product-body">
                        <div class="brand-name"><?= $row['name']; ?></div>
                        <div class="product-name">
                            <?= substr($row['description'],0,50); ?>
                        </div>
                        <div>
                            <span class="price">₹<?= $row['unit_price']; ?></span>
                            <span class="old-price">₹4999</span>
                            <span class="discount">(50% OFF)</span>
                        </div>
                        <button 
                        class="btn btn-dark view-btn"data-bs-toggle="modal"data-bs-target="#productModal<?= $row['id']; ?>">View Product</button>
                    </div>
                </div>
            </div>
            <div 
            class="modal fade"id="productModal<?= $row['id']; ?>"tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            <?= $row['name']; ?>
                        </h4>
                        <button 
                        type="button"class="btn-close"data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="<?= $row['file']; ?>"class="modal-product-img">
                        </div>
                        <div class="col-md-6">
                            <h2><?= $row['name']; ?></h2>
                            <h3 class="text-success mt-3">₹<?= $row['unit_price']; ?></h3>
                            <p class="mt-3"><?= $row['description']; ?></p>
                            <button class="btn btn-success px-4 mt-3">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
} 
else {
    echo "
    <div class='col-12'>
    <h4 class='text-center'>No Products Found</h4>
    </div>
    ";}
    ?>
</div>
</div>
</div>
</div>
<?php include('front/footer.php'); ?>
</div>
<?php include('front/script.php'); ?>
</body>
</html>