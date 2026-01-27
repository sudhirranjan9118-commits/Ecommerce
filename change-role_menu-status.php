<?php 
session_start(); 
include_once('connection.php'); 

if(isset($_SESSION['auth_user'])) { 
    $role_menu_id=$_GET['id']; 
    $stmt = $conn->prepare("SELECT * from role_menu where id=?"); 
    $stmt->bind_param("i", $role_menu_id); 
    $stmt->execute(); 
    $result = $stmt->get_result(); 

    if($result->num_rows) { 
        $role_menu=$result->fetch_object(); 
        $status = $role_menu->status == 1 ? 0 : 1; 
        $message = $status == 1 ? 'activated' : 'deactivated'; <?php 
session_start(); 
include_once('connection.php'); 

if (!isset($_SESSION['auth_user'])) { 
    $_SESSION['error'] = "Unauthorized access!";
    header('Location: index.php'); 
    exit();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['error'] = "Invalid Role Menu ID!";
    header('Location: role_menu.php');
    exit();
}

$role_menu_id = intval($_GET['id']);

// Fetch current status
$stmt = $conn->prepare("SELECT status FROM role_menu WHERE id = ?");
$stmt->bind_param("i", $role_menu_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['error'] = "Role Menu not found!";
    header('Location: role_menu.php');
    exit();
}

$role_menu = $result->fetch_object();
$stmt->close();

// Toggle status
$new_status = ($role_menu->status == 'active') ? 'inactive' : 'active';
$message = ($new_status == 'active') ? 'activated' : 'deactivated';

// Update status in DB
$update_stmt = $conn->prepare("UPDATE role_menu SET status = ? WHERE id = ?");
$update_stmt->bind_param("si", $new_status, $role_menu_id);
$result = $update_stmt->execute();

$update_stmt->close();
$conn->close();

if ($result) { 
    $_SESSION['success'] = "Role menu {$message} successfully.";
} else { 
    $_SESSION['error'] = "Something went wrong while updating status.";
}

header('Location: role_menu.php');
exit();
?>

        $stmt = $conn->prepare("UPDATE role_menu set status= ? where id=?"); 
        $stmt->bind_param("ii", $status, $role_menu_id); 
        $result=$stmt->execute(); 
        $stmt->close(); 
        $conn->close(); 

        if($result) { 
            $_SESSION['success']="Customer $message successfully.."; 
        } else { 
            $_SESSION['error']="Something went wrong."; 
        } 
        header('Location: role_menu.php'); 
    } else { 
        $_SESSION['error']="Something went wrong."; 
        header('Location: role_menu.php'); 
    } 
} else { 
    $_SESSION['error']="Something went wrong."; 
    header('Location: index.php'); 
} 
?>