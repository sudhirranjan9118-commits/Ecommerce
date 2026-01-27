<?php 
session_start(); 
include_once('connection.php'); 

function test_input($data) { 
    $data = trim($data); 
    $data = stripslashes($data); 
    $data = htmlspecialchars($data); 
    return $data; 
} 

if(isset($_POST['save-category'])) { 
    $errors = array(); 

    // 🟩 Input fields
    $name = test_input($_POST['name']); 
    $name_alias = test_input($_POST['name_alias']); 
    $parent_id = !empty($_POST['parent_id']) ? intval($_POST['parent_id']) : NULL; 
    $status = isset($_POST['status']) ? intval($_POST['status']) : 0; 
    $created_at = date('Y-m-d H:i:s'); 

    // 🟥 Validation
    if(empty($name)) { 
        $errors['name'] = 'Name is required.'; 
    }

    // Generate alias automatically if empty
    if(empty($name_alias)) { 
        $name_alias = strtolower(str_replace(' ', '-', $name));
    }

    // 🟩 Image upload (optional)
    $image = "";
    if(isset($_FILES["image"]) && $_FILES["image"]["name"] != "") {
        $image_name = $_FILES["image"]["name"];
        $extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        $allowed = ["jpg","jpeg","png","gif"];

        if(!in_array($extension, $allowed)) {
            $errors['image'] = 'Only JPG, JPEG, PNG, GIF files allowed.';
        } else {
            $directory = "uploads/categories";
            if(!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }

            $new_name = time() . "_" . preg_replace("/[^a-zA-Z0-9.]/", "_", $image_name);
            $target_file = $directory . "/" . $new_name;

            if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image = $target_file;
            } else {
                $errors['image'] = 'Failed to upload image.';
            }
        }
    }

    // 🟥 If any error
    if(count($errors)) { 
        $_SESSION['errors'] = $errors; 
        header('Location: add-category.php'); 
        exit();
    } 

    // 🟩 Insert query
    $stmt = $conn->prepare("INSERT INTO categories(name, name_alias, parent_id, image, status, created_at) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisis", $name, $name_alias, $parent_id, $image, $status, $created_at);
    $result = $stmt->execute();
    $stmt->close();
    $conn->close();

    if($result) { 
        $_SESSION['success'] = "Category added successfully."; 
    } else { 
        $_SESSION['error'] = "Something went wrong while saving category."; 
    } 

    header('Location: categories-list.php'); 
    exit();

} else { 
    header('Location: admin-dashboard.php'); 
    exit();
}
?>
