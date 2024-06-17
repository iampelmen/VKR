<?php
session_start(); // Начало или восстановление сессии
session_unset(); // Удаление всех переменных сессии
session_destroy(); // Разрушение сессии

header('Location: index.php'); // Перенаправление на главную страницу
exit();
?>
