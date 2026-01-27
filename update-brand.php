<?php
session_start();
include_once('connection.php');

if(isset($_POST['update-brand'])) {

    $id = $_POST['id'];
    $brand_name = test_input($_POST['brand_name']);
    $brand_slug = test_input($_POST['brand_slug']);
    $brand_description = test_input($_POST['brand_description']);
    $status = test_input($_POST['status']);
    $updated_at = date('Y-m-d H:i:s');

    $errors = [];

    if(empty($brand_name)) {
        $errors['brand_name'] = "Brand name is required.";
    }

    // ✅ Handle Logo Upload (optional)
    $brand_logo = "";
    $logo_query = "";

    if(isset($_FILES['brand_logo']) && $_FILES['brand_logo']['error'] == 0) {
        $allowed_ext = array('jpg','jpeg','png','gif','webp');
        $file_name = $_FILES['brand_logo']['name'];
        $file_tmp = $_FILES['brand_logo']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if(in_array($file_ext, $allowed_ext)) {
            $new_file_name = time() . "_" . preg_replace("/[^a-zA-Z0-9._-]/", "", $file_name);
            $upload_dir = "uploads/brands/";

            if(!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            if(move_uploaded_file($file_tmp, $upload_dir . $new_file_name)) {
                $brand_logo = $new_file_name;
                $logo_query = ", brand_logo = '$brand_logo'";
            } else {
                $errors['brand_logo'] = "Failed to upload new logo.";
            }
        } else {
            $errors['brand_logo'] = "Invalid logo format.";
        }
    }

    if(count($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: edit-brand.php?id=$id");
        exit();
    }

    // ✅ Update record
    $query = "UPDATE brands SET 
                brand_name = '$brand_name', 
                brand_slug = '$brand_slug',
                brand_description = '$brand_description',
                status = '$status',
                updated_at = '$updated_at'
                $logo_query
              WHERE id = $id";

    if($conn->query($query)) {
        $_SESSION['success'] = "Brand updated successfully.";
        header('Location: brand.php');
    } else {
        $_SESSION['error'] = "Something went wrong while updating the brand.";
        header("Location: edit-brand.php?id=$id");
    }

    $conn->close();
} else {
    header('Location: brand.php');
}

// ✅ Sanitize Input
function test_input($data) { 
    $data = trim($data); 
    $data = stripslashes($data); 
    $data = htmlspecialchars($data); 
    return $data; 
}
?>
