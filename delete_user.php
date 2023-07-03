<?php
include 'connection.php';

$userid = $_GET['id'];

$sql = "DELETE FROM users WHERE user_id =".$userid;

if (mysqli_query($conn, $sql)) {
    $response = array('success' => true);
}else{
    $response = array('success' => false);
}

echo json_encode($response);
?>