<?php
// Включаем отображение ошибок
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start(); // Начинаем сессию

// Параметры подключения к базе данных
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'kurs';

// Соединение с базой
$conn = new mysqli($host, $user, $password, $database);

// Проверка соединения
if ($conn->connect_error) {
    die("Ошибка подключения к БД: " . $conn->connect_error);
}

// Проверка введенных данных
if (isset($_POST['username'], $_POST['password'])) {
    // Экранирование ввода
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Подготовленный запрос
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username=?"); // Получаем также id пользователя
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['id']; // Сохраняем id пользователя
        $storedPassword = $row['password'];

        // Сравнение захешированных паролей
        if (password_verify($password, $storedPassword)) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user_id; // Устанавливаем переменную сессии user_id

            // Перенаправление на разные страницы
            if ($username === 'admin') {
                header("Location: admin.php");
                exit();
            } else {
                header("Location: laba5.php"); // Страница аккаунта изменена с laba5.php на account.php
                exit();
            }
        } else {
            echo "Неправильный пароль.";
        }
    } else {
        echo "Пользователь не найден.";
    }

    $stmt->close();
}
$conn->close();
?>