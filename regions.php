<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>معرض المناطق - اكتشف السعودية</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<nav>
    <a href="index.php">🏠 الرئيسية</a>
    <a href="regions.php">🗺️ المناطق</a>
    <button onclick="toggleDark(this)" id="darkBtn">🌙 الوضع الليلي</button>
</nav>

<header class="hero">
    <h1>معرض المناطق</h1>
    <p>اختر منطقة لتتعرف عليها</p>
</header>

<main>

    <!-- أزرار الفلترة -->
    <div class="filter-buttons">
        <button class="filter-btn active" onclick="filterRegions('الكل', this)">الكل</button>
        <button class="filter-btn" onclick="filterRegions('وسط', this)">وسط</button>
        <button class="filter-btn" onclick="filterRegions('غرب', this)">غرب</button>
        <button class="filter-btn" onclick="filterRegions('شمال', this)">شمال</button>
        <button class="filter-btn" onclick="filterRegions('جنوب', this)">جنوب</button>
        <button class="filter-btn" onclick="filterRegions('شرق', this)">شرق</button>
    </div>

    <!-- بطاقات المناطق - تأتي من قاعدة البيانات -->
    <div class="cards-grid">
        <?php
        $result = mysqli_query($conn, "SELECT * FROM regions ORDER BY id");
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="region-card" data-category="' . $row['category'] . '" onclick="window.location=\'details.php?id=' . $row['id'] . '\'">';
            echo '  <img src="' . $row['image'] . '" alt="' . $row['name'] . '">';
            echo '  <div class="card-info">';
            echo '    <h3>' . $row['name'] . '</h3>';
            echo '    <span class="category-badge">' . $row['category'] . '</span>';
            echo '  </div>';
            echo '</div>';
        }
        ?>
    </div>

</main>

<footer>
    <p>اكتشف السعودية &copy; 2025 - جميع الحقوق محفوظة</p>
</footer>

<script src="scripts.js"></script>
</body>
</html>
