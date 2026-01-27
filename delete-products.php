<?php 
session_start(); 
include_once('connection.php'); 

if(isset($_SESSION['auth_user'])) { 
    $product_id=$_GET['id']; 
    $stmt = $conn->prepare("SELECT *from products where id=?"); 
    $stmt->bind_param("i", $product_id); 
    $stmt->execute(); 
    $result = $stmt->get_result(); 

    if($result->num_rows) { 
        $stmt = $conn->prepare("DELETE from products where id=?"); 
        $stmt->bind_param("i", $product_id); 
        $result=$stmt->execute(); 
        $stmt->close(); 
        $conn->close(); 

        if($result) { 
            $_SESSION['success']="Product deleted successfully.."; 
        } else { 
            $_SESSION['error']="Something went wrong."; 
        } 
        header('Location: products.php'); 
    } else { 
        $_SESSION['error']="Product not found."; 
        header('Location: products.php'); 
    } 
} else { 
    $_SESSION['error']="You are not authorized to delete products."; 
    header('Location: index.php'); 
} 
?>
