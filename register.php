<?php
include 'connection.php';

$errors = array();

$first_name = trim($_POST['first_name']);
$last_name = trim($_POST['last_name']);
$email = $_POST['email'];
$password = $_POST['password'];
//$passwordConfirm = $_POST['passwordConfirm'];

//Validation
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
//else if ($password != $passwordConfirm)
//$errors['password'] = 'Password must match!';

if (empty($errors)) {
    //$response = array('success' => true);
    if ($conn) {

        $sql2 = "INSERT INTO users (name, email, password) VALUES ('$first_name','$email', '$password')";

        if (mysqli_query($conn, $sql2)) {
            $message = 'Data inserted successfully';
            $stade = true;
            $typeError = 'none';
        } else {
            $message = 'Error inserting data';
            $stade = false;
            $typeError = 'insert';
        }


        $response = array('success' => $stade, 'message' => $message, 'typeError' => $typeError);
    }



} else {
    // $errors['typeError'] = 'validation';
    $response = array('success' => false, $errors, 'typeError' => 'validation');
}



mysqli_close($conn);
echo json_encode($response);

?>