<?php 
session_start(); 
include_once('connection.php'); 

if (!isset($_SESSION['auth_user'])) { 
    header('Location: index.php'); 
    exit();
}

// Check if ID is passed and valid
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['error'] = "Invalid Role Menu ID!";
    header('Location: role_menu.php');
    exit();
}

$role_menu_id = intval($_GET['id']);

// Check if record exists before deleting
$check_stmt = $conn->prepare("SELECT id FROM role_menu WHERE id = ?");
$check_stmt->bind_param("i", $role_menu_id);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows === 0) {
    $_SESSION['error'] = "Role menu not found!";
    header('Location: role_menu.php');
    exit();
}
$check_stmt->close();

// Now delete
$stmt = $conn->prepare("DELETE FROM role_menu WHERE id = ?");
$stmt->bind_param("i", $role_menu_id);
$result = $stmt->execute();
$stmt->close();
$conn->close();

// Set message based on result
if ($result) { 
    $_SESSION['success'] = "Role menu deleted successfully.";
} else { 
    $_SESSION['error'] = "Something went wrong while deleting.";
}

header('Location: role_menu.php');
exit();
?>
