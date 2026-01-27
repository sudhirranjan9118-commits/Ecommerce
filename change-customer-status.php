<?php 
session_start(); 
include_once('connection.php'); 

if(isset($_SESSION['auth_user'])) { 
    $user_id=$_GET['id']; 
    $stmt = $conn->prepare("SELECT * from users where id=?"); 
    $stmt->bind_param("i", $user_id); 
    $stmt->execute(); 
    $result = $stmt->get_result(); 

    if($result->num_rows) { 
        $user=$result->fetch_object(); 
        $status = $user->status == 1 ? 0 : 1; 
        $message = $status == 1 ? 'activated' : 'deactivated'; 
        $stmt = $conn->prepare("UPDATE users set status= ? where id=?"); 
        $stmt->bind_param("ii", $status, $user_id); 
        $result=$stmt->execute(); 
        $stmt->close(); 
        $conn->close(); 

        if($result) { 
            $_SESSION['success']="Customer$message successfully.."; 
        } else { 
            $_SESSION['error']="Something went wrong."; 
        } 
        header('Location: customers-list.php'); 
    } else { 
        $_SESSION['error']="Something went wrong."; 
        header('Location: customers-list.php'); 
    } 
} else { 
    $_SESSION['error']="Something went wrong."; 
    header('Location: index.php'); 
} 
?>