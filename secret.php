<?php require_once 'db.php'; ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>الفريق</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .team-grid {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
            margin-top: 2rem;
        }

        .team-card {
            text-align: center;
        }

        .team-card img {
            width: 220px;
            height: 220px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #006c35;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .team-card p {
            margin-top: 0.8rem;
            font-size: 1.1rem;
            font-weight: 600;
            color: #006c35;
        }

        body.dark .team-card p {
            color: #4caf50;
        }

        body.dark .team-card img {
            border-color: #4caf50;
        }
    </style>
</head>
<body>

<nav>
    <a href="index.php">🏠 الرئيسية</a>
    <a href="regions.php">🗺️ المناطق</a>
    <a href="admin/login.php">🔐 المشرف</a>
    <button onclick="toggleDark(this)" id="darkBtn">🌙 الوضع الليلي</button>
</nav>

<main>
    <div class="team-grid">

        <div class="team-card">
            <img src="images/almothana.jpg" alt="المثنى الزهراني">
            <p>المثنى الزهراني</p>
        </div>

        <div class="team-card">
            <img src="images/mansour.jpg" alt="منصور الأحمري">
            <p>منصور الأحمري</p>
        </div>

        <div class="team-card">
            <img src="images/anas.jpg" alt="أنس الشمراني">
            <p>أنس الشمراني</p>
        </div>

    </div>
</main>

<footer>
    <p>اكتشف السعودية &copy; 2025 - المثنى الزهراني ومنصور الأحمري وأنس الشمراني</p>
</footer>

<script src="scripts.js"></script>
</body>
</html>
