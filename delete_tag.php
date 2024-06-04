<?php

// Подключиться к базе данных
$mysqli = new mysqli("localhost", "root", "1234", "mydb");

// Получить массив row из запроса POST
$row = $_POST['row'];

// Преобразовать строку JSON в обычную строку
$data = json_decode($row, true);
$name = $data['name'];

// Получить индекс строки из запроса POST
$index = $_POST['index'];

// Получить идентификатор изображения из запроса POST
$id = $_POST['id'];

// Использовать подготовленный запрос для извлечения id из таблицы tags
$sql = "SELECT id FROM tags WHERE name = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();
$id_tags = $result->fetch_assoc()['id'];

// Использовать подготовленный запрос для удаления строки
$sql = "DELETE FROM `file` WHERE `id_tag` = ? AND `id_files` = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ii", $id_tags, $id);
$stmt->execute();

// Проверить, была ли запись успешно удалена
if ($stmt->affected_rows > 0) {
    // Запись успешно удалена
    $response = array("success" => true);
    
    // Добавить индекс строки в ответ
    $response['index'] = $index;
} else {
    // Не удалось удалить запись
    $response = array("success" => false);
}

// Отправить ответ обратно в JavaScript
echo json_encode($response);

// Закрыть соединение с базой данных
$stmt->close();
$mysqli->close();

?>