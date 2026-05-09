<?php
session_start();

// حماية الصفحة
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include '../db.php';

$error = '';

// عند إرسال النموذج
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name        = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $category    = mysqli_real_escape_string($conn, $_POST['category']);
    $image       = mysqli_real_escape_string($conn, $_POST['image']);
    $landmarks   = mysqli_real_escape_string($conn, $_POST['landmarks']);

    if ($name == '' || $description == '' || $category == '') {
        $error = 'يرجى تعبئة جميع الحقول المطلوبة.';
    } else {
        mysqli_query($conn, "INSERT INTO regions (name, description, category, image, landmarks)
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
    <a href="logout.php" class="btn btn-logout" style="margin-right:auto;">تسجيل الخروج</a>
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
                <label>رابط الصورة</label>
                <input type="text" name="image" placeholder="https://...">
            </div>

            <div class="form-group">
                <label>المعالم (مفصولة بفاصلة عربية ،)</label>
                <textarea name="landmarks" placeholder="مثال: برج المملكة، متحف الوطن، قصر الحكم"></textarea>
            </div>

            <button type="submit" class="btn btn-submit">إضافة</button>

        </form>
    </div>

</div>

<script>
function validateForm() {
    var name        = document.getElementById('fname').value;
    var category    = document.getElementById('fcategory').value;
    var description = document.getElementById('fdescription').value;

    if (name == '' || category == '' || description == '') {
        alert('يرجى تعبئة جميع الحقول المطلوبة.');
        return false;
    }
    return true;
}
</script>

</body>
</html>
