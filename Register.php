<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Register & Signup | UBold - Responsive Admin Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="assets/images/favicon.ico">
		<link href="assets/css/config/creative/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
		<link href="assets/css/config/creative/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
		<link href="assets/css/config/creative/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
		<link href="assets/css/config/creative/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />
		<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="loading authentication-bg authentication-bg-pattern">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <div class="auth-logo">
                                        <a href="index.html" class="logo logo-dark text-center">
                                            <span class="logo-lg">
                                                <img src="assets/images/logo-dark.png" alt="" height="22">
                                            </span>
                                        </a>
                    
                                        <a href="index.html" class="logo logo-light text-center">
                                            <span class="logo-lg">
                                                <img src="assets/images/logo-light.png" alt="" height="22">
                                            </span>
                                        </a>
                                    </div>
                                    <p class="text-muted mb-4 mt-3">Don't have an account? Create your account, it takes less than a minute</p>
                                </div>

                                <form action="postRegister.php" method="POST">

                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">First Name</label>
                                        <input class="form-control" type="text" id="first_name" name="first_name" placeholder="Enter your name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Last_name</label>
                                        <input class="form-control" type="text" id="last_name" name="last_name" placeholder="Enter your name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="emailaddress" class="form-label">Email address</label>
                                        <input class="form-control" type="email" id="emailaddress" name="email" required placeholder="Enter your email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirm_password" class="form-label">confirm_password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="confirm_password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Enter your password">
                                            <div class="input-group-text" data-password="false">
                                                <span class="confirm_password-eye"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkbox-signup">
                                            <label class="form-check-label" for="checkbox-signup">I accept <a href="javascript: void(0);" class="text-dark">Terms and Conditions</a></label>
                                        </div>
                                    </div>
                                    <div class="text-center d-grid">
                                        <button class="btn btn-success" type="submit" name="register"> Sign Up </button>
                                    </div>

                                </form>

                                <div class="text-center">
                                    <h5 class="mt-3 text-muted">Sign up using</h5>
                                    <ul class="social-list list-inline mt-3 mb-0">
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github"></i></a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                       

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-white-50">Already have account?  <a href="Login.php" class="text-white ms-1"><b>Sign In</b></a></p>
                            </div>
                        </div>
                        
                    </div>
                </div> 
            </div>
        </div>
        

        <footer class="footer footer-alt">
            2015 - <script>document.write(new Date().getFullYear())</script> &copy; UBold theme by <a href="" class="text-white-50">Coderthemes</a> 
        </footer>

       
        <script src="assets/js/vendor.min.js"></script>

        
        <script src="assets/js/app.min.js"></script>
        
    </body>
</html>