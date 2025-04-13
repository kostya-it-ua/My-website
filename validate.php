<!-- filepath: d:\Arhiv\My-website\validate.php -->
<?php
// Встановіть свій пароль
$correct_password = 'Matrix';

// Отримайте пароль із форми
$password = $_POST['password'] ?? '';

// Логування отриманого пароля
error_log("Отриманий пароль: $password");

// Перевірка пароля
if ($password === $correct_password) {
    // Завантаження вмісту log.json
    $log_file = 'log.json';
    if (file_exists($log_file)) {
        $logs = json_decode(file_get_contents($log_file), true);
        if (json_last_error() === JSON_ERROR_NONE) {
            echo '<h1 style="text-align: center; color: #10b981;">Логи відвідувачів</h1>';
            echo '<table border="1" style="width: 100%; border-collapse: collapse; text-align: left;">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>URL</th>';
            echo '<th>Реферер</th>';
            echo '<th>Роздільна здатність</th>';
            echo '<th>Мова</th>';
            echo '<th>Агент користувача</th>';
            echo '<th>Час</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            foreach ($logs as $entry) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($entry['url']) . '</td>';
                echo '<td>' . htmlspecialchars($entry['referer'] ?? 'Немає') . '</td>';
                echo '<td>' . htmlspecialchars($entry['screen']['width'] . 'x' . $entry['screen']['height']) . '</td>';
                echo '<td>' . htmlspecialchars($entry['language']) . '</td>';
                echo '<td>' . htmlspecialchars($entry['user_agent']) . '</td>';
                echo '<td>' . htmlspecialchars($entry['timestamp']) . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<h1 style="color: red; text-align: center;">Помилка читання лог-файлу!</h1>';
        }
    } else {
        echo '<h1 style="color: red; text-align: center;">Лог-файл не знайдено!</h1>';
    }
} else {
    // Неправильний пароль
    echo '<h1 style="color: red; text-align: center;">Неправильний пароль!</h1>';
    echo '<div style="text-align: center; margin-top: 20px;">';
    echo '<a href="login.html" style="color: #10b981; text-decoration: none; font-size: 18px;">Спробувати ще раз</a>';
    echo '</div>';
}
?>