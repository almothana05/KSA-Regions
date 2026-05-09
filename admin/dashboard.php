<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

require_once '../db.php';


if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    pg_query($conn, "DELETE FROM regions WHERE id=$id");
    header("Location: dashboard.php?msg=deleted");
    exit();
}

$result = pg_query($conn, "SELECT * FROM regions ORDER BY id");
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم</title>
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

    <h1>لوحة التحكم</h1>
    <p>مرحباً، <strong><?php echo $_SESSION['admin']; ?></strong></p>
    <br>

    
    <?php if (isset($_GET['msg'])): ?>
        <?php if ($_GET['msg'] == 'added'): ?>
            <div class="msg-success">✅ تم إضافة المنطقة بنجاح.</div>
        <?php elseif ($_GET['msg'] == 'updated'): ?>
            <div class="msg-success">✅ تم تحديث المنطقة بنجاح.</div>
        <?php elseif ($_GET['msg'] == 'deleted'): ?>
            <div class="msg-success">✅ تم حذف المنطقة بنجاح.</div>
        <?php endif; ?>
    <?php endif; ?>

    <a href="add.php" class="btn btn-add">+ إضافة منطقة جديدة</a>

    <table class="admin-table">
        <thead>
            <tr>
                <th>#</th>
                <th>الاسم</th>
                <th>التصنيف</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = pg_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['category']; ?></td>
                <td>
                    <a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-edit">تعديل</a>
                    <a href="dashboard.php?delete=<?php echo $row['id']; ?>"
                       class="btn btn-delete"
                       onclick="return confirmDelete()">حذف</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</div>

<script src="../scripts.js"></script>
</body>
</html>
