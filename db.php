<?php
// الاتصال بقاعدة البيانات PostgreSQL
$host = "localhost";
$user = "almothana05";
$pass = "";
$db   = "saudi_website";

$conn = pg_connect("host=$host dbname=$db user=$user password=$pass");

if (!$conn) {
    die("Db connection failed");
}
?>
