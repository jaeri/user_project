<?php
include 'connection.php';

if ($conn) {
    $query = "SELECT * FROM spotify.users";

    $result = mysqli_query($conn, $query);

    mysqli_close($conn);
    echo json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));

}

?>