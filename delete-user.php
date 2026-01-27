<?php
session_start();
include_once('connection.php');

if(isset($_SESSION['auth_user']))
{

	$user_id=$_GET['id'];

	$stmt = $conn->prepare("SELECT *from users where id=?");
	$stmt->bind_param("i", $user_id);
	$stmt->execute();
	$result = $stmt->get_result();

	if($result->num_rows)
	{
		$stmt = $conn->prepare("DELETE from users where id=?");
		$stmt->bind_param("i", $user_id);
		$result=$stmt->execute();
		$stmt->close();
		$conn->close();
		if($result)
		{
			$_SESSION['success']="User deleted successfully..";
		}
		else
		{
			$_SESSION['error']="Something went wrong.";
		}
		header('Location: users-list.php');

	}
	else
	{
		$_SESSION['error']="Something went wrong.";
		header('Location: users-list.php');
	}
}
else
{
	$_SESSION['error']="Something went wrong.";
	header('Location: index.php');
}



?>