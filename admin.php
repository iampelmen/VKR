<?php
// Добавляем сессию в начало файла
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Админ-панель</title>
    <link rel="stylesheet" href="styles_admin.css">
</head>
<body>
    <header>
        <h1 class="logo">Страница администратора</h1>
        <div class="nav-links">
            <ul>
                <li class="nav-link"><a class="custom-button" href="admin delete.php">Основная таблица</a></li>
                <li class="nav-link"><a class="custom-button logout-button" href="logout.php">Выйти</a></li>
            </ul>
        </div>    
    </header>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="message">
            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
        </div>
    <?php endif; ?>
    <h1>Площадки, ожидающие подтверждения</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Адрес</th>
            <th>Телефон</th>
            <th>Часы работы</th>
            <th>Координаты</th>
            <th>Действие</th>
        </tr>
        <?php
        $host = 'localhost';
        $user = 'root';
        $password = ''; // Здесь должен быть Ваш настоящий пароль
        $database = 'kurs';

        $conn = new mysqli($host, $user, $password, $database);

        if ($conn->connect_error) {
            die("Ошибка подключения к базе данных: " . $conn->connect_error);
        }
        
        $query = "SELECT * FROM basketball_courts_temporary";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['court_name']."</td>";
                echo "<td>".$row['address']."</td>";
                echo "<td>".$row['phone']."</td>";
                echo "<td>".$row['opening_hours']."</td>";
                echo "<td>".$row['latitude'].", ".$row['longitude']."</td>";
                echo "<td>";
                // Форма подтверждения
                echo "<form method='post' action='admindb.php' style='display: inline;'>";
                echo "<input type='hidden' name='court_id' value='".$row['id']."'>";
                echo "<button class='custom-button' type='submit' name='approve'>Подтвердить</button>";
                echo "</form>";
                // Форма удаления
                echo "<form method='post' action='admindb.php' style='display: inline;'>";
                echo "<input type='hidden' name='court_id' value='".$row['id']."'>";
                echo "<button class='custom-button' type='submit' name='delete'>Удалить</button>";
                echo "</form>";
                echo "<a href='edit_court.php?id=".$row['id']."' class='custom-button'>Редактировать</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Нет данных</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</body>
</html>