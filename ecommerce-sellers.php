<!DOCTYPE html>
<html lang="en">
    <?php include'Admin/head.php'?>
    <!-- body start -->
    <body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>

        <!-- Begin page -->
        <div id="wrapper">
<?php include'Admin/header.php'?>
            <?php include'Admin/sidebar.php'?>
            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                                            <li class="breadcrumb-item active">Sellers</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Sellers</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row justify-content-between mb-2">
                                            <div class="col-auto">
                                                <form class="search-bar position-relative mb-sm-0 mb-2">
                                                    <input type="text" class="form-control" placeholder="Search...">
                                                    <span class="mdi mdi-magnify"></span>
                                                </form>                          
                                            </div>
                                            <div class="col-md-6">
                                                <div class="text-md-end">
                                                    <button type="button" class="btn btn-danger waves-effect waves-light mb-2 me-2"><i class="mdi mdi-basket me-1"></i> Add Sellers</button>
                                                    <button type="button" class="btn btn-success waves-effect waves-light mb-2 me-1"><i class="mdi mdi-cog"></i></button>
                                                </div>
                                            </div><!-- end col-->
                                        </div>
                
                                        <div class="table-responsive">
                                            <table class="table table-centered table-nowrap table-borderless table-hover mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th style="width: 20px;">
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" id="customCheck1">
                                                                <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                                            </div>
                                                        </th>
                                                        <th>Owner Name</th>
                                                        <th>Store Name</th>
                                                        <th>Ratings</th>
                                                        <th>Products</th>
                                                        <th>Wallet Balance</th>
                                                        <th>Create Date</th>
                                                        <th>Revenue</th>
                                                        <th style="width: 82px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" id="customCheck2">
                                                                <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td class="table-user">
                                                            <img src="assets/images/users/user-2.jpg" alt="table-user" class="me-2 rounded-circle">
                                                            <a href="javascript:void(0);" class="text-body fw-semibold">Paul J. Friend</a>
                                                        </td>
                                                        <td>
                                                            Homovee
                                                        </td>
                                                        <td>
                                                            <i class="mdi mdi-star text-warning"></i> 4.9
                                                        </td>
                                                        <td>
                                                            <span class="fw-semibold">128</span>
                                                        </td>
                                                        <td>
                                                            $128,250
                                                        </td>
                                                        <td>
                                                            07/07/2018
                                                        </td>
                                                        <td>
                                                            $258.26k
                                                        </td>
                    
                                                        <td>
                                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <ul class="pagination pagination-rounded justify-content-end my-2">
                                            <li class="page-item">
                                                <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                                    <span aria-hidden="true">«</span>
                                                    <span class="visually-hidden">Previous</span>
                                                </a>
                                            </li>
                                            <li class="page-item active"><a class="page-link" href="javascript: void(0);">1</a></li>
                                            <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                                            <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li>
                                            <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                                            <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
                                            <li class="page-item">
                                                <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                                    <span aria-hidden="true">»</span>
                                                    <span class="visually-hidden">Next</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container -->

                </div> <!-- content -->

               <?php include'Admin/footer.php'?>

            </div>
        </div>
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        
    </body>
</html>