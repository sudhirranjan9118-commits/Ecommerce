<?php 
session_start(); 
include_once('connection.php'); 

if(isset($_SESSION['auth_user'])) { 
    if(isset($_GET['id'])) { 
        $brand_id = $_GET['id'];

        // ✅ Prepare delete query
        $stmt = $conn->prepare("DELETE FROM brands WHERE id = ?");
        $stmt->bind_param("i", $brand_id);
        $result = $stmt->execute();

        $stmt->close();
        $conn->close();

        if($result) { 
            $_SESSION['success'] = "Brand deleted successfully."; 
        } else { 
            $_SESSION['error'] = "Something went wrong while deleting the brand."; 
        } 

        header('Location: brand.php'); 
        exit();

    } else { 
        header('Location: brand.php'); 
        exit();
    }
} else { 
    header('Location: index.php'); 
    exit();
} 
?>
