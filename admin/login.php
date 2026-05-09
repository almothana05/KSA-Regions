<?php
session_start();

// إذا كان المشرف مسجلاً، انتقل مباشرة للوحة التحكم
if (isset($_SESSION['admin'])) {
    header("Location: dashboard.php");
    exit();
}

include '../db.php';

$error = '';

// عند إرسال النموذج
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']); // تشفير كلمة المرور

    $result = mysqli_query($conn, "SELECT * FROM admins WHERE username='$username' AND password='$password'");

    if (mysqli_num_rows($result) == 1) {
        // تسجيل دخول ناجح
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = 'اسم المستخدم أو كلمة المرور غير صحيحة.';
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل دخول المشرف</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body class="login-page">

<div class="login-box">
    <h2>🔐 تسجيل دخول المشرف</h2>

    <?php if ($error): ?>
        <div class="msg-error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" onsubmit="return validateLogin()">
        <div class="form-group">
            <label for="username">اسم المستخدم</label>
            <input type="text" id="username" name="username">
        </div>
        <div class="form-group">
            <label for="password">كلمة المرور</label>
            <input type="password" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-submit">دخول</button>
    </form>
</div>

<script>
function validateLogin() {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    if (username == '' || password == '') {
        alert('يرجى تعبئة جميع الحقول.');
        return false;
    }
    return true;
}
</script>

</body>
</html>
