<html>
 <head>
	<link rel="stylesheet" type="text/css" href="centerbox.css">
	<script src="application_script.js"></script>
</head>
<body>
<?php

// Получаем данные из параметров запроса
$data = $_GET;
$json = json_encode($data);

// Преобразуем в объект
$data = json_decode($json, true);

// Удаляем последний элемент из массива
array_pop($data);

// Отображаем данные в виде HTML
echo "<div class='container'>"; // создать контейнер
  
  foreach($data as $item){ // Текущий каталог и родительский пропустить
	  echo "<div class='item'>";// Открыть итем
      echo "<a href='javascript:void(0)' class='easyui-linkbutton' data-options='".htmlspecialchars('iconCls:"icon-arrow"')."' onclick='openImage(\"".$item."\")' style=' position: absolute; right: 4px; top: 4px; width:20px; height:20px; z-index:1320;'>"; // Ссылка на картинку
	  echo "</a>";
      echo "<img class='img1' src='$item' />"; // Вывод превью картинки
	  /*echo "</a>"; // Закрыть ссылку*/
	  echo "</div>"; // 
	  }
  echo "</div>"; // Закрыть контейнер
  //Модальное окно
  echo "<div id='modalWindow' class='easyui-window' data-options='modal:true,closed:true, collapsible:false, minimizable:false, maximizable:false, draggable:false, resizable:false, modal:true,' style='width:1200px; height:640px; top:0px; z-index:1320;'>";
echo "<img class='imgModal' id='modalImage' src='' />";
echo "</div>";
?>
</body>
</html>  