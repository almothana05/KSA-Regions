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
// معرض الصور - Image Slideshow
// =============================================

var currentSlide = 0;

function changeSlide(dir) {
    var slides = document.querySelectorAll('.slide');
    if (!slides.length) return;
    slides[currentSlide].classList.remove('active');
    var dots = document.querySelectorAll('.dot');
    if (dots[currentSlide]) dots[currentSlide].classList.remove('active');
    currentSlide = (currentSlide + dir + slides.length) % slides.length;
    slides[currentSlide].classList.add('active');
    if (dots[currentSlide]) dots[currentSlide].classList.add('active');
}

function goToSlide(index) {
    var slides = document.querySelectorAll('.slide');
    if (!slides.length) return;
    slides[currentSlide].classList.remove('active');
    var dots = document.querySelectorAll('.dot');
    if (dots[currentSlide]) dots[currentSlide].classList.remove('active');
    currentSlide = index;
    slides[currentSlide].classList.add('active');
    if (dots[currentSlide]) dots[currentSlide].classList.add('active');
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
