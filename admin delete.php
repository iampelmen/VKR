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

$query = "SELECT * FROM basketball_courts";
$result = $conn->query($query);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Административная панель</title>
    <link rel="stylesheet" href="styles_admin.css">
</head>
<body>
    <header>
        <h1 class="header-title">Страница администратора</h1>
        <div class="nav-links">
            <ul>
                <li class="nav-link"><a class="custom-button" href="admin.php">Предложенные</a></li>
                <li class="nav-link"><a class="custom-button" href="logout.php">Выйти</a></li>
            </ul>
        </div>
    </header>

    <div class="admin-main">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="message">
                <?php 
                    echo $_SESSION['message']; 
                    unset($_SESSION['message']);
                ?>
            </div>
        <?php endif; ?>

        <table>
            <tr>
                <th>Название</th>
                <th>Адрес</th>
                <th>Действия</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['court_name']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td>
                    <a href="edit_court_main.php?id=<?php echo $row['id']; ?>" class="custom-button">Редактировать</a>
                    <form method="post" action="admindb delete.php" style="display:inline;">
                        <input type="hidden" name="court_id" value="<?php echo $row['id']; ?>">
                        <input type="submit" name="delete" class="custom-button" value="Удалить">
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
<?php $conn->close(); ?>