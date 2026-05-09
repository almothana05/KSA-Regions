<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

require_once '../db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$result = mysqli_query($conn, "SELECT * FROM regions WHERE id=$id");
$region = mysqli_fetch_assoc($result);

if (!$region) {
    header("Location: dashboard.php");
    exit();
}

$error = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name        = mysqli_real_escape_string($conn,$_POST['name']);
    $description = mysqli_real_escape_string($conn,$_POST['description']);
    $category    = mysqli_real_escape_string($conn,$_POST['category']);
    $image       = mysqli_real_escape_string($conn,$_POST['image']);
    $landmarks   = mysqli_real_escape_string($conn,$_POST['landmarks']);

    if ($name == '' || $description == '' || $category == '') {
        $error = 'يرجى تعبئة جميع الحقول المطلوبة.';
    } else {
        mysqli_query($conn, "UPDATE regions
                         SET name='$name', description='$description', category='$category',
                             image='$image', landmarks='$landmarks'
                         WHERE id=$id");
        header("Location: dashboard.php?msg=updated");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تعديل منطقة</title>
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
    <h2>تعديل: <?php echo $region['name']; ?></h2>

    <?php if ($error): ?>
        <div class="msg-error"><?php echo $error; ?></div>
    <?php endif; ?>

    <div class="form-box">
        <form method="POST" onsubmit="return validateForm()">

            <div class="form-group">
                <label>اسم المنطقة *</label>
                <input type="text" name="name" id="fname" value="<?php echo $region['name']; ?>">
            </div>

            <div class="form-group">
                <label>التصنيف *</label>
                <select name="category" id="fcategory">
                    <option value="">-- اختر التصنيف --</option>
                    <?php
                    $categories = ['وسط', 'غرب', 'شمال', 'جنوب', 'شرق'];
                    foreach ($categories as $cat) {
                        $selected = ($region['category'] == $cat) ? 'selected' : '';
                        echo "<option value='$cat' $selected>$cat</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>الوصف *</label>
                <textarea name="description" id="fdescription"><?php echo $region['description']; ?></textarea>
            </div>

            <div class="form-group">
                <label>مسارات الصور (مفصولة بفاصلة ,)</label>
                <textarea name="image" style="height:80px"><?php echo $region['image']; ?></textarea>
            </div>

            <div class="form-group">
                <label>المعالم (مفصولة بفاصلة عربية ،)</label>
                <textarea name="landmarks"><?php echo $region['landmarks']; ?></textarea>
            </div>

            <button type="submit" class="btn btn-submit">حفظ التعديلات</button>

        </form>
    </div>

</div>

<script src="scripts.js"></script>

</body>
</html>
