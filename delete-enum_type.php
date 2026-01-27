<?php 
session_start(); 
include_once('connection.php'); 
if(isset($_SESSION['auth_user'])) { 
    if(isset($_GET['id'])) { 
        $enum_type_id = $_GET['id'];
        $stmt = $conn->prepare("DELETE from enum_types where id = ?");
        $stmt->bind_param("i", $enum_type_id);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();

        if($result) { 
            $_SESSION['success'] = "Enum type deleted successfully."; 
        } else { 
            $_SESSION['error'] = "Something went wrong."; 
        } 
        header('Location: enum_type.php'); 
    } else { 
        header('Location: enum_type.php'); 
    }
} else { 
    header('Location: index.php'); 
} 
?>