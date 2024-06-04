<?php
// Получаем массив названий тегов из запроса
$tag_names = $_GET['tag_names'];

// Преобразуем массив названий тегов в формат JSON
$json = json_encode($tag_names);

$data = json_decode($json, true);

$result = array(
    "total" => count($data),
    "rows" => array()
);

foreach ($data as $item) {
   $result["rows"][] = array("name" => $item);
}


echo json_encode($result);

//Массив для проверки
/*$result = array(
    "total" => 4,
    "rows" => array(
        array(
            "name" => "перчатки"
        ),
        array(
            "name" => "пасатижи"
        ),
        array(
            "name" => "ключи"
        ),
        array(
            "name" => "отвёртки"
        )
    )
);

echo json_encode($result);*/
?>