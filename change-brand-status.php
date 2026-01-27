<?php 
session_start(); 
include_once('connection.php'); 

if(isset($_SESSION['auth_user'])) { 
    if(isset($_GET['id'])) { 
        $brand_id = $_GET['id']; 

        // ✅ Current brand fetch karo
        $stmt = $conn->prepare("SELECT * FROM brands WHERE id = ?");
        $stmt->bind_param("i", $brand_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0) { 
            $brand = $result->fetch_object();

            // ✅ Status toggle logic (active <-> inactive)
            $new_status = ($brand->status == 'active') ? 'inactive' : 'active';
            $message = ($new_status == 'active') ? 'activated' : 'deactivated';

            // ✅ Update query
            $stmt = $conn->prepare("UPDATE brands SET status = ? WHERE id = ?");
            $stmt->bind_param("si", $new_status, $brand_id);
            $update = $stmt->execute();

            $stmt->close();
            $conn->close();

            if($update) { 
                $_SESSION['success'] = "Brand $message successfully."; 
            } else { 
                $_SESSION['error'] = "Something went wrong while updating brand status."; 
            }

            header('Location: brand.php'); 
            exit();

        } else { 
            $_SESSION['error'] = "Brand not found."; 
            header('Location: brand.php'); 
            exit();
        }

    } else { 
        $_SESSION['error'] = "Invalid brand request."; 
        header('Location: brand.php'); 
        exit();
    }

} else { 
    $_SESSION['error'] = "Unauthorized access."; 
    header('Location: index.php'); 
    exit();
} 
?>
