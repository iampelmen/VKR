<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kurs";

// Создание соединения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Начало сессии
session_start();

// Предполагается, что user_id хранится в сессии
$user_id = $_SESSION['user_id'];

// Проверка, чтобы убедиться, что user_id установлен
if (!isset($user_id)) {
    die("Ошибка: пользователь не авторизован.");
}

// Получение значений из формы
$court_name = $_POST['court_name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$opening_hours = $_POST['opening_hours'];

// Подготовка SQL-запроса с использованием подготовленных выражений для предотвращения SQL-инъекций
$stmt = $conn->prepare("INSERT INTO basketball_courts_temporary (court_name, address, phone, opening_hours, user_id) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssssi", $court_name, $address, $phone, $opening_hours, $user_id);

// Выполнение запроса
if ($stmt->execute() === TRUE) {
    $_SESSION['message'] = "Площадка успешно добавлена.";
    $stmt->close();
    $conn->close();
    header("Location: laba5.php");
    exit();
} else {
    $_SESSION['message'] = "Ошибка: " . $stmt->error;
    header("Location: laba5.php");
    exit();
}

$stmt->close();
$conn->close();
?>