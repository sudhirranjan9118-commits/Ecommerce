<?php 
include_once('connection.php'); 
session_start(); 

$brand_name = $brand_slug = $brand_description = $status = "";
if(isset($_POST['save-brand'])) { 
    
    $errors = array(); 
    $brand_name = test_input($_POST['brand_name']); 
    $brand_slug = test_input($_POST['brand_slug']); 
    $brand_description = test_input($_POST['brand_description']); 
   $status = "active";
    $created_at = date('Y-m-d H:i:s'); 

    // ✅ Validation
    if(empty($brand_name)) { 
        $errors['brand_name'] = "Brand name is required."; 
    }

    // ✅ Handle file upload (optional)
    $brand_logo = "";
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
            } else {
                $errors['brand_logo'] = "Failed to upload brand logo.";
            }
        } else {
            $errors['brand_logo'] = "Invalid file type. Only JPG, PNG, GIF, WEBP allowed.";
        }
    }

    // ✅ If any error, redirect back
    if(count($errors)) { 
        $_SESSION['errors'] = $errors; 
        header('Location: add-brand.php'); 
        exit();
    } 
    else { 
        // ✅ Insert query
        $stmt = $conn->prepare("INSERT INTO brands(brand_name, brand_slug, brand_logo, brand_description, status, created_at) VALUES(?,?,?,?,?,?)"); 
        $stmt->bind_param("ssssss", $brand_name, $brand_slug, $brand_logo, $brand_description, $status, $created_at); 
        $result = $stmt->execute(); 
        $stmt->close(); 
        $conn->close(); 

        // ✅ Redirect with message
        if($result) { 
            $_SESSION['success'] = "Brand added successfully."; 
            header('Location: brand.php'); 
        } else { 
            $_SESSION['error'] = "Something went wrong while saving the brand."; 
            header('Location: add-brand.php'); 
        } 
    } 
} else { 
    header('Location: admin-dashboard.php'); 
} 

// ✅ Data sanitization
function test_input($data) { 
    $data = trim($data); 
    $data = stripslashes($data); 
    $data = htmlspecialchars($data); 
    return $data; 
} 
?>
