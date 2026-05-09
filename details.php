<?php
include 'db.php';

// الحصول على رقم المنطقة من الرابط
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// جلب بيانات المنطقة من قاعدة البيانات
$result = mysqli_query($conn, "SELECT * FROM regions WHERE id = $id");
$region = mysqli_fetch_assoc($result);

// إذا لم توجد المنطقة، ارجع لصفحة المناطق
if (!$region) {
    header("Location: regions.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title><?php echo $region['name']; ?> - اكتشف السعودية</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<nav>
    <a href="index.php">🏠 الرئيسية</a>
    <a href="regions.php">🗺️ المناطق</a>
    <button onclick="toggleDark(this)" id="darkBtn">🌙 الوضع الليلي</button>
</nav>

<main>

    <a href="regions.php" class="back-link">→ العودة إلى المناطق</a>

    <div class="details-container">

        <img src="<?php echo $region['image']; ?>" alt="<?php echo $region['name']; ?>">

        <h1><?php echo $region['name']; ?></h1>
        <span class="badge">📍 <?php echo $region['category']; ?></span>

        <h2>نبذة عن المنطقة</h2>
        <p><?php echo $region['description']; ?></p>

        <h2>أبرز المعالم</h2>
        <ul class="landmarks-list">
            <?php
            // تقسيم المعالم على الفاصلة العربية
            $landmarks = explode('،', $region['landmarks']);
            foreach ($landmarks as $lm) {
                echo '<li>' . trim($lm) . '</li>';
            }
            ?>
        </ul>

    </div>

</main>

<footer>
    <p>اكتشف السعودية &copy; 2025 - جميع الحقوق محفوظة</p>
</footer>

<script src="scripts.js"></script>
</body>
</html>
