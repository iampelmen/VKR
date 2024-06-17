<?php 
session_start(); // Начать сессию
include 'db_connection.php'; // Подключиться к базе данных

// Проверка, что пользователь аутентифицирован
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Перенаправление на страницу входа
    exit();
}

$user_id = $_SESSION['user_id']; // ID текущего пользователя
// Получение данных пользователя
$query = "SELECT username, email, registration_date FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc(); // Данные найденного пользователя
} else {
    // Если пользователя нет - возможно, ошибка или незаконный доступ
    echo "Пользователь не найден.";
    exit();
}
$conn->close(); // Закрыть соединение с БД
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль пользователя - BasketFind</title>
    <link rel="stylesheet" href="styles.css"> <!-- Удостоверьтесь, что путь к файлу styles.css корректный -->
    <link rel="stylesheet" href="styles_account.css"> <!-- Удостоверьтесь, что путь к styles_account.css корректный -->
</head>
<body>
    <header>
    <h1>BasketFind</h1>
    <div class="nav-toggle" id="navToggle">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <!-- Кнопка гамбургер-меню конец -->
    <nav id="nav">
        <a href="laba5.php">Поиск площадок</a>
        <a href="about.php">О проекте</a>
        <a href="include.courts.php">Добавить площадку</a>
        <a href="account.php">Аккаунт</a>
    </nav>
    </header>

    <main class="main-container">
        <div class="account-container">
            <!-- Область аватара пользователя -->
            
            <!-- Информация аккаунта -->
            <div class="account-info">
                <h2><?php echo htmlspecialchars($user['username']); ?></h2>
                
            </div>
            
            <!-- Детали аккаунта -->
            <div class="account-details">
                <span><strong>Имя:</strong> <?php echo htmlspecialchars($user['username']); ?></span>
                <span><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></span>
                <!-- <span><strong>Дата регистрации:</strong> <?php echo htmlspecialchars($user['registration_date']); ?></span> -->
            </div>

            <!-- Кнопка для выхода -->
            <form action="logout.php" method="post">
                <button type="submit" class="logout-btn">Выйти</button>
            </form>
        </div>
    </main>

    <footer>
        &copy; 2024 BasketFind. Все права защищены.
    </footer>

    <!-- Подключение к JS для динамического поведения (если требуется) -->
    <script src="scripts.js"></script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
  var navToggle = document.getElementById('navToggle');
  var nav = document.getElementById('nav');

  navToggle.addEventListener('click', function() {
    navToggle.classList.toggle('active');
    nav.classList.toggle('active');
  });
});
</script>
</body>
</html>