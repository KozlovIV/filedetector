<?php
// Получите идентификатор изображения из запроса
$id = $_GET['id'];

// Выполните первый запрос в БД
$con = mysqli_connect("localhost","root","1234","mydb");
$query = "select `id_tag` from `file` where `id_files` = $id";
$result = mysqli_query($con, $query);

// Преобразуйте результаты запроса в массив идентификаторов тегов
$tag_ids = array();

while ($row = mysqli_fetch_assoc($result)) {
    $tag_ids[] = $row['id_tag'];
}


// Отправьте массив JSON с идентификаторами тегов по AJAX
echo json_encode($tag_ids);

