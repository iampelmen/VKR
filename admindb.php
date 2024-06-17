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

if(isset($_POST['approve'])) {
    $court_id = $_POST['court_id'];
    $conn->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
    $approve_query = "INSERT INTO basketball_courts (court_name, address, phone, opening_hours, latitude, longitude, image_path)
                      SELECT court_name, address, phone, opening_hours, latitude, longitude, image_path FROM basketball_courts_temporary WHERE id = ?";
    $approve_stmt = $conn->prepare($approve_query);
    $approve_stmt->bind_param("i", $court_id);
    if ($approve_stmt->execute()) {
        $delete_query = "DELETE FROM basketball_courts_temporary WHERE id = ?";
        $delete_stmt = $conn->prepare($delete_query);
        $delete_stmt->bind_param("i", $court_id);
        if ($delete_stmt->execute()) {
            $conn->commit();
            $_SESSION['message'] = "Площадка успешно подтверждена и добавлена.";
        } else {
            $conn->rollback();
            $_SESSION['message'] = "Ошибка при удалении площадки из временной таблицы.";
        }
    } else {
        $conn->rollback();
        $_SESSION['message'] = "Ошибка при добавлении площадки в основную таблицу.";
    }
    header('Location: admin.php');
    exit;
}

if(isset($_POST['delete'])) {
    $court_id = $_POST['court_id'];
    $delete_query = "DELETE FROM basketball_courts_temporary WHERE id = ?";
    $delete_stmt = $conn->prepare($delete_query);
    $delete_stmt->bind_param("i", $court_id);
    if ($delete_stmt->execute()) {
        $_SESSION['message'] = "Площадка успешно удалена.";
    } else {
        $_SESSION['message'] = "Ошибка при удалении площадки.";
    }
    header('Location: admin.php');
    exit;
}

// Добавляем сюда логику обработки обновления данных о площадке
if (isset($_POST['update'])) {
    $court_id = $_POST['id'];
    $court_name = $_POST['court_name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $opening_hours = $_POST['opening_hours'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $update_query = "UPDATE basketball_courts_temporary SET court_name = ?, address = ?, phone = ?, opening_hours = ?, latitude = ?, longitude = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("ssssddi", $court_name, $address, $phone, $opening_hours, $latitude, $longitude, $court_id);
    
    if ($update_stmt->execute()) {
        $_SESSION['message'] = "Площадка успешно обновлена.";
    } else {
        $_SESSION['message'] = "Ошибка при обновлении.";
    }
    
    header('Location: admin.php');
    exit;
}

$conn->close();
?>