<?php
// Добавляем сессию в начало файла
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <img src="лого.png" alt="Логотип" class="header-logo"> -->
    <title>BasketPlay - Найди свою площадку для баскетбола</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://api-maps.yandex.ru/2.1/?apikey=0cc3cb6b-6355-47c5-9042-cdb3f2e98d5a&lang=ru_RU" type="text/javascript"></script>
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
<?php if (isset($_SESSION['message'])): ?>
    <div class="message" id="message">
        <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>
    </div>
<?php endif; ?>
<main>
    <section class="search-section">
        <h2>Найдите лучшую баскетбольную площадку рядом с вами!</h2>
        <form method="GET">
            <input type="text" name="search" placeholder="Введите название или адрес..." value="<?php echo htmlspecialchars($_GET['search'] ?? '', ENT_QUOTES); ?>">
            <button type="submit">Найти</button>
        </form>
        <ul class="court-list">
            <?php
include 'db_connection.php';
// Инициализируем массив для данных о площадках
$courtsData = array();
if (!empty($_GET['search'])) {
    // Подготовка запроса в зависимости от наличия параметра поиска
    $search = $_GET['search'];
    $stmt = $conn->prepare("SELECT * FROM basketball_courts WHERE court_name LIKE ? OR address LIKE ?");
    $searchParam = "%$search%";
    $stmt->bind_param("ss", $searchParam, $searchParam);
    $stmt->execute();
    $courtsData = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
} else {
    $stmt = $conn->prepare("SELECT * FROM basketball_courts");
    $stmt->execute();
    $courtsData = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
$conn->close();

// Генерируем список площадок
foreach ($courtsData as $court) {
    echo '<li data-id="' . htmlspecialchars($court['id'], ENT_QUOTES) . '" onclick=\'showCourtInfo(' . json_encode($court) . ')\'>'
        . htmlspecialchars($court['court_name'], ENT_QUOTES) . ' - ' 
        . htmlspecialchars($court['address'], ENT_QUOTES) . '</li>';
}
?>
        </ul>
    </section>
    <section class="map-section">
        <div id="map" style="width: 100%; height: 500px;"></div>
    </section>
</main>

<div id="courtModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="courtInfo">Информация о площадке</div>
    </div>
</div>

<footer>
    &copy; 2024 BasketPlay. Все права защищены.
</footer>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('courtModal');
    var closeSpan = document.getElementsByClassName("close")[0];

    closeSpan.onclick = function() {
       modal.style.display = "none";
    };

    window.onclick = function(event) {
        if (event.target === modal) {
           modal.style.display = "none";
        }
    };

    window.showCourtInfo = function(court) {
    var courtInfoHTML = '<h2>' + court.court_name + '</h2>'
        + '<p>' + court.address + '</p>'
        + '<p>Телефон: ' + court.phone + '</p>'
        + '<p>Часы работы: ' + court.opening_hours + '</p>';

    if (court.image_path) {
        courtInfoHTML += '<img src="' + court.image_path + '" alt="Фотография площадки" style="max-width: 100%;"/>';
    }

    document.getElementById('courtInfo').innerHTML = courtInfoHTML;
    modal.style.display = "block";
};

    ymaps.ready(initMap);
    function initMap() {
        var myMap = new ymaps.Map("map", {
            center: [47.222109, 39.718813], // Измените на ваш центр карты
            zoom: 10
        });

        var courts = <?php echo json_encode($courtsData); ?>;

        courts.forEach(function(court) {
            var myPlacemark = new ymaps.Placemark([court.latitude, court.longitude], {
                hintContent: court.court_name,
                balloonContent: court.address + '<br><button onclick=\'showCourtInfo(' + JSON.stringify(court) + ')\'>Подробнее</button>'
            });
            myMap.geoObjects.add(myPlacemark);
        });
    }
});
</script>
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