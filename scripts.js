// Dark mode

function toggleDark(btn) {
    document.body.classList.toggle('dark');

    var isDark = document.body.classList.contains('dark');

    localStorage.setItem('darkMode', isDark);

    if (isDark) {
        btn.textContent = '☀️ الوضع النهاري';
    } else {
        btn.textContent = '🌙 الوضع الليلي';
    }
}

// Use the saved dark mode setting when the page opens.
window.onload = function() {
    if (localStorage.getItem('darkMode') === 'true') {
        document.body.classList.add('dark');
        var btn = document.getElementById('darkBtn');
        if (btn) {
            btn.textContent = '☀️ الوضع النهاري';
        }
    }
}

// Image slideshow

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

// Region filtering

function filterRegions(category, btn) {
    var cards = document.querySelectorAll('.region-card');
    cards.forEach(function(card) {
        if (category === 'الكل' || card.getAttribute('data-category') === category) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });

    var buttons = document.querySelectorAll('.filter-btn');
    buttons.forEach(function(b) {
        b.classList.remove('active');
    });
    btn.classList.add('active');
}

// Delete confirmation

function confirmDelete() {
    return confirm('هل أنت متأكد من حذف هذا العنصر؟');
}
