<?php
session_start();
include_once('connection.php');

// 🧩 Security Function
function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if (isset($_POST['save-role_menu'])) {

    $errors = [];

    // 📥 Input Variables
    $role_id = isset($_POST['role_id']) ? (int)$_POST['role_id'] : 0;
    $menu_name = test_input($_POST['menu_name']);
    $can_view = isset($_POST['can_view']) ? 1 : 0;
    $can_add = isset($_POST['can_add']) ? 1 : 0;
    $can_edit = isset($_POST['can_edit']) ? 1 : 0;
    $can_delete = isset($_POST['can_delete']) ? 1 : 0;
    $status = test_input($_POST['status']);
    $created_at = date('Y-m-d H:i:s');

    // 🧠 Validation
    if ($role_id <= 0) {
        $errors['role_id'] = "Please select a valid Role.";
    }
    if (empty($menu_name)) {
        $errors['menu_name'] = "Menu name is required.";
    }

    // ❌ If validation fails
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: add-role_menu.php');
        exit();
    }

    // ✅ Insert Query (Prepared Statement)
    $stmt = $conn->prepare("
        INSERT INTO role_menu 
        (role_id, menu_name, can_view, can_add, can_edit, can_delete, status, created_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param(
        "isiiiiss",
        $role_id,
        $menu_name,
        $can_view,
        $can_add,
        $can_edit,
        $can_delete,
        $status,
        $created_at
    );

    $result = $stmt->execute();

    if ($result) {
        $_SESSION['success'] = "✅ Role Menu added successfully.";
    } else {
        $_SESSION['error'] = "❌ Something went wrong. Please try again.";
    }

    $stmt->close();
    $conn->close();

    header('Location: role_menu.php');
    exit();

} else {
    header('Location: admin-dashboard.php');
    exit();
}
?>
