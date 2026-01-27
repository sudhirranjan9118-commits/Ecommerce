<?php
session_start();
include_once('connection.php');

// Check if form is submitted
if (isset($_POST['save-role'])) {

    // Get and sanitize inputs
    $name     = trim($_POST['name'] ?? '');
    $icon     = trim($_POST['icon'] ?? '');
    $position = trim($_POST['position'] ?? '');

    // Validate inputs
    if ($name === '' || $icon === '' || $position === '') {
        $_SESSION['error'] = "All fields are required";
        header("Location: add-role.php");
        exit;
    }

    // Ensure position is a valid integer
    if (!ctype_digit($position)) {
        $_SESSION['error'] = "Position must be a valid number";
        header("Location: add-role.php");
        exit;
    }

    $position = (int)$position;

    // Prepare and execute statement
    $stmt = $conn->prepare("INSERT INTO roles (name, icon, position) VALUES (?, ?, ?)");
    if ($stmt === false) {
        $_SESSION['error'] = "Database error: " . $conn->error;
        header("Location: add-role.php");
        exit;
    }

    $stmt->bind_param("ssi", $name, $icon, $position);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Role added successfully!";
        header("Location: roles.php");
        exit;
    } else {
        $_SESSION['error'] = "Failed to add role: " . $stmt->error;
        header("Location: add-role.php");
        exit;
    }

    $stmt->close();
    $conn->close();
}
