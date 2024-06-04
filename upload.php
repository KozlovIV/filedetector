<?php
if (isset($_FILES['file'])) {
    // Получаем информацию о загруженном файле
    $file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];

    // Проверяем, есть ли ошибки при загрузке файла
    if ($_FILES['file']['error'] === 0) {
        // Сохраняем загруженный файл на сервере
        $file_destination = 'uploads/' . $file_name;
        if (move_uploaded_file($file_tmp, $file_destination)) {
            echo "Файл успешно загружен.";
        } else {
            echo "Не удалось сохранить файл на сервере.";
        }
    } else {
        echo "При загрузке файла произошла ошибка.";
    }
}