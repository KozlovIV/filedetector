<?php
session_start();

$checkdata = [];

if(isset($_POST['check'])) {
$checkdata = json_decode($_POST['check'], true);
$result = implode('; ', $checkdata); 
$checks = explode(';', $result);
}

if(!empty($checks)) {
$_SESSION["checks"] = $checks;
}

$tagdata = [];

if(isset($_POST['tag'])) {
$tagdata = json_decode($_POST['tag'], true);
$result = implode('; ', $tagdata); 
$tags = explode(',', $result);
}

if(!empty($tags)) {
$_SESSION["tags"] = $tags;
}

function InsertTagsInDB($tags){
		foreach ($tags as $tag) {
        $con = mysqli_connect("localhost", "root", "1234", "mydb"); 
        $tag = trim($tag); // удаляем пробелы вокруг тега
        $sql = "INSERT IGNORE `tags` (`name`) VALUES ('" . mysqli_real_escape_string($con, $tag) . "')";
        $r = mysqli_query($con, $sql);
    }
}
	
if (null !==($_SESSION["tags"]) && null !==($_SESSION["checks"])){
	InsertTagsInDB($tags);	
	}else{
		
		exit;
	}

$ch = [];
$ch = $_SESSION["checks"];

function InsertChecksInDB($ch) {
    if (!empty($ch)) {
        $con = mysqli_connect("localhost", "root", "1234", "mydb");

        $idfiles_array = [];
        foreach ($ch as $check) {
            $check = trim($check);
            $checkdata_string = "'" . mysqli_real_escape_string($con, $check) . "'";

            $query = "SELECT `id` FROM `filetree` WHERE `name` IN ($checkdata_string);";
            $result = mysqli_query($con, $query);

            $idfiles = mysqli_fetch_all($result);
            $idfiles = array_map('current', $idfiles);
            $idfiles_string = implode(",", $idfiles);

            $idfiles_array[] = $idfiles_string;
        }

        mysqli_close($con);
        return $idfiles_array;
    }
}


// Вызов функции InsertChecksInDB с массивом $ch
if (null !==($_SESSION["tags"]) && null !==($_SESSION["checks"])){
	InsertChecksInDB($ch);	
	}else{
		exit;
	}

$taged = [];
$taged = $_SESSION["tags"];

$returned_istr = InsertChecksInDB($ch);
/*echo "<pre>";
print_r($returned_istr);
echo "</pre>";
$datacheck = explode(",", $returned_istr);*/

function InsertAllInDB($taged, $returned_istr) {
    $con = mysqli_connect("localhost", "root", "1234", "mydb");

    $tag_ids = [];
    foreach ($taged as $tag) {
        $query = "SELECT `id` FROM `tags` WHERE `name` = '$tag'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        $tag_ids[] = $row['id'];
    }

    $values = [];
    foreach ($tag_ids as $tag_id) {
    foreach ($returned_istr as $istr) {
        $query = "INSERT INTO `file` (`id_tag`, `id_files`)
VALUES ($tag_id, $istr)
ON DUPLICATE KEY UPDATE `id_tag` = $tag_id, `id_files` = $istr;";
        mysqli_query($con, $query);
    }
}

    mysqli_close($con);
    return $values;
}

InsertAllInDB($taged, $returned_istr);

 $_SESSION = array();
        session_destroy();
		 /*$con->close(); // Закрыть соединение с базой данных*/

