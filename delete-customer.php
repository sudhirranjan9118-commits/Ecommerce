<?php 
session_start(); 
include_once('connection.php'); 
if(isset($_SESSION['auth_user'])) { 
    $customer_id=$_GET['id'];
    $stmt = $conn->prepare("SELECT *from users where id=? and type='customer'");
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows) {
        $stmt = $conn->prepare("DELETE from users where id=? and type='customer'");
        $stmt->bind_param("i", $customer_id);
        $result=$stmt->execute();
        $stmt->close();
        $conn->close();
        if($result) {
            $_SESSION['success']="Customer deleted successfully..";
        } else {
            $_SESSION['customer_id'] = $customer_id;
            $_SESSION['error']="Something went wrong.";
        }
        header('Location: customers-list.php');
    } else {
        $_SESSION['error']="Customer not found.";
        header('Location: customers-list.php');
    }
} else {
    header('Location: index.php');
}
?>