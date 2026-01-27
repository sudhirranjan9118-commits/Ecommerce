<?php 
include_once('connection.php'); 
session_start(); 

if(isset($_POST['update-role'])) { 
    $errors = array(); 
    $role_menu_id = test_input($_POST['role_menu_id']); 
    $name = test_input($_POST['name']); 
    $name_alias = test_input($_POST['name_alias']); 
    $position = test_input($_POST['position']); 
    $status = test_input($_POST['status']);

    if(is_null($name)) { 
        $errors['name']='Name is required.'; 
    }

    if(count($errors)) { 
        $_SESSION['errors']=$errors; 
        header("Location: edit-role_menu.php?id=$role_menu_id"); 
    } else { 
        $stmt = $conn->prepare("UPDATE role_menu SET name=?, name_alias=?, position=?, status=? where id=?"); 
        $stmt->bind_param("sssii", $name, $name_alias, $position, $status, $role_menu_id); 
        $result=$stmt->execute(); 
        $stmt->close(); 
        $conn->close(); 

        if($result) { 
            $_SESSION['success']="Role menu updated successfully."; 
        } else { 
            $_SESSION['error']="Something went wrong."; 
        } 
        header('Location: role_menu.php'); 
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