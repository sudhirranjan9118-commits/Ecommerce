<?php 
include_once('connection.php'); 
session_start(); 

if(isset($_POST['update-enum_type'])) { 
    $errors = array(); 
    $enum_type_id = $_POST['id'];
    $name = test_input($_POST['name']); 
    $name_alias = test_input($_POST['name_alias']); 
    $status = test_input($_POST['status']); 
    $enum_type = test_input($_POST['enum_type']);

    if(count($errors)) { 
        $_SESSION['errors']=$errors; 
        header("Location: edit-enum_type.php?id=$enum_type_id"); 
    } else { 
        $stmt = $conn->prepare("UPDATE enum_types SET name=?, name_alias=?, status=?, enum_type=? where id=?");
        $stmt->bind_param("sssss", $name, $name_alias, $status, $enum_type, $enum_type_id);
        $result=$stmt->execute();
        $stmt->close();
        $conn->close();

        if($result) { 
            $_SESSION['success']="Enum type updated successfully."; 
        } else { 
            $_SESSION['error']="Something went wrong."; 
        } 
        header('Location: enum_type.php'); 
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