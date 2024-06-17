<?php
$host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "kurs";

// Подключение к базе данных
$conn = mysqli_connect($host, $db_user, $db_password, $db_name);

// Проверка соединения
if (!$conn) {
    die("Ошибка подключения: " . mysqli_connect_error());
}
