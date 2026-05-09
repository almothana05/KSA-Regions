<?php
// الاتصال بقاعدة البيانات PostgreSQL
$conn = pg_connect("host=localhost dbname=saudi_website user=almothana05");

if (!$conn) {
    die("فشل الاتصال بقاعدة البيانات.");
}
?>
