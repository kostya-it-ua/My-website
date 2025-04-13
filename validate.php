<!-- filepath: d:\Arhiv\My-website\validate.php -->
<?php
// Встановіть свій пароль
$correct_password = 'WelcometoMatrix';

// Отримайте пароль із форми
$password = $_POST['password'] ?? '';

// Перевірка пароля
if ($password === $correct_password) {
    // Перенаправлення до log.json
    header('Location: log.json');
    exit;
} else {
    // Неправильний пароль
    echo '<h1 style="color: red; text-align: center;">Неправильний пароль!</h1>';
    echo '<div style="text-align: center; margin-top: 20px;">';
    echo '<a href="login.html" style="color: #10b981; text-decoration: none; font-size: 18px;">Спробувати ще раз</a>';
    echo '</div>';
}
?>