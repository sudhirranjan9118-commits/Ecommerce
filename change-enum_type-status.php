<?php 
session_start(); 
include_once('connection.php'); 

if(isset($_SESSION['auth_user'])) { 
    $enum_type_id=$_GET['id']; 
    $stmt = $conn->prepare("SELECT * from enum_types where id=?"); 
    $stmt->bind_param("i", $enum_type_id); 
    $stmt->execute(); 
    $result = $stmt->get_result(); 

    if($result->num_rows) { 
        $enum_type=$result->fetch_object(); 
        $status = $enum_type->status == 1 ? 0 : 1; 
        $message = $status == 1 ? 'activated' : 'deactivated'; 
        $stmt = $conn->prepare("UPDATE enum_types set status= ? where id=?"); 
        $stmt->bind_param("ii", $status, $enum_type_id); 
        $result=$stmt->execute(); 
        $stmt->close(); 
        $conn->close(); 

        if($result) { 
            $_SESSION['success']="Enum type $message successfully.."; 
        } else { 
            $_SESSION['error']="Something went wrong."; 
        } 
        header('Location: enum_type.php'); 
    } else { 
        $_SESSION['error']="Something went wrong."; 
        header('Location: enum_type.php'); 
    } 
} else { 
    $_SESSION['error']="Something went wrong."; 
    header('Location: index.php'); 
} 
?>