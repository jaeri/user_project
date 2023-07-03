<?php
include 'connection.php';

$action = $_GET['action'];



if ($conn) {

    if ($action === "list") {
        $query = "SELECT * FROM spotify.blogs";
        $result = mysqli_query($conn, $query);

        $reponse = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    if ($action === "detail") {
        $id = $_GET['id'];
        $query = "SELECT * FROM spotify.blogs WHERE blog_id=$id";
        $result = mysqli_query($conn, $query);

        $reponse = mysqli_fetch_assoc($result);
    }

}


mysqli_close($conn);
echo json_encode($reponse);

?>