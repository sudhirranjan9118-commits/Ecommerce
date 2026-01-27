<!DOCTYPE html>
<html lang="en">
    <?php include'Admin/head.php'; ?>

    <body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>

        <div id="wrapper">
<?php include'Admin/header.php'; ?>
         <?php include'Admin/sidebar.php'; ?>

            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                                            <li class="breadcrumb-item active">Customers</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Customers</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-sm-4">
                                                <a href="javascript:void(0);" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Add Customers</a>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="text-sm-end">
                                                    <button type="button" class="btn btn-success mb-2 me-1"><i class="mdi mdi-cog"></i></button>
                                                    <button type="button" class="btn btn-light mb-2 me-1">Import</button>
                                                    <button type="button" class="btn btn-light mb-2">Export</button>
                                                </div>
                                            </div>
                                        </div>
                
                                        <div class="table-responsive">
                                            <table class="table table-centered table-striped dt-responsive nowrap w-100" id="products-datatable">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 20px;">
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" id="customCheck1">
                                                                <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                                            </div>
                                                        </th>
                                                        <th>Customer</th>
                                                        <th>Phone</th>
                                                        <th>Balance</th>
                                                        <th>Orders</th>
                                                        <th>Last Order</th>
                                                        <th>Status</th>
                                                        <th style="width: 75px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" id="customCheck2">
                                                                <label class="form-check-label" for="customCheck2">ABC</label>
                                                            </div>
                                                        </td>
                                                        <td class="table-user">
                                                            <img src="assets/images/users/user-4.jpg" alt="table-user" class="me-2 rounded-circle">
                                                            <a href="javascript:void(0);" class="text-body fw-semibold">Paul J. Friend</a>
                                                        </td>
                                                        <td>050 414 8778</td>
                                                        <td>
                                                            $12,874.82
                                                        </td>
                                                        <td>
                                                            43
                                                        </td>
                                                        <td>
                                                            August 05 2019 <small class="text-muted">10:29 PM</small>
                                                        </td>
                                                        <td>
                                                            <span class="badge badge-soft-success">Active</span>
                                                        </td>
                    
                                                        <td>
                                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container -->

                </div> <!-- content -->

                <?php include'Admin/footer.php'; ?>
            </div>
        </div>
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- third party js -->
        <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
        <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
        <script src="assets/libs/jquery-datatables-checkboxes/js/dataTables.checkboxes.min.js"></script>
        <!-- third party js ends -->

        <!-- Datatables init -->
        <script src="assets/js/pages/customers.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        
    </body>
</html>