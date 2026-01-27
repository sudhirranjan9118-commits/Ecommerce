<?php 
include_once('connection.php'); 
session_start(); 
if(isset($_SESSION['auth_user'])) { 
    if(isset($_POST['product_id'])) { 
        $product_id = $_POST['product_id']; 
        $name = $_POST['name']; 
        $unit_price = $_POST['unit_price']; 
        $quantity = $_POST['quantity']; 
        $file = $_POST['file']; 
        if(isset($_FILES['file']) && $_FILES['file']['error'] == 0) { 
            $file_name = $_FILES['file']['name']; 
            $file_tmp = $_FILES['file']['tmp_name']; 
            $file_path = 'uploads/' . $file_name; 
            if(move_uploaded_file($file_tmp, $file_path)) { 
                $query = "UPDATE products SET name='$name', unit_price='$unit_price', quantity='$quantity', file='$file_path' WHERE id='$product_id'"; 
            } else { 
                $_SESSION['error']="File upload failed."; 
                header("Location: update-products.php?id=$product_id"); 
                exit; 
            } 
        } else { 
            $query = "UPDATE products SET name='$name', unit_price='$unit_price', quantity='$quantity' WHERE id='$product_id'"; 
        } 
        if($conn->query($query) === TRUE) { 
            $_SESSION['success']="Product updated successfully."; 
            header("Location: products.php"); 
            exit; 
        } else { 
            $_SESSION['error']="Something went wrong."; 
            header("Location: update-products.php?id=$product_id"); 
            exit; 
        } 
    } else { 
        header('Location: products.php'); 
    } 
} else { 
    header('Location: index.php'); 
} 
?>