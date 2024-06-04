<?php
$value = file_get_contents("php://input");
$valuedata = urldecode($value);
			
function SearchTags($valuedata) {
    // Подключиться к базе данных
    $con = mysqli_connect("localhost", "root", "1234", "mydb"); 

    // Пройти в таблицу tags и выбрать id для name = value
    $tag_id = null;
    $query = "SELECT `id` FROM `tags` WHERE `name` = '" . mysqli_real_escape_string($con, $valuedata) . "'";
    $result = mysqli_query($con, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $tag_id = $row['id'];
    }

    // Пройти в таблицу file и выбрать id_tag для предыдущего запроса
   $file_ids = [];
    if ($tag_id) {
        $query = "SELECT `id_files` FROM `file` WHERE `id_tag` = '$tag_id'";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $file_ids[] = $row['id_files'];
        }
    }

    // Пройти в таблицу filetree и выбрать filepath, name для предыдущего запроса
    $file_paths = [];
	$file_name = [];
	$full_paths = [];
    if (!empty($file_ids)) {
        $file_ids_string = implode(",", $file_ids);
        $query = "SELECT `filepath`, `name` FROM `filetree` WHERE `id` IN ($file_ids_string)";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $file_paths[] = $row['filepath'];
			$file_name[] = $row['name'];
			$full_paths = array_map(function($path, $name) {
			return $path . $name;
			}, $file_paths, $file_name);
        }
    }

    // Вывести результат
    if (!empty($full_paths)) {
		$json = json_encode($full_paths);
		header('Content-Type: application/json');
		echo $json;
    } else {
		
    }
	
    // Закрыть соединение с базой данных
    mysqli_close($con);
}

SearchTags($value);

?>
