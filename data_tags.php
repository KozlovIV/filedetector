<?php
// Получаем массив идентификаторов тегов из запроса
$tag_ids = $_GET['tag_ids'];

// Выполняем второй запрос в БД
$con = mysqli_connect("localhost","root","1234","mydb");
$query = "select `name` from `tags` where `id` in (".implode(',', $tag_ids).")";
$result = mysqli_query($con, $query);

// Преобразуем результаты запроса в массив названий тегов
$tag_names = array();

while ($row = mysqli_fetch_assoc($result)) {
    $tag_names[] = $row['name'];
}

// Выполняем третий запрос в БД
$con = mysqli_connect("localhost","root","1234","mydb");
$query = "select `name` from `tags` where `id` in (".implode(',', $tag_ids).")";
$result = mysqli_query($con, $query);

// Преобразуем результаты запроса в массив названий тегов
$tag_names = array();

while ($row = mysqli_fetch_assoc($result)) {
    $tag_names[] = $row['name'];
}
// Отправляем массив JSON с названиями тегов по AJAX
echo json_encode($tag_names);