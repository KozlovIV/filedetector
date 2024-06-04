<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="centerbox.css">
    <link rel="stylesheet" type="text/css" href="easyui/themes/icon.css">
    <script type="text/javascript" src="easyui/jquery.min.js"></script>
    <script type="text/javascript" src="easyui/jquery.easyui.min.js"></script>
	<script src="easyui/locale/easyui-lang-ru.js"></script>
	<script src="application_script.js"></script>
	<link rel="stylesheet" type="text/css" media="screen" href="elfinder/css/elfinder.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="elfinder/css/theme.css">
    <script type="text/javascript" src="elfinder/js/elfinder.min.js"></script>
    <!-- <script type="text/javascript" charset="utf-8">$().ready(function() {var elf=$('#elfinder').elfinder({url:'../elfinder/php/connector.minimal.php',lang:'ru'}).elfinder('instance');});</script>-->
	<script>
        $(function () {
            $('#elfbtn').click(function() {
                $('#elfinderModal').dialog('open'); 
            });
        });
    </script>
</head>
<body class="easyui-layout">
<div id="elfinder"></div>
    <div class="easyui-layout" style="width:100%; height:100%;">
	                        
							<!--Главный восток -->
        <div data-options="region:'east',split:true" style="width:180px;">
		<div class="easyui-layout" data-options="fit:true">
		                    <!--Вложенный север в восток-->
                <div data-options="region:'north', href:'east.php', title:'Информация',split:true, collapsible:false" style="height:50%;"></div>
							
							<!--Вложенный центр в восток-->
                <div data-options="region:'center', href:'gotabs.php', title:'Присвоить теги', split:true" style="height:50%;"></div>
            </div>
		</div>
							 <!--Главный запад -->
        <div data-options="region:'west',split:true, collapsible:false" title="&nbsp;&nbsp;Обозреватель хранилища" style="width:200px;">
			<div class="easyui-layout" data-options="fit:true">
								 <!--Вложенный север в запад -->
			<div data-options="region:'north',split:true" style="height:37px">
				<div class="easyui-panel" style="width:192px; max-width:auto; padding:0px 7px;">
				<input class="easyui-searchbox" id="input" data-options="prompt:'Поиск',searcher:doSearch" style="width:100%">
				</div>
						<script>
						doSearch();
					</script>
			</div>
								 <!--Вложенный центр в запад -->
					<div data-options="region:'center',split:true, href:'west.php'" style="height:auto, width:100%"></div>
								 <!--Вложенный юг в запад -->
					<div data-options="region:'south',split:true, title:'Загрузить файлы', hideCollapsedContent:false, collapsed: true" style="height:100px">
						<div class="easyui-panel" style="width:100%; height:100%; padding:5px 10px;">
							<a href="#" id="elfbtn" class="easyui-linkbutton" style="width:145px; height:50px; margin-left:10px; border: 2.5px solid #95B8E7;">Открыть редактор хранилища</a>

<div id="elfinderModal" class="easyui-dialog" title="Управление хранилищем" closed="true" modal="true" draggable="false" language="ru" style="width:1200px; height:640px; top:0px; z-index:1320;">
    <iframe id="elfinderFrame" src="elfinder/elfinder.src.php" width="100%" height="100%" frameborder="0"></iframe>
</div>
							
						</div>
						<script>
						/*$('#input').click(function(e) {
    e.preventDefault();

    $('#input').click();
});

$('#input').elfinder({
    url : '../elfinder/elfinder.src.php'  // URL to the Elfinder connector script
});

	$('#input').elfinder({
    url : '../elfinder/php/connector.minimal.php'  // URL to the Elfinder connector script
});

$('#input').on('keydown', function(e) {
    // Получаем выбранные файлы
    var files = e.data.selected;

    // Создаем объект формы для отправки файлов
    var formData = new FormData();

    // Добавляем выбранные файлы в объект формы
    for (var i = 0; i < files.length; i++) {
        formData.append('files[]', files[i]);
    }

    // Отправляем форму на сервер
    $.ajax({
        url: 'upload.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            // Обрабатываем ответ сервера
            if (response.success) {
                // Отображаем сообщение об успешной загрузке
                $.messager.show({
                    title: 'Успех',
                    msg: 'Файлы успешно загружены.'
                });
            } else {
                // Отображаем сообщение об ошибке
                $.messager.show({
                    title: 'Ошибка',
                    msg: response.error
                });
            }
        },
        error: function() {
            // Отображаем сообщение об ошибке
            $.messager.show({
                title: 'Ошибка',
                msg: 'Произошла ошибка при загрузке файлов.'
            });
        }
    });
});*/
</script>
					</div>
			</div>
		</div>
							<!--Главный центр -->
        <div data-options="region:'center',iconCls:'icon-ok', title:'Содержимое папки', border:'false'" style="background:#ffffff;">
			<div class="easyui-layout" data-options="fit:true">
				<div style="margin:2px 0;"></div>
					<div class="easyui-tabs" id="tabs" data-options=" fit:true,border:false,plain:true, pagination:true">
						<div title="Начало" style="padding:10px">
								<p style="font-size:14px">Инструкция:</p>
									<ol>
										<li>выберите дирректорию в списке слева;</li><br /><br />
										<li>выберите необходимые файлы;</li><br /><br />
										<li>введите в текстовое поле справа имена тегов;</li></li><br /><br />
										<li>нажмите кнопку "Сохранить";</li></li><br /><br />
										<li>для поиска файлов по присвоенным тегам воспользуйтесь текстовым полем в левом верхнем углу.</li></li><br /><br />
									</ol>
								<p style="font-size:14px; margin-left:300px;">Приятной работы!!!</p>
						</div>
					</div>
			</div>
        </div>
    </div>
</body>  
</html>  