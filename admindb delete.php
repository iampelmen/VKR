<?php
session_start();
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'kurs';
$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

if (isset($_POST['delete'])) {
    $court_id = $_POST['court_id'];
    $delete_query = "DELETE FROM basketball_courts WHERE id = ?";
    $delete_stmt = $conn->prepare($delete_query);
    $delete_stmt->bind_param("i", $court_id);
    if ($delete_stmt->execute()) {
        $_SESSION['message'] = "Площадка успешно удалена.";
    } else {
        $_SESSION['message'] = "Ошибка при удалении площадки.";
    }
} 

$conn->close();
header('Location: admin delete.php');
exit;
?>