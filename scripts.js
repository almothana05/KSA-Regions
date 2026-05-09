// =============================================
// الوضع الليلي - Night Mode
// =============================================

function toggleDark(btn) {
    document.body.classList.toggle('dark');

    var isDark = document.body.classList.contains('dark');

    // حفظ الاختيار في المتصفح
    localStorage.setItem('darkMode', isDark);

    // تغيير نص الزر
    if (isDark) {
        btn.textContent = '☀️ الوضع النهاري';
    } else {
        btn.textContent = '🌙 الوضع الليلي';
    }
}

// تطبيق الوضع المحفوظ عند تحميل الصفحة
window.onload = function() {
    if (localStorage.getItem('darkMode') === 'true') {
        document.body.classList.add('dark');
        var btn = document.getElementById('darkBtn');
        if (btn) {
            btn.textContent = '☀️ الوضع النهاري';
        }
    }
}

// =============================================
// فلترة المناطق - Region Filtering
// =============================================

function filterRegions(category, btn) {
    // إظهار أو إخفاء البطاقات
    var cards = document.querySelectorAll('.region-card');
    cards.forEach(function(card) {
        if (category === 'الكل' || card.getAttribute('data-category') === category) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });

    // تحديث الزر النشط
    var buttons = document.querySelectorAll('.filter-btn');
    buttons.forEach(function(b) {
        b.classList.remove('active');
    });
    btn.classList.add('active');
}

// =============================================
// تأكيد الحذف - Delete Confirmation
// =============================================

function confirmDelete() {
    return confirm('هل أنت متأكد من حذف هذا العنصر؟');
}
