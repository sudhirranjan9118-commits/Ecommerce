<?php 
include_once('connection.php'); 
session_start(); 

$name = $name_alias = $status = $position = $icon = "";
if(isset($_POST['update-role'])) { 
    $errors = array(); 
    $role_id = $_POST['id'];
    $name = test_input($_POST['name']); 
    $name_alias = test_input($_POST['name_alias']); 
    $status = test_input($_POST['status']); 
    $position = test_input($_POST['position']); 

    if(isset($_FILES['icon']) && $_FILES['icon']['error'] == 0) {
        $icon = $_FILES['icon']['name'];
        $tmp_name = $_FILES['icon']['tmp_name'];
        $path = "uploads/".$icon;
        move_uploaded_file($tmp_name, $path);
    }

    if(count($errors)) { 
        $_SESSION['errors']=$errors; 
        header("Location: edit-role.php?id=$role_id"); 
    } else { 
        if(isset($icon)) {
            $stmt = $conn->prepare("UPDATE roles SET name=?, name_alias=?, status=?, position=?, icon=? where id=?");
            $stmt->bind_param("ssssss", $name, $name_alias, $status, $position, $icon, $role_id);
        } else {
            $stmt = $conn->prepare("UPDATE roles SET name=?, name_alias=?, status=?, position=? where id=?");
            $stmt->bind_param("sssss", $name, $name_alias, $status, $position, $role_id);
        }
        $result=$stmt->execute();
        $stmt->close();
        $conn->close();

        if($result) { 
            $_SESSION['success']="role updated successfully."; 
        } else { 
            $_SESSION['error']="Something went wrong."; 
        } 
        header('Location: roles.php'); 
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