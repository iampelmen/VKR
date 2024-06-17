<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление новой баскетбольной площадки - ForteBasket</title>
    <!-- <link rel="stylesheet" href="styles.css"> Общие стили сайта -->
    <link rel="stylesheet" href="add_court_styles.css"> <!-- Стили для данной формы -->
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

<!-- Основной контент страницы -->
<main>
<form action="add_court_to_db.php" method="post" class="form-courts">
    <label for="court_name">Название площадки:</label>
    <input type="text" id="court_name" name="court_name" required>
    
    <label for="address">Адрес:</label>
    <input type="text" id="address" name="address" required>
    
    <label for="phone">Номер телефона:</label>
    <input type="text" id="phone" name="phone" required>
    
    <label for="opening_hours">Часы работы:</label>
    <input type="text" id="opening_hours" name="opening_hours" required>
    
    <input type="submit" value="Добавить информацию">
</form>
</main>

<footer>
    &copy; 2024 BasketPlay. Все права защищены.
</footer>
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
