<?php 
include_once('connection.php'); 
session_start(); 
$first_name = $email = $mobile = $password = $confirm_password = "";
if(isset($_POST['save-customer'])) 
{

    $errors=array();
    $first_name=test_input($_POST['first_name']);
    $last_name=test_input($_POST['last_name']);
    $email=test_input($_POST['email']);
    $mobile=test_input($_POST['mobile']);
    $password=test_input($_POST['password']);
    $confirm_password=test_input($_POST['confirm_password']);
    $type="customer";
    $query="SELECT *from users where email='".$email."' OR mobile='".$mobile."';";
    $result=$conn->query($query);
    if(is_null($first_name))
     {
        $errors['first_name']='First name is required.';
    }
    if($result->num_rows>0) {
        if($result->fetch_object()->email == $email) {
            $errors['email']='Email already exists';
        }
         else {
            $errors['mobile']='Number already exists';
        }
    }

    if($password!=$confirm_password) {
        $errors['password']='Password and confirm password does not matched';
    }

    if(count($errors)) {
        $_SESSION['errors']=$errors;
        header('Location: add-customer.php');
    } 

    else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users(first_name,last_name,email,mobile,password,type) VALUES(?,?,?,?,?,?)");
        $stmt->bind_param("ssssss", $first_name, $last_name, $email,$mobile,$password,$type);
        $result=$stmt->execute();
        $stmt->close();
        $conn->close();
        if($result) {
            $_SESSION['success']="Customer Registered successfully.";
        } else {

            $_SESSION['error']="Something went wrong.";
        }

        header('Location: customers-list.php');
    }
} 

else {
    header('Location: admin-dashboard.php');
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

