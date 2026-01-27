
<?php 
session_start(); 
include_once('connection.php'); 

if(isset($_SESSION['auth_user'])) { 
    $roles_id = $_GET['id'];

    $stmt = $conn->prepare("DELETE from roles where id = ?");
    $stmt->bind_param("i", $roles_id);
    $result = $stmt->execute();
    $stmt->close();
    $conn->close();

    if($result) { 
        $_SESSION['success'] = "Roles deleted successfully.";
    } else { 
        $_SESSION['error'] = "Something went wrong.";
    }
    header('Location: roles.php');
} else { 
    header('Location: index.php'); 
}
?>

