<?php
require_once 'db.php';


$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$result = pg_query($conn, "SELECT * FROM regions WHERE id = $id");
$region = pg_fetch_assoc($result);


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

        <?php
        $images = array_map('trim', explode(',', $region['image']));
        $hasMultiple = count($images) > 1;
        ?>
        <div class="slideshow">
            <?php foreach ($images as $i => $img): ?>
                <img src="<?php echo $img; ?>" alt="<?php echo $region['name']; ?>" class="slide<?php echo $i === 0 ? ' active' : ''; ?>">
            <?php endforeach; ?>
            <?php if ($hasMultiple): ?>
                <button class="slide-btn slide-prev" onclick="changeSlide(-1)">&#10094;</button>
                <button class="slide-btn slide-next" onclick="changeSlide(1)">&#10095;</button>
                <div class="slide-dots">
                    <?php for ($i = 0; $i < count($images); $i++): ?>
                        <span class="dot<?php echo $i === 0 ? ' active' : ''; ?>" onclick="goToSlide(<?php echo $i; ?>)"></span>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
        </div>

        <h1><?php echo $region['name']; ?></h1>
        <span class="badge">📍 <?php echo $region['category']; ?></span>

        <h2>نبذة عن المنطقة</h2>
        <p><?php echo $region['description']; ?></p>

        <h2>أبرز المعالم</h2>
        <ul class="landmarks-list">
            <?php
            // Landmarks are saved with Arabic commas.
            $landmarks = explode('،', $region['landmarks']);
            foreach ($landmarks as $lm) {
                echo '<li>' . trim($lm) . '</li>';
            }
            ?>
        </ul>

    </div>

</main>

<footer>
    <p>اكتشف السعودية &copy; 2025 - المثنى الزهراني ومنصور الأحمري وأنس الشمراني</p>
</footer>

<script src="scripts.js"></script>
</body>
</html>
