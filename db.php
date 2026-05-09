<?php
$host = "sql208.infinityfree.com";
$user = "if0_41047520";
$pass = "6II7KywUJwBy";
$db   = "saudi_website";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Db connection failed");
}

mysqli_set_charset($conn, "utf8mb4");
?>
