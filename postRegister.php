<?php
include_once('connection.php');
session_start();
$firt_name = $email = $password = $confirm_password = "";

if(isset($_POST['register']))
{

	$errors=array();
	$first_name=test_input($_POST['first_name']);
	$last_name=test_input($_POST['last_name']);
	$email=test_input($_POST['email']);
	$password=test_input($_POST['password']);
	$confirm_password=test_input($_POST['confirm_password']);

	$query="SELECT *from users where email='".$email."';";
	$result=$conn->query($query);

	if(is_null($first_name))
	{
		$errors['first_name']='First name is required.';
	}

	if($result->num_rows>0)
	{
		$errors['email']='Email already exists';
	}

	if($password!=$confirm_password)
	{
		$errors['password']='Password and confirm password does not matched';
	}

	if(count($errors))
	{
		$_SESSION['errors']=$errors;
	}
	else
	{
		$stmt = $conn->prepare("INSERT INTO users(first_name,last_name,email,password) VALUES(?,?,?,?)");
		$stmt->bind_param("ssss", $first_name, $last_name, $email, $password);
		$result=$stmt->execute();
		$stmt->close();
		$conn->close();
		if($result)
		{
			$_SESSION['success']="User Registered successfully.";
		}
		else
		{
			$_SESSION['error']="Something went wrong.";
		}
	}

	header('Location: index.php');
}
else
{
	header('Location: index.php');
}

function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>