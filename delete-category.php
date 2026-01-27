<?php 
session_start(); 
include_once('connection.php'); 

if(isset($_SESSION['auth_user'])) { 
    if(isset($_GET['id'])) { 
        $category_id = $_GET['id'];

        // Prepare the delete statement
        $stmt = $conn->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->bind_param("i", $category_id);
        $result = $stmt->execute();

        $stmt->close();
        $conn->close();

        if($result) { 
            $_SESSION['success'] = "Category deleted successfully."; 
        } else { 
            $_SESSION['error'] = "Something went wrong while deleting the category."; 
        } 
        header('Location: categories-list.php'); 
        exit();
    } else { 
        header('Location: categories-list.php'); 
        exit();
    }
} else { 
    header('Location: index.php'); 
    exit();
} 
?>
