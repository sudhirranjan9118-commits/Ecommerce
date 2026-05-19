<?php
include_once('connection.php');
?>

<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <div id="sidebar-menu">
            <ul id="side-menu">
                <li>
                    <a href="#AdminDashboard" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> Admin </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="AdminDashboard">
                        <ul class="nav-second-level">
                            <li><a href="users-list.php">Users List</a></li>
                            <li><a href="customers-list.php">Customers List</a></li>
                            <li><a href="roles.php">Roles</a></li>
                            <li><a href="Enum_type.php">Enum Types</a></li>
                             <li><a href="Enums.php">Enum</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#productId" data-bs-toggle="collapse">
                        <i data-feather="package"></i>
                        <span> Product </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="productId">
                        <ul class="nav-second-level">
                            <li><a href="categories-list.php">Categories List</a></li>
                            <li><a href="products.php">Products List</a></li>
                            <li><a href="Brand.php">Brands</a></li>
                        </ul>
                    </div>
                </li>

                <!-- ================= ECOMMERCE ================= -->
                <li>
                    <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                        <i data-feather="shopping-cart"></i>
                        <span> Ecommerce </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEcommerce">
                        <ul class="nav-second-level">
                            <li><a href="products.php">Products</a></li>
                            <li><a href="products-detail.php">Product Detail</a></li>
                            <li><a href="add-products.php">Add Product</a></li>
                            <li><a href="customers-list.php">Customers</a></li>
                            <li><a href="orders.php">Orders</a></li>
                            <li><a href="ecommerce-order-detail.php">Order Detail</a></li>
                            <li><a href="ecommerce-sellers.php">Sellers</a></li>
                            <li><a href="ecommerce-shopping-cart.php">Shopping Cart</a></li>
                            <li><a href="ecommerce-checkout.php">Checkout</a></li>
                        </ul>
                    </div>
                </li>

                <?php
                $roleQuery = "SELECT * FROM roles ORDER BY position ASC, id DESC";
                $roleResult = mysqli_query($conn, $roleQuery);

                if ($roleResult && mysqli_num_rows($roleResult) > 0) {
                    while ($role = mysqli_fetch_assoc($roleResult)) {

                        // icon class fallback
                        $iconClass = !empty($role['icon'])
                            ? $role['icon']
                            : 'mdi mdi-circle-outline';

                        $menuResult = mysqli_query($conn, $menuQuery);
                ?>
                        <li>
                            <a href="#role_<?= $role['id']; ?>" data-bs-toggle="collapse">
                                <i class="<?= htmlspecialchars($iconClass); ?>"></i>
                                <span><?= htmlspecialchars($role['name']); ?></span>
                                <span class="menu-arrow"></span>
                            </a>

                            <div class="collapse" id="role_<?= $role['id']; ?>">
                                <ul class="nav-second-level">
                                    <?php
                                    if ($menuResult && mysqli_num_rows($menuResult) > 0) {
                                        while ($menu = mysqli_fetch_assoc($menuResult)) {
                                            echo '<li>
                                                    <a href="'.htmlspecialchars($menu['link']).'">
                                                        '.htmlspecialchars($menu['menu_name']).'
                                                    </a>
                                                  </li>';
                                        }
                                    } else {
                                        echo '<li class="ms-3 text-muted">No menus</li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </li>
                <?php
                    }
                }
                ?>

            </ul>
        </div>

        <div class="clearfix"></div>
    </div>
</div>
