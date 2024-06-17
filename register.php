<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация пользователя</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --background-color: #f4f7f6;
            --text-color: #333;
            --header-background: #1a1a1d;
            --accent-color: #c3073f;
            --hover-dark-accent: #6f2232;
            --light-color: white;
            --section-padding: 1rem;
            --transition-duration: 0.3s;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: var(--background-color);
            color: var(--text-color);
            margin: 0;
            padding: 0;
        }
        
        h1 {
            text-align: center;
            color: var(--header-background);
            padding: var(--section-padding) 0; /* Добавил верхний и нижний отступы */
        }
        
        form {
            max-width: 400px;
            margin: 2rem auto; /* увеличенный отступ сверху и снизу */
            padding: var(--section-padding);
            background-color: var(--light-color);
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--accent-color);
        }
        
        label {
            font-weight: bold;
            color: var(--header-background);
            display: block; /* Лейблы теперь как блоки */
            margin-top: 0.5rem; /* Отступ сверху для лэйбла */
        }
        
        input[type="text"],
        input[type="email"],
        input[type="password"],
        button {
            width: calc(100% - 20px); /* Вычисление ширины с учетом padding */
            padding: 10px;
            margin-top: 0.5rem; /* Уменьшен отступ сверху для элементов формы */
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            color: var(--text-color);
            background-color: var(--light-color);
        }
        
        button {
            background-color: var(--accent-color);
            color: var(--light-color);
            border: none;
            cursor: pointer;
            transition: background-color var(--transition-duration);
        }
        
        button:hover {
            background-color: var(--hover-dark-accent);
        }
        
        /* Адаптивные стили */
        @media (max-width: 768px) {
            form {
                width: 90%; /* Меньшая ширина для маленьких экранов */
                padding: var(--section-padding);
                margin: 1rem auto; /* Меньший отступ сверху и снизу */
            }

            input[type="text"],
            input[type="email"],
            input[type="password"],
            button {
                margin-top: 1rem; /* Больший отступ сверху для мобильных устройств */
            }
            
            h1 {
                font-size: 1.5rem; /* Меньший размер шрифта для заголовка на маленьких экранах */
            }
        }
    </style>
</head>
<body>
    <h1>Регистрация пользователя</h1>
    <form action="registerdb.php" method="POST">
        <div>
            <label for="username">Имя пользователя:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <button type="submit">Зарегистрироваться</button>
    </form>
</body>
</html>