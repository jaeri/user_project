<?php
include 'connection.php';
$errors = array();

$idUser = trim($_GET['iduser']);
$first_name = trim($_POST['first_name']);
$last_name = trim($_POST['last_name']);
$email = $_POST['email'];
$password = $_POST['password'];


if (empty($last_name))
    $errors['last_name'] = 'Last name is mandatory !';

if (empty($first_name))
    $errors['first_name'] = 'first name is mandatory!';

if (empty($email))
    $errors['email'] = 'Email is mandatory!';
else if (strlen($email) < 8 or strlen($email) > 50)
    $errors['email'] = 'Email must be between 8 and 50 characters long.';

if (strlen($password) < 8)
    $errors['password'] = 'Password must be at least 8 characters long.';


if (empty($errors)) {
   
    if ($conn) {
        
        $sql = "UPDATE users SET name='$first_name', email='$email', password='$password' WHERE user_id=$idUser";

        if (mysqli_query($conn, $sql)) {
            $message = 'Data updated successfully';
            $stade = true;
            $typeError = 'none';
        } else {
            $message = 'Error updating data';
            $stade = false;
            $typeError = 'update';
        }


        $response = array('success' => $stade, 'message' => $message, 'typeError' => $typeError);
    }



} else {    
    $response = array('success' => false, $errors, 'typeError' => 'validation');
}



mysqli_close($conn);
echo json_encode($response);
?>