<?php
session_start();


if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

require_once '../db.php';

$error = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name        = pg_escape_string($conn,$_POST['name']);
    $description = pg_escape_string($conn,$_POST['description']);
    $category    = pg_escape_string($conn,$_POST['category']);
    $image       = pg_escape_string($conn,$_POST['image']);
    $landmarks   = pg_escape_string($conn,$_POST['landmarks']);

    if ($name == '' || $description == '' || $category == '') {
        $error = 'يرجى تعبئة جميع الحقول المطلوبة.';
    } else {
        pg_query($conn, "INSERT INTO regions (name, description, category, image, landmarks)
                         VALUES ('$name', '$description', '$category', '$image', '$landmarks')");
        header("Location: dashboard.php?msg=added");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إضافة منطقة</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>

<nav>
    <a href="dashboard.php">🏠 لوحة التحكم</a>
    <a href="../index.php" target="_blank">🌐 الموقع</a>
    <button onclick="toggleDark(this)" id="darkBtn">🌙 الوضع الليلي</button>
    <a href="logout.php" class="btn btn-logout">تسجيل الخروج</a>
</nav>

<div class="admin-container">

    <a href="dashboard.php" class="back-link">→ العودة للوحة التحكم</a>
    <h2>إضافة منطقة جديدة</h2>

    <?php if ($error): ?>
        <div class="msg-error"><?php echo $error; ?></div>
    <?php endif; ?>

    <div class="form-box">
        <form method="POST" onsubmit="return validateForm()">

            <div class="form-group">
                <label>اسم المنطقة *</label>
                <input type="text" name="name" id="fname">
            </div>

            <div class="form-group">
                <label>التصنيف *</label>
                <select name="category" id="fcategory">
                    <option value="">-- اختر التصنيف --</option>
                    <option value="وسط">وسط</option>
                    <option value="غرب">غرب</option>
                    <option value="شمال">شمال</option>
                    <option value="جنوب">جنوب</option>
                    <option value="شرق">شرق</option>
                </select>
            </div>

            <div class="form-group">
                <label>الوصف *</label>
                <textarea name="description" id="fdescription"></textarea>
            </div>

            <div class="form-group">
                <label>مسارات الصور (مفصولة بفاصلة ,)</label>
                <textarea name="image" style="height:80px" placeholder="مثال: images/photo1.jpg,images/photo2.webp"></textarea>
            </div>

            <div class="form-group">
                <label>المعالم (مفصولة بفاصلة عربية ،)</label>
                <textarea name="landmarks" placeholder="مثال: برج المملكة، متحف الوطن، قصر الحكم"></textarea>
            </div>

            <button type="submit" class="btn btn-submit">إضافة</button>

        </form>
    </div>

</div>

<script src="scripts.js"></script>

</body>
</html>
