<?php
session_start();
include_once('connection.php');

if(isset($_SESSION['auth_user']))
{

	$category_id=$_GET['id'];

	$stmt = $conn->prepare("SELECT *from categories where id=?");
	$stmt->bind_param("i", $category_id);
	$stmt->execute();
	$result = $stmt->get_result();

	if($result->num_rows)
	{
		$category=$result->fetch_object();

		$status=$category->status ? 0 : 1;
		$message=$category->status ? 'deactivated' : 'activated';

		$stmt = $conn->prepare("UPDATE categories set status= ? where id=?");
		$stmt->bind_param("ii", $status, $category_id);
		$result=$stmt->execute();
		$stmt->close();
		$conn->close();
		if($result)
		{
			$_SESSION['success']="Category $message successfully..";
		}
		else
		{
			$_SESSION['error']="Something went wrong.";
		}
		header('Location: categories-list.php');

	}
	else
	{
		$_SESSION['error']="Something went wrong.";
		header('Location: categories-list.php');
	}
}
else
{
	$_SESSION['error']="Something went wrong.";
	header('Location: index.php');
}



?>