<?php 
session_start(); 
include_once('connection.php'); 

if(isset($_SESSION['auth_user'])) { 
    $role_id=$_GET['id']; 
    $stmt = $conn->prepare("SELECT * from roles where id=?"); 
    $stmt->bind_param("i", $role_id); 
    $stmt->execute(); 
    $result = $stmt->get_result(); 

    if($result->num_rows) { 
        $role=$result->fetch_object(); 
        $status = $role->status == 1 ? 0 : 1; 
        $message = $status == 1 ? 'activated' : 'deactivated'; 
        $stmt = $conn->prepare("UPDATE roles set status= ? where id=?"); 
        $stmt->bind_param("ii", $status, $role_id); 
        $result=$stmt->execute(); 
        $stmt->close(); 
        $conn->close(); 

        if($result) { 
            $_SESSION['success']="Role $message successfully.."; 
        } else { 
            $_SESSION['error']="Something went wrong."; 
        } 
        header('Location: roles.php'); 
    } else { 
        $_SESSION['error']="Something went wrong."; 
        header('Location: roles.php'); 
    } 
} else { 
    $_SESSION['error']="Something went wrong."; 
    header('Location: index.php'); 
} 
?>