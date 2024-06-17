<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Добавлен мета-тег viewport -->
    <title>Добро пожаловать!</title>
    <style>
    /* Ваши стили */
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

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body, html {
  font-family: 'Arial', sans-serif;
  background: var(--background-color);
  color: var(--text-color);
  line-height: 1.6;
}

h2 {
  text-align: center;
  color: var(--header-background);
}

.form-container {
  max-width: 400px;
  margin: 50px auto;
  padding: var(--section-padding);
  background-color: var(--light-color);
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.input-group {
  margin-bottom: 15px;
}

label {
  font-weight: bold;
  color: var(--header-background);
}

input[type="text"],
input[type="password"],
button {
  width: 100%;
  padding: 10px;
  margin: 5px 0;
  border: 1px solid #ccc;
  border-radius: 3px;
  box-sizing: border-box;
  color: var(--text-color);
}

input[type="text"],
input[type="password"] {
  background-color: #fff;
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

@media (max-width: 768px) {
    body, html {
        margin: 0;
        padding: 0;
        height: 100%;
        width: 100%;
    }

    .form-container {
        position: fixed; /* Изменил на fixed для обеспечения покрытия всего экрана */
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        margin: 0;
        padding: 20px;
        height: 100%;
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        box-shadow: none;
    }

    label, input[type="text"], input[type="password"], button {
        font-size: 1em;
    }

    input[type="text"], input[type="password"], button {
        padding: 15px;
        margin-top: 10px;
    }

    button {
        margin-top: 20px;
    }
}
    </style>
</head>
<body>

<div class="form-container">
    <h2>Добро пожаловать!</h2>
    <form action="check_login.php" method="post">
        <div class="input-group">
            <label for="username">Имя пользователя:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="input-group">
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="btn">Войти</button>
    </form>
</div>

</body>
</html>