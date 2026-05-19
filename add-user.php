<?php
session_start();
include_once('connection.php');

if(isset($_SESSION['auth_user']))
{
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
								<div class="card">
									<div class="card-header bg-info">
										<div class="row">
											<div class="col-md-6">
												<h3>Add Support User Detail</h3>
											</div>
											<div class="col-md-6">
												<a type="button" class="btn btn-secondary waves-effect waves-light float-end" href="users-list.php"><i class="mdi mdi-plus-circle me-1"></i> Back</a>
											</div>
										</div>
									</div>
									<div class="card-body">
										<div class="row d-flex justify-content-center">
											<div class="col-md-6">
												<form class="px-3" action="save-user.php" method="POST">
													<div class="mb-3">
														<label for="username" class="form-label">First Name</label>
														<input class="form-control" type="text" name="first_name" required="" placeholder="Michael Zenaty">
														<?php
														if(isset($_SESSION['errors']['first_name']))
														{
															echo '<span class="text-danger">'.$_SESSION['errors']['first_name'].'</span>';
															unset($_SESSION['errors']['first_name']);
														}
														?>
													</div>

													<div class="mb-3">
														<label for="username" class="form-label">Last Name</label>
														<input class="form-control" type="text" name="last_name" required="" placeholder="Michael Zenaty">
													</div>

													<div class="mb-3">
														<label for="emailaddress" class="form-label">Email address</label>
														<input class="form-control" type="email" name="email" id="emailaddress" required="" placeholder="john@deo.com">
														<?php
														if(isset($_SESSION['errors']['email']))
														{
															echo '<span class="text-danger">'.$_SESSION['errors']['email'].'</span>';
															unset($_SESSION['errors']['email']);
														}
														?>
													</div>
													<div class="mb-3">
														<label for="mobile_number" class="form-label">Mobile Number</label>
														<input class="form-control" type="number" name="mobile" id="mobile_number" required placeholder="Enter your mobile number">
														<?php if(isset($_SESSION['errors']['mobile'])) { 
															echo '<span class="text-danger">'.$_SESSION['errors']['mobile'].'</span>'; 
															unset($_SESSION['errors']['mobile']); 
														} ?>
													</div>
													<div class="mb-3">
														<label for="password" class="form-label">Password</label>
														<input class="form-control" type="password" name="password" required="" placeholder="Enter your password">
														<?php
														if(isset($_SESSION['errors']['password']))
														{
															echo '<span class="text-danger">'.$_SESSION['errors']['password'].'</span>';
															unset($_SESSION['errors']['password']);
														}
														?>
													</div>

													<div class="mb-3">
														<label for="password" class="form-label">Confirm Password</label>
														<input class="form-control" type="password" name="confirm_password" required=""placeholder="Enter your password">
													</div>


													<div class="mb-3">
														<div class="form-check">
															<input type="checkbox" class="form-check-input" name="remember" id="customCheck1">
															<label class="form-check-label" for="customCheck1">I accept <a href="#">Terms and Conditions</a></label>
														</div>
													</div>

													<div class="mb-3 text-end">
														<button class="btn btn-primary" type="submit" name="save-user" value="save-user">Save</button>
													</div>
												</form>
											</div>
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
}
else
{
	header('Location: index.php');
}

?>

