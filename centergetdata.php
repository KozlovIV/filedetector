<html>
 <head>
	<link rel="stylesheet" type="text/css" href="centerbox.css">
	<script src="application_script.js"></script>
	<style>
	.icon-arrow{
	background:url('easyui/themes/icons/arrow.png') no-repeat center center;
	margin-left:-4.5px;
	top:13.2px;
}
	</style>
</head>
 <body>
 
<?php
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$id = $_POST['id'];
$con = mysqli_connect("localhost","root","1234","mydb");
$rs = mysqli_query($con, "select id, name, filepath from `filetree` where parent_id=$id");
$rows = array();
while($row = mysqli_fetch_array($rs)){
	 $rows[] = array(
	"id" => $row['id'],
    "name" => $row['name'],
    "filepath" => $row['filepath']);
}
		
$json = json_encode($rows);
// Преобразовать в объект
$data = json_decode($json,true);
  echo "<p>";
  /*echo "<b>Results:</b>";*/
  echo "<span class='results'></span>";
  echo "</p>";
  echo "<div class='container' >"; // Создать контейнер
  
  foreach($data as $item){ // Текущий каталог и родительский пропустить
	  echo "<div class='item'>";// Создать Итем
      echo "<a href='javascript:void(0)' class='easyui-linkbutton' data-options='".htmlspecialchars('iconCls:"icon-arrow"')."' onclick='openImage(\"".$item['filepath'].$item['name']."\")' style=' position: absolute; right: 4px; top: 4px; width:20px; height:20px; z-index:1320;'>"; // Ссылка на картинку
	  echo "</a>";
      echo "<img class='img1' src='$item[filepath]$item[name]' onclick='dataImage(\"".$item['id']."\")'/>"; // Вывод превью картинки
	  echo "<input type='checkbox' class='checkbox' name=$item[name] id='$item[id]' value=$item[name] />";
	  echo "</div>"; // Закрыть Итем
	  }
  echo "</div>"; // Закрыть контейнер
  //модальное окно
  echo "<div id='modalWindow' class='easyui-window' title='(\"".$item['name']."\")' data-options='modal:true,closed:true, collapsible:false, minimizable:false, maximizable:false, draggable:false, resizable:false, modal:true,' style='width:1200px; height:640px; top:0px; z-index:1320;'>";
echo "<img class='imgModal' id='modalImage' src='' />";
echo "</div>";
?>

<script>
function openImage(); 

// Получение тегов
function dataImage(); 
</script>
</body> 
</html>  