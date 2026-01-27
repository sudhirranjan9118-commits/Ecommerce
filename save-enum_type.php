<?php 
include_once('connection.php'); 
session_start(); 

$name = $name_alias = $status = $enum_type = "";
if(isset($_POST['save-enum_type'])) { 
    $errors = array(); 
    $name = test_input($_POST['name']); 
    $name_alias = test_input($_POST['name_alias']); 
    $status = test_input($_POST['status']); 
    $enum_type = test_input($_POST['enum_type']); 
    $created_at = date('Y-m-d H:i:s'); 

   
    if(count($errors)) { 
        $_SESSION['errors']=$errors; 
        header('Location: add-enum_type.php'); 
    } else { 
        $stmt = $conn->prepare("INSERT INTO enum_types(name,name_alias,status,enum_type,created_at) VALUES(?,?,?,?,?)"); 
        $stmt->bind_param("sssss", $name, $name_alias, $status,$enum_type,$created_at); 
        $result = $stmt->execute(); 
        $stmt->close(); 
        $conn->close(); 

        if($result) { 
            $_SESSION['success']="Enum type Registered successfully."; 
        } else { 
            $_SESSION['error']="Something went wrong."; 
        } 
        header('Location: Enum_type.php'); 
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