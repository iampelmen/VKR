<?php
// Стартуем сессию для вывода сообщений пользователю
session_start();

// Параметры подключения к базе данных
$host = 'localhost';
$user = 'root';
$password = ''; // Обновите данные со своим реальным паролем, если он есть
$database = 'kurs';

// Создаем подключение к базе данных
$conn = new mysqli($host, $user, $password, $database);

// Проверяем подключение
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Убедитесь, что каталог 'uploads/' существует на сервере
$uploadDir = 'uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Получаем ID площадки из запроса
$court_id = isset($_GET['id']) ? $_GET['id'] : null;

// Обработка формы редактирования
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $court_id = $_POST['id'];
    $court_name = $_POST['court_name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $opening_hours = $_POST['opening_hours'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Путь к изображению по умолчанию будет предыдущим значением, если загрузка нового файла не будет выполнена успешно
    $imagePath = $court['image_path'];

    // Обработка файла, если он есть
    if (isset($_FILES['image_path']) && $_FILES['image_path']['error'] === UPLOAD_ERR_OK) {
        $tempName = $_FILES['image_path']['tmp_name'];
        $fileInfo = pathinfo($_FILES['image_path']['name']);
        $fileExt = $fileInfo['extension'];
        $fileName = md5(time() . rand()) . '.' . $fileExt;
        $targetFilePath = $uploadDir . $fileName;
        
        if (move_uploaded_file($tempName, $targetFilePath)) {
            $imagePath = $targetFilePath; // Обновите это значение, чтобы хранить только имя файла, если требуется
        } else {
            $_SESSION['message'] = "Произошла ошибка при загрузке файла.";
            header('Location: edit_court_page.php?id=' . $court_id);
            exit;
        }
    }

    // Подготавливаем и выполняем SQL запрос к базе данных
    $stmt = $conn->prepare("UPDATE basketball_courts_temporary SET court_name=?, address=?, phone=?, opening_hours=?, latitude=?, longitude=?, image_path=? WHERE id=?");
    $stmt->bind_param("sssssssi", $court_name, $address, $phone, $opening_hours, $latitude, $longitude, $imagePath, $court_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Площадка успешно обновлена.";
        header('Location: admin.php');
        exit;
    } else {
        $_SESSION['message'] = "Ошибка при обновлении записи: " . $stmt->error;
        header('Location: edit_court_page.php?id=' . $court_id);
        exit;
    }

    $stmt->close();
}

// Получаем данные площадки для редактирования, если ID задан
if($court_id) {
    $query = $conn->prepare("SELECT * FROM basketball_courts_temporary WHERE id = ?");
    $query->bind_param("i", $court_id);
    $query->execute();
    $result = $query->get_result();
    $court = $result->fetch_assoc();
}

// Не закрываем подключение, если нам понадобится информация о площадке для формы ниже
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
        <h1 class="logo">Страница редактирования</h1>
        <div class="nav-links">
            <ul>
                <li class="nav-link"><a class="custom-button" href="admin.php">Назад</a></li>
            </ul>
        </div>
    </header>

    <!-- Проверяем, загружены ли данные для редактирования -->
    <?php if ($court_id && $court): ?>
        <h1>Редактирование площадки "<?php echo htmlspecialchars($court['court_name']); ?>"</h1>
        <!-- Форма редактирования -->
        <!-- (Добавлено пропущенное поле 'action' с PHP_SELF для отправки данных на тот же скрипт) -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?php echo htmlspecialchars($court['id']); ?>" enctype="multipart/form-data">
            <!-- Остальные поля формы -->
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($court['id']); ?>">

            <!-- Поля для редактирования данных -->
            <label for="court_name">Название:</label>
            <input type="text" id="court_name" name="court_name" value="<?php echo $court['court_name']; ?>" required>

            <label for="address">Адрес:</label>
            <input type="text" id="address" name="address" value="<?php echo $court['address']; ?>" required>
            <br>
            <label for="phone">Телефон:</label>
            <input type="text" id="phone" name="phone" value="<?php echo $court['phone']; ?>" required>
            <br>
            <label for="opening_hours">Часы работы:</label>
            <input type="text" id="opening_hours" name="opening_hours" value="<?php echo $court['opening_hours']; ?>" required>
            <br>
            <label for="latitude">Широта:</label>
            <input type="text" id="latitude" name="latitude" value="<?php echo $court['latitude']; ?>" required>
            <br>
            <label for="longitude">Долгота:</label>
            <input type="text" id="longitude" name="longitude" value="<?php echo $court['longitude']; ?>" required>


            <label for="image_path">Фотография:</label>
            <input type="file" id="image_path" name="image_path" accept="image/*">
            <br>
            <!-- Кнопка для сохранения изменений -->
            <button class="custom-button" type="submit" name="update">Сохранить изменения</button>
        </form>
    <?php else: ?>
        <p>Площадка для редактирования не найдена.</p>
    <?php endif; ?>
    <?php
    // Теперь мы можем закрыть подключение
    $conn->close();
    ?>
</body>
</html>