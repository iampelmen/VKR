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

function uploadPhoto($file) {
    $uploadDir = 'uploads/';
    $fileName = time() . '_' . basename($file['name']);
    $uploadFile = $uploadDir . $fileName;

    if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
        return $fileName;
    } else {
        return null;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $court_id = $_POST['court_id'];
    $court_name = $_POST['court_name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $opening_hours = $_POST['opening_hours'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $imagePath = isset($_FILES['court_photo']) ? uploadPhoto($_FILES['court_photo']) : null;
    
    $update_query = "UPDATE basketball_courts SET court_name=?, address=?, phone=?, opening_hours=?, latitude=?, longitude=?".($imagePath ? ", image_path=?" : "")." WHERE id=?";
    $update_stmt = $conn->prepare($update_query);
    
    if ($imagePath) {
        $update_stmt->bind_param("ssssddsi", $court_name, $address, $phone, $opening_hours, $latitude, $longitude, $imagePath, $court_id);
    } else {
        $update_stmt->bind_param("ssssddi", $court_name, $address, $phone, $opening_hours, $latitude, $longitude, $court_id);
    }
    
    if ($update_stmt->execute()) {
        $_SESSION['message'] = "Площадка успешно обновлена.";
    } else {
        $_SESSION['message'] = "Ошибка при обновлении.";
    }
    $conn->close();
    header('Location: admin delete.php'); // Предполагаем, что у админа есть admin_panel.php
    exit;
}

if (isset($_GET['id'])) {
    $court_id = $_GET['id'];
    $select_query = "SELECT * FROM basketball_courts WHERE id = ?";
    $select_stmt = $conn->prepare($select_query);
    $select_stmt->bind_param("i", $court_id);
    $select_stmt->execute();
    $result = $select_stmt->get_result();
    if ($result->num_rows == 1) {
        $court = $result->fetch_assoc();
    } else {
        $_SESSION['message'] = "Площадка не найдена.";
        $conn->close();
        header('Location: admin delete.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Редактирование площадки</title>
    <style>
        /* Основные стили */
body, html {
  margin: 0;
  padding: 0;
  font-family: 'Arial', sans-serif;
  background-color: #f8f8f8;
}

header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0.5rem 2rem;
  background: linear-gradient(135deg, #1a1a1d 0%, #c3073f 100%);
  color: white;
}

.header-title {
  font-size: 1.5em;
  margin: 0;
}

.nav-links ul {
  list-style: none;
  display: flex;
  margin: 0;
  padding: 0;
}

.nav-link {
  margin-left: 1rem;
}

.nav-link:first-child {
  margin-left: 0;
}

@media screen and (max-width: 768px) {
  header {
    flex-direction: column;
    padding: 1rem;
  }

  .header-title {
    margin-bottom: 1rem;
  }

  .nav-links ul {
    flex-direction: column;
    width: 100%;
  }

  .nav-link {
    margin-left: 0;
    margin-bottom: 0.5rem;
  }

  .nav-link:last-child {
    margin-bottom: 0;
  }
}

.custom-button {
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  font-size: 1em;
  cursor: pointer;
  outline: none;
  color: white;
  background-color: #c3073f;
  text-transform: uppercase;
  transition: background-color 0.3s ease;
  text-align: center;
  display: inline-block;
  text-decoration: none;
  margin-left: 1.5rem;
}

.custom-button:hover, .nav-link a:hover {
  background-color: #ff5768;
  transform: translateY(-2px);
}

/* Форма редактиования */
form {
  margin: 2rem auto;
  padding: 2rem;
  background: white;
  border-radius: 5px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
  max-width: 600px;
  display: flex;
  flex-direction: column;
}

form label {
  margin-bottom: 0.5rem;
  font-weight: bold;
}

form input[type="text"], form input[type="file"], form input[type="submit"] {
  padding: 0.5rem;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-bottom: 1rem;
  font-size: 1em;
  width: 100%;
}

form input[type="submit"], form button {
  background-color: #c3073f;
  color: white;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

form input[type="submit"]:hover, form button:hover {
  background-color: #ff5768;
}

/* Сообщения */
.message {
  padding: 10px;
  color: #ffffff;
  background-color: #4CAF50;
  margin-bottom: 15px;
  text-align: center;
}

@media screen and (max-width: 768px) {
  form {
    padding: 1rem;
    margin: 1rem;
  }

  form input[type="text"], form input[type="file"], form input[type="submit"] {
    margin-bottom: 0.8rem;
  }
}

footer {
  background: #1a1a1d;
  color: white;
  text-align: center;
  padding: 0.8rem;
  margin-top: auto;
}
    </style>
</head>
<body>
<header>
        <h1 class="header-title">Редактирование площадки</h1>
        <div class="nav-links">
            <ul>
                <li class="nav-link"><a class="custom-button" href="admin delete.php">Назад</a></li>
            </ul>
        </div>
    </header>
<?php if (isset($court)): ?>

<form method="post" action="edit_court_main.php" enctype="multipart/form-data">
    
    <input type="hidden" name="court_id" value="<?php echo $court['id']; ?>">
    <label for="court_name">Название:</label>
    <input type="text" name="court_name" value="<?php echo $court['court_name']; ?>">
    <label for="address">Адрес:</label>
    <input type="text" name="address" value="<?php echo $court['address']; ?>">
    <label for="phone">Телефон:</label>
    <input type="text" name="phone" value="<?php echo $court['phone']; ?>">
    <label for="opening_hours">Часы работы:</label>
    <input type="text" name="opening_hours" value="<?php echo $court['opening_hours']; ?>">
    <label for="latitude">Широта:</label>
    <input type="text" name="latitude" value="<?php echo $court['latitude']; ?>">
    <label for="longitude">Долгота:</label>
    <input type="text" name="longitude" value="<?php echo $court['longitude']; ?>">
    <label for="court_photo">Фотография:</label>
    <input type="file" name="court_photo">

    <input type="submit" name="update" value="Сохранить изменения">
</form>

<?php endif; ?>
</body>
</html>