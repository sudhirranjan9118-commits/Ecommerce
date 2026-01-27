<?php 
include_once('connection.php'); 
session_start(); 

$first_name = $last_name = $email = $mobile = $password = $gender = $dob = $location = "";

if(isset($_POST['save-profile'])) { 
    $errors = array(); 
    $first_name = test_input($_POST['first_name']); 
    $last_name = test_input($_POST['last_name']); 
    $email = test_input($_POST['email']); 
    $mobile = test_input($_POST['mobile']); 
    $gender = test_input($_POST['gender']); 
    $date_of_birth = test_input($_POST['date_of_birth']); 
    $location = test_input($_POST['location']); 
    $password = test_input($_POST['password']); 
    $confirm_password = test_input($_POST['confirm_password']); 


    $query = "SELECT * from users where email='".$email."';"; 
    $result = $conn->query($query); 

    if(empty($first_name)) { 
        $errors['first_name']='First name is required.'; 
    } 
    if($result->num_rows > 0) { 
        $errors['email']='Email already exists'; 
    } 
    $query_mobile = "SELECT * from users where mobile='".$mobile."';"; 
    $result_mobile = $conn->query($query_mobile); 
    if($result_mobile->num_rows > 0) { 
        $errors['mobile']='Number already exists'; 
    } 
    if($password != $confirm_password) { 
        $errors['password']='Password and confirm password does not matched'; 
    } 

    if(count($errors)) { 
        $_SESSION['errors']=$errors; 
        header('Location: profile.php'); 
    } else { 
        $password = password_hash($password, PASSWORD_DEFAULT);
        $created_at = date("Y-m-d H:i:s"); 
        $updated_at = date("Y-m-d H:i:s"); 

        $stmt = $conn->prepare("INSERT INTO users(first_name,last_name,email,mobile,password,gender,date_of_birth,location,created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?,?)"); 
        $stmt->bind_param("ssssssssss", $first_name, $last_name, $email, $mobile, $password, $gender, $date_of_birth, $location, $created_at, $updated_at); 
        $result = $stmt->execute(); 
        $stmt->close(); 
        $conn->close(); 

        if($result) { 
            $_SESSION['success']="Profile saved successfully."; 
        } else { 
            $_SESSION['error']="Something went wrong."; 
        } 
        header('Location: profile.php'); 
    } 
} else { 
    header('Location: index.php'); 
} 

function test_input($data) { 
    $data = trim($data); 
    $data = stripslashes($data); 
    $data = htmlspecialchars($data); 
    return $data; 
} 
?>
