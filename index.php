<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BasketFind</title>
    <link rel="stylesheet" href="styles_main.css">
</head>
<body>
    <!-- Шапка страницы с логотипом и главной навигацией -->
    <header>
        <div class="logo" onclick="window.location.href='/'">BasketFind</div>
        <div class="auth-buttons">
  <button onclick="window.location.href='login.php';" class="login-button">Войти</button>
  <button onclick="window.location.href='register.php';" class="register-button">Регистрация</button>
</div>
    </header>

    <!-- Основное содержимое страницы с акцентом на поиск площадок -->
    <main>
        <!-- Секция "О сайте" с базовой информацией и призывом к действию -->
        <section id="about">
  <h1>Присоединяйтесь к поискам баскетбольных площадок в Ростове-на-Дону</h1>
  <p>Легко находите и добавляйте любимые баскетбольные площадки с BasketFind.</p>

</section>
        
        <!-- Краткий обзор основного функционала сайта -->
        <section id="features">
            <h2>Основные возможности</h2>
            <ul class="features-list">
                <li>Интерактивный поиск площадок на карте вашего города</li>
                <li>Подробная информация о каждой площадке</li>
                <li>Удобное добавление новых площадок в базу данных сайта</li>
            </ul>
        </section>
        
        <!-- Примеры площадок с фотографиями и основной информацией -->
        <section class="featured-courts">
  <h2>Избранные площадки</h2>
  <div class="courts-container">
    <!-- Карточка площадки 1 -->
    <article class="court">
      <img src="iam.jpg" alt="Площадка у парка">
      <h3>Гребной канал</h3>
      <p>Идеальное место для игры и тренировок на свежем воздухе.</p>
    </article>
    <!-- Карточка площадки 2 -->
    <article class="court">
      <img src="aksai.jpg" alt="Площадка у парка">
      <h3>Аксай</h3>
      <p>Хорошее место для игры рядом с большим жилым массивом.</p>
    </article>
    <!-- Карточка площадки 3 -->
    <article class="court">
      <img src="северный.jpg" alt="Площадка у парка">
      <h3>Северный</h3>
      <p>Удобно располодженная площадка для любителей баскетбола.</p>
    </article>
    <!-- Место для дополнительных карточек площадок -->
  </div>
</section>

        <!-- Призыв к действию для добавления новой площадки -->
        <section id="call-to-action">
            <h2>Не нашли вашу любимую площадку?</h2>
            <p>Добавьте площадку в нашу базу, чтобы другие игроки могли её найти!</p>
            <button onclick="window.location.href='register.php';" class="add-court-button">Добавить площадку</button>
        </section>
    </main>

    <!-- Подвал страницы с копирайтом -->
    <footer>
        <p>© 2024 Basketball Courts Finder. Все права защищены.</p>
    </footer>
</body>
</html>