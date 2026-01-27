<?php
include_once('connection.php');
session_start();
$firt_name = $email = $password = $confirm_password = "";

if(isset($_POST['update-user']))
{

	$errors=array();
	$user_id=test_input($_POST['user_id']);
	$first_name=test_input($_POST['first_name']);
	$last_name=test_input($_POST['last_name']);
	$email=test_input($_POST['email']);
	$password=test_input($_POST['password']);
	$confirm_password=test_input($_POST['confirm_password']);


	$stmt = $conn->prepare("SELECT *from users where id=?");
	$stmt->bind_param("i", $user_id);
	$stmt->execute();
	$result = $stmt->get_result();

	if($result->num_rows)
	{
		$stmt = $conn->prepare("SELECT *from users where email=? and id!=? ");
		$stmt->bind_param("si", $email,$user_id);
		$stmt->execute();
		$result = $stmt->get_result();

		if($result->num_rows>0)
		{
			$errors['email']='Email already exists';
		}

		if(is_null($first_name))
		{
			$errors['first_name']='First name is required.';
		}
		if($password!=$confirm_password)
		{
			$errors['password']='Password and confirm password does not matched';
		}

		if(count($errors))
		{
			$_SESSION['errors']=$errors;
			header("Location: edit-user.php?id=$user_id");
		}
		else
		{
			$stmt = $conn->prepare("UPDATE users SET first_name=?, last_name=?, email=?, password=? where id=?");
			$stmt->bind_param("ssssi", $first_name, $last_name, $email, $password, $user_id);
			$result=$stmt->execute();
			$stmt->close();
			$conn->close();

			if($result)
			{
				$_SESSION['success']="User updated successfully.";
			}
			else
			{
				$_SESSION['error']="Something went wrong.";
			}
			header('Location: users-list.php');
		}
	}
	else
	{
		$_SESSION['error']="User does not exists.";
		header('Location: users-list.php');
	}

}
else
{
	header('Location: admin-dashboard.php');
}

function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>