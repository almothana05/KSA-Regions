<?php
session_start();
session_destroy(); // حذف جلسة المشرف
header("Location: login.php");
exit();
?>
