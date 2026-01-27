<?php 
include_once('connection.php'); 
session_start(); 

$first_name = $last_name = $email = $mobile = $password = $confirm_password = ""; 

if(isset($_POST['save-user'])) { 
    $errors = array(); 
    $first_name = test_input($_POST['first_name']); 
    $last_name = test_input($_POST['last_name']); 
    $email = test_input($_POST['email']); 
    $mobile = test_input($_POST['mobile']); 
    $password = test_input($_POST['password']); 
    $confirm_password = test_input($_POST['confirm_password']); 
    $type = "support"; 
    $created_at = date('Y-m-d H:i:s'); 
    $updated_at = date('Y-m-d H:i:s'); 

    $query = "SELECT * FROM users WHERE email = ? OR mobile = ?"; 
    $stmt = $conn->prepare($query); 
    $stmt->bind_param("ss", $email, $mobile); 
    $stmt->execute(); 
    $result = $stmt->get_result(); 

    if(empty($first_name)) { 
        $errors['first_name'] = 'First name is required.'; 
    } 
    if($result->num_rows > 0) { 
        $row = $result->fetch_assoc(); 
        if($row['email'] == $email) { 
            $errors['email'] = 'Email already exists'; 
        } 
        if($row['mobile'] == $mobile) { 
            $errors['mobile'] = 'Number already exists'; 
        } 
    } 
    if($password != $confirm_password) { 
        $errors['password'] = 'Password and confirm password does not matched'; 
    } 

    if(count($errors)) { 
        $_SESSION['errors'] = $errors; 
        header('Location: users-list.php'); 
    } else { 
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); 
        $stmt = $conn->prepare("INSERT INTO users(first_name, last_name, email, mobile, password, type, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"); 
        $stmt->bind_param("ssssssss", $first_name, $last_name, $email, $mobile, $hashed_password, $type, $created_at, $updated_at); 
        $result = $stmt->execute(); 
        $stmt->close(); 
        $conn->close(); 

        if($result) { 
            $_SESSION['success'] = "User Registered successfully."; 
        } else { 
            $_SESSION['error'] = "Something went wrong."; 
        } 
        header('Location: users-list.php'); 
    } 
} else { 
    header('Location: admin-dashboard.php'); 
} 

function test_input($data) { 
    $data = trim($data); 
    $data = stripslashes($data); 
    $data = htmlspecialchars($data); 
    return $data; 
} 
?>