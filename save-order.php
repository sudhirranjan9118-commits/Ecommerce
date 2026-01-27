<?php 
session_start(); 
include_once('connection.php'); 
if(isset($_POST['add_order'])) { 
    $errors = array(); 
    $user_id = $_SESSION['auth_user']->id; 
    $product_name = test_input($_POST['product_name']); 
    $quantity = test_input($_POST['quantity']); 
    $price = test_input($_POST['price']); 
    $payment_status = test_input($_POST['payment_status']); 
    $payment_method = test_input($_POST['payment_method']); 
    $order_status = test_input($_POST['order_status']); 

    if(empty($product_name)) { 
        $errors['product_name'] = 'Product Name is required.'; 
    } 
    if(empty($quantity)) { 
        $errors['quantity'] = 'Quantity is required.'; 
    } 
    if(empty($price)) { 
        $errors['price'] = 'Price is required.'; 
    } 
    if(empty($payment_status)) { 
        $errors['payment_status'] = 'Payment Status is required.'; 
    } 
    if(empty($payment_method)) { 
        $errors['payment_method'] = 'Payment Method is required.'; 
    } 
    if(empty($order_status)) { 
        $errors['order_status'] = 'Order Status is required.'; 
    } 

    if(count($errors)) { 
        $_SESSION['errors'] = $errors; 
        header("Location: add-order.php"); 
    } else { 
        $payment_status_text = '';
        switch ($payment_status) {
            case 1:
            $payment_status_text = 'Paid';
            break;
            case 2:
            $payment_status_text = 'Awaiting Authorization';
            break;
            case 3:
            $payment_status_text = 'Payment failed';
            break;
            case 4:
            $payment_status_text = 'Cash On Delivery';
            break;
        }

        $order_status_text = '';
        switch ($order_status) {
            case 1:
            $order_status_text = 'Fulfilled';
            break;
            case 2:
            $order_status_text = 'Unfulfilled';
            break;
        }

        $stmt = $conn->prepare("INSERT INTO orders (user_id, product_name, quantity, price, payment_status, payment_method, order_status) VALUES (?, ?, ?, ?, ?, ?, ?)"); 
        $stmt->bind_param("isiiiss", $user_id, $product_name, $quantity, $price, $payment_status, $payment_method, $order_status); 
        if($stmt->execute()) { 
            $_SESSION['success'] = "Order added successfully. Payment Status: $payment_status_text, Order Status: $order_status_text"; 
        } else { 
            $_SESSION['error'] = "Something went wrong."; 
        } 
        header("Location: orders.php"); 
    } 
} else { 
    header("Location: index.php"); 
} 

function test_input($data) { 
    $data = trim($data); 
    $data = stripslashes($data); 
    $data = htmlspecialchars($data); 
    return $data; 
} 
?>