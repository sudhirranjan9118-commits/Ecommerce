<?php 
include_once('connection.php'); 
session_start(); 

if(isset($_SESSION['auth_user'])) { 
    if(isset($_SESSION['auth_user']->id)) {
        $user_id = $_SESSION['auth_user']->id;
        $query = "SELECT * FROM users WHERE id = '$user_id'";
        $result = $conn->query($query);
        if($result->num_rows > 0) {
            $user_data = $result->fetch_object();
        } else {
            echo "User not found";
            exit;
        }
    } else {
        echo "User ID not found";
        exit;
    }
?>

<!DOCTYPE html> 
<html lang="en"> 
<?php include'Admin/head.php'; ?>
<!-- body start -->
<body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>
    <div id="wrapper">
        <?php include'Admin/header.php'; ?>
        <?php include 'Admin/sidebar.php';?>
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                   
                                </div>
                                <h4 class="page-title">Profile</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-xl-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <img src="<?php echo isset($user_data->profile_picture) ? 'uploads/' . $user_data->profile_picture : 'assets/images/users/default.jpg'; ?>" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">

                                    <?php if(isset($user_data)) { ?>
                                        <h4 class="mb-0"><?php echo $user_data->first_name . ' ' . $user_data->last_name; ?></h4>
                                        <p class="text-muted">@<?php echo $user_data->email; ?></p>
                                        <div class="text-start mt-3">
                                            <h4 class="font-13 text-uppercase">About Me :</h4>
                                            <p class="text-muted font-13 mb-3"> Hi I'm <?php echo $user_data->first_name; ?>, welcome to my profile.</p>
                                            <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ms-2"><?php echo $user_data->first_name . ' ' . $user_data->last_name; ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ms-2"><?php echo $user_data->mobile; ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ms-2"><?php echo $user_data->email; ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Gender :</strong> <span class="ms-2"><?php echo $user_data->gender; ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Date of Birth :</strong> <span class="ms-2"><?php echo isset($user_data->dob) ? $user_data->dob : 'N/A'; ?></span></p>
                                            <p class="text-muted mb-1 font-13"><strong>Location :</strong> <span class="ms-2"><?php echo isset($user_data->location) ? $user_data->location : 'N/A'; ?></span></p>
                                        </div>
                                    <?php } else { ?>
                                        <p>No user data found.</p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-xl-8">
                            <div class="card">
                                <div class="card-body">
                                    <form>
                                        <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Personal Info</h5>
                                        <?php if(isset($user_data)) { ?>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="firstname" class="form-label">First Name</label>
                                                        <input type="text" class="form-control" id="firstname" value="<?php echo $user_data->first_name; ?>" placeholder="Enter first name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="lastname" class="form-label">Last Name</label>
                                                        <input type="text" class="form-control" id="lastname" value="<?php echo $user_data->last_name; ?>" placeholder="Enter last name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="useremail" class="form-label">Email Address</label>
                                                        <input type="email" class="form-control" id="useremail" value="<?php echo $user_data->email; ?>" placeholder="Enter email">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="mobile" class="form-label">Mobile</label>
                                                        <input type="number" class="form-control" id="mobile" value="<?php echo $user_data->mobile; ?>" placeholder="Enter mobile number">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="dob" class="form-label">Date of Birth</label>
                                                        <input type="date" class="form-control" id="dob" value="<?php echo isset($user_data->dob) ? $user_data->dob : ''; ?>" placeholder="Select date of birth">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="gender" class="form-label">Gender</label>
                                                        <div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="gender" id="male" value="male" <?php if($user_data->gender == 'male') { echo 'checked'; } ?>>
                                                                <label class="form-check-label" for="male">Male</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="gender" id="female" value="female" <?php if($user_data->gender == 'female') { echo 'checked'; } ?>>
                                                                <label class="form-check-label" for="female">Female</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="gender" id="other" value="other" <?php if($user_data->gender == 'other') { echo 'checked'; } ?>>
                                                                <label class="form-check-label" for="other">Other</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="location" class="form-label">Location</label>
                                                        <input type="text" class="form-control" id="location" value="<?php echo isset($user_data->location) ? $user_data->location : ''; ?>" placeholder="Enter location">
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="text-end">
                                            <button type="submit" name="save-profile" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include'Admin/footer.php'; ?>
        </div>
    </div>
    <div class="rightbar-overlay"></div>
    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>
    <!-- App js -->
    <script src="assets/js/app.min.js"></script>
</body>
</html>
<?php } else { 
    header('Location: index.php'); 
} ?>