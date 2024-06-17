<?php
session_start(); // Начало сессии

$host = 'localhost';     // Хост
$user = 'root';          // Пользователь БД
$password = '';          // Пароль к БД
$database = 'kurs';      // Название БД

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];
    $email = $conn->real_escape_string($_POST['email']); // Получение значения email

    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        echo "Пользователь с таким именем уже существует!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Обновление запроса для включения email
        $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hashed_password, $email);
        
        if ($stmt->execute()) {
            // Установка сессионных переменных
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;

            echo "Регистрация прошла успешно.";
            header("Location: laba5.php"); // Перенаправление на страницу аккаунта
        } else {
            echo "Ошибка при регистрации: " . $conn->error;
        }
    }
    
    $stmt->close();
}
$conn->close();
?>