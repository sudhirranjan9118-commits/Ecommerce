<?php
if(isset($_POST['login']))
{
	include_once('connection.php');
	session_start();
	$request=(object) $_POST;
	$email=$request->email;
	$password=$request->password;

	$stmt = $conn->prepare("SELECT *from users where email=? and password=? LIMIT 1;");
	$stmt->bind_param("ss", $email, $password);
	$stmt->execute();

	$result = $stmt->get_result();
	$stmt->close();
	$conn->close();
	if($result->num_rows > 0)
	{
		$user=$result->fetch_object();
		if($user->status)
		{
			$_SESSION['auth_user']=$user;
			if(in_array($user->type, ['admin','support']))
			{
				header('Location: admin-dashboard.php');
			}
			else
			{
				header('Location: customer-dashboard.php');
			}
		}
		else
		{
			$_SESSION['login_error']='Sorry! Your account is blocked. Please contact to your admin.';
			header('Location: index.php');
		}
	}
	else
	{
		$_SESSION['login_error']='Sorry! Invalid credentials.';
		header('Location: index.php');
	}
}
else
{
	header('Location: index.php');
}

?>