<?php
$my_server = "localhost";
$my_login_db = "admin";
$my_pass_db = "admin";
$my_db = "komiks_samochodowy";


$conn = new mysqli($my_server, $my_login_db, $my_pass_db, $my_db);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

