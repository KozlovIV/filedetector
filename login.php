<?php
session_start();

// Получить данные из запроса
$username = $_POST['username'];
$password = $_POST['password'];

// Подключиться к базе данных
$mysqli = new mysqli("localhost", "root", "1234", "mydb");

// Подготовить запрос
$sql = "SELECT * FROM users WHERE username = ? AND password = ?";

// Подготовить выражение
$stmt = $mysqli->prepare($sql);

// Привязать параметры
$stmt->bind_param("ss", $username, $password);

// Выполнить запрос
$stmt->execute();

// Получить результат
$result = $stmt->get_result();

// Проверить, существует ли пользователь
if ($result->num_rows === 1) {
    // Авторизовать пользователя
    $_SESSION['is_logged_in'] = true;

    // Отправить ответ "success"
    echo 'success';
} else {
    // Установить HTTP-код состояния на 401 (неавторизованный)

    // Отправить ответ "error"
    echo 'error';
}

// Закрыть выражение и соединение
$stmt->close();
$mysqli->close();
?>