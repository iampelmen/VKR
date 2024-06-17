<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>О проекте - BasketPlay</title>
  <link rel="stylesheet" href="styles_about.css">
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

  <main class="about-main-content">
    <section class="introduction-section">
      <div class="introduction-banner">
        <h2>Добро пожаловать в мир ForteBasket!</h2>
        <p>Откройте для себя лучшие площадки для баскетбола в Ростове-на-Дону с BasketPlay.</p>
      </div>
    </section>

    <section class="features-section">
      <div class="feature">
        <img src="сообщество.png" alt="Сообщество игроков" class="feature-img">
        <h3>Сообщество игроков</h3>
        <p>Присоединяйтесь к активному сообществу любителей баскетбола. Вместе тренируемся, играем и развиваемся.</p>
      </div>
      <div class="feature">
        <img src="мероприятие.png" alt="Баскетбольные мероприятия" class="feature-img">
        <h3>Мероприятия</h3>
        <p>Участвуйте в соревнованиях всех уровней, от дружеских встреч до крупных турниров.</p>
      </div>
      <div class="feature">
        <img src="карта.png" alt="Интерактивная карта" class="feature-img">
        <h3>Интерактивная карта площадок</h3>
        <p>Легко находите лучшие площадки рядом с вами благодаря нашему удобному поиску и интерактивной карте.</p>
      </div>
    </section>

    <section class="mission-section">
      <h2>Наша миссия и ценности</h2>
      <p>
        Мы стремимся сделать баскетбол доступным для каждого, вне зависимости от возраста и уровня навыков. Наша миссия - вдохновить людей на занятия спортом и укрепление здоровья через игру в баскетбол.
      </p>
    </section>

    <section class="contact-section">
      <h2>Свяжитесь с нами</h2>
      <p>Есть идеи или вопросы? Мы всегда рады обратной связи! Напишите нам на email@example.com или позвоните по номеру +7 (999) 123-45-67.</p>
    </section>
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