// الوضع الليلي
function toggleDark(btn) {
    document.body.classList.toggle('dark');
    var isDark = document.body.classList.contains('dark');
    localStorage.setItem('darkMode', isDark);
    btn.textContent = isDark ? '☀️ الوضع النهاري' : '🌙 الوضع الليلي';
}

window.onload = function() {
    if (localStorage.getItem('darkMode') === 'true') {
        document.body.classList.add('dark');
        var btn = document.getElementById('darkBtn');
        if (btn) btn.textContent = '☀️ الوضع النهاري';
    }
}

function validateLogin() {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    if (username == '' || password == '') {
        alert('يرجى تعبئة جميع الحقول.');
        return false;
    }
    return true;
}


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


function confirmDelete() {
    return confirm('هل أنت متأكد من حذف هذا العنصر؟');
}
