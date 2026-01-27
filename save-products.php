<?php 
include_once('connection.php'); 
session_start(); 

function test_input($data) { 
    $data = trim($data); 
    $data = stripslashes($data); 
    $data = htmlspecialchars($data); 
    return $data; 
}

if(isset($_POST['save-products'])) { 
    $errors=array(); 
    $name=test_input($_POST['name']); 
    $category_id=test_input($_POST['category_id']); 
    $brand_id=test_input($_POST['brand_id']); 
    $unit_price=test_input($_POST['unit_price']); 
    $quantity=test_input($_POST['quantity']); 
    $discount=test_input($_POST['discount']); 
    $tax_rate=test_input($_POST['tax_rate']); 
    $status=test_input($_POST['status']); 
    $description=test_input($_POST['description']); 

   
   if(isset($_FILES['file_name']) && $_FILES['file_name']['error'] == 0) { 
        $file_name = $_FILES['file_name']['name']; 
        $file_tmp = $_FILES['file_name']['tmp_name']; 
        $file_path = 'uploads/' . $file_name; 
        if(move_uploaded_file($file_tmp, $file_path)) { 
            // file upload successful 
        } else { 
            // file upload failed 
            $errors['file'] = 'File upload failed'; 
        } 
    } else { 
 $errors['file'] = 'No file uploaded'; 
    } 


    if(count($errors)) { 
        $_SESSION['errors']=$errors; 
    } else { 
        date_default_timezone_set("UTC"); 
        $date=date("Y-m-d H:i:s"); 
        $stmt = $conn->prepare("INSERT INTO products(name,category_id,brand_id,unit_price,quantity,discount,tax_rate,status,description,file) VALUES(?,?,?,?,?,?,?,?,?,?)"); 
       $stmt->bind_param("siiiisssss", $name, $category_id,$brand_id,$unit_price,$quantity,$discount, $tax_rate,$status,$description,$file_path);

        $result=$stmt->execute(); 
        $stmt->close(); 
        $conn->close(); 

        if($result) { 
            $_SESSION['success']="Product added successfully."; 
            header("Location: products.php"); 
            exit; 
        } else { 
            $_SESSION['error']="Something went wrong."; 
            header("Location: add-products.php"); 
            exit; 
        } 
    } 
} 
?>

