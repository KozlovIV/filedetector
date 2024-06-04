//index.php

function doSearch(value) {
						jQuery.ajax({
						url: 'searchdata.php',
						method: 'POST',
						data: value,
						dataType: 'json',
						success: function(data) {
						
						// Создать новую вкладку EasyUI
						jQuery('#tabs').tabs('add', {
							title: 'Результаты поиска',
							href: 'gotabsoutdata.php',
							queryParams: data,
							closable:true,
								});
							}
						});
					}
					
					
//centergetdata.php

jQuery(":checkbox").on("click", showValues);
	 function showValues() {
		var fields = jQuery( ":input" ).serializeArray();
    jQuery( "results" ).empty();
		var values = [];
    jQuery.each( fields, function( i, field) {
		jQuery( "#results" ).append( field.value);
		values.push(field.value);
		let json = JSON.stringify(values);
	jQuery.ajax({
		type: "POST",
		url: "centeroutdata.php",
		data: {
		  check: JSON.stringify(values)
		}
  });
 });
 }
 
 function openImage(image) {
    jQuery('#modalWindow').find('img').attr('src', image);
    jQuery('#modalWindow').window('open');
}

// Запрос синхронизации treegrid и Tabs
/*jQuery('#tabs').tabs({
    onSelect: function(event, ui) {
        var tabValue = ui.tab.value;

        // Отправьте запрос AJAX на страницу, содержащую treegrid
        jQuery.ajax({
            url: 'west.php',
            data: { tabValue: tabValue },
            success: function(response) {
                // Обновите параметры запроса и перезагрузите treegrid
                jQuery('#treegrid').treegrid('reload', response.queryParams);
            }
        });
    }
});*/

// Получение тегов
function dataImage(id) {
	jQuery('#dg').datagrid('loadData', []);
    // Отправить запрос на сервер
    jQuery.ajax({
        url: 'data_image.php',
        data: { id: id },
        success: function(response) {
            // Преобразовать результаты запроса в массив идентификаторов тегов
            var tag_ids = JSON.parse(response);

            // Выполнить второй запрос в БД с использованием AJAX
            jQuery.ajax({
                url: 'data_tags.php',
                data: { tag_ids: tag_ids },
                success: function(response) {
                    // Преобразовать результаты запроса в массив названий тегов
                    var tag_names = JSON.parse(response);

                    // Отправить данные JSON на страницу east_data.php
                    jQuery.ajax({
                        url: 'east_data.php',
                        data: { tag_names: tag_names, id: id},
                        success: function(response) {
                            // Обработать данные JSON и отобразите их в datagrid
							var tag_out = JSON.parse(response);
							
							 
                        jQuery('#dg').datagrid('loadData', tag_out);
						 window.id = id; // Присвоить глобальной переменной идентификатор изображения
                        }
                    });
                }
            });
        }
    });
	
}

//east.php

	var toolbar = [{
            
            text:'Удалить',
            iconCls:'icon-cut',
            style: {
                border: '1px solid #95B8E7'
            },
            handler: cutRow
        }];
		
		function cutRow() {
    // Получить выбранную строку
    var row = jQuery('#dg').datagrid('getSelected');
    console.log(row);
    // Получить выбранную строку
    var selectedrow = jQuery('#dg').datagrid('getSelected');

    // Если строка выбрана
    if (selectedrow) {
        // Получить индекс выбранной строки
        var rowIndex = jQuery("#dg").datagrid("getRowIndex", selectedrow);
        // Получить идентификатор изображения из глобальной переменной
        var id = window.id; 

        // Преобразовать объект row в JSON-строку
        var row_json = JSON.stringify(row);
        // Преобразовать объект row в JSON-строку
        var index_json = JSON.stringify(rowIndex);

        // Отправить значение строки, индекс строки и идентификатор изображения на сервер с помощью запроса Ajax
        jQuery.ajax({
            url: 'delete_tag.php',
            type: 'POST',
            data: { index: index_json , row: row_json, id: id },
            success: function(response) {
			var data = jQuery.parseJSON(response);
			console.log(response); 
			// Удалить выбранную строку из datagrid
			var index = row.index;
			jQuery('#dg').datagrid('deleteRow', index);
		}
        });
    } else {
        // Отобразить сообщение об ошибке, если строка не выбрана
        alert("Выберите строку для удаления.");
    }
}

//gotabs.php

jQuery(document).ready(function() {
    jQuery('#btn').click(function() {
        var inputTegs = jQuery('#input').val();
        if (inputTegs === '' || inputTegs.length === 0) {
            jQuery.messager.show({
                title: 'Ошибка',
                msg: 'Поле не должно быть пустым! Выберите изображение и введите текст тега.'
            });
        } else {
            jQuery.messager.alert({
                title: 'Подтверждение',
                msg: 'Сохранить данные?',
                iconCls: 'icon-question',
                buttons: [{
                    text: 'ОК',
                    iconCls: 'icon-ok',
                    handler: function() {
                        // Сохранить данные
                        let json = JSON.stringify([inputTegs]);
                        jQuery.ajax({
                            type: "POST",
                            url: "centeroutdata.php",
                            data: {
                                tag: JSON.stringify([inputTegs])
                            },
                            success: function(data) {
                                // Перезагрузить страницу
                               window.location.reload();
                            }
                        });
                    }
                }]
            });
        }
    });
});

//gotabsoutdata.php

function openImage(image) {
            jQuery('#modalImage').attr('src', image);
            jQuery('#modalWindow').window('open');
        }
		
//start.php

 jQuery(document).ready(function() {
    jQuery('#submit-button').click(function(e) {
        e.preventDefault();

        // Получить данные из формы
        var username = jQuery('#username').val();
        var password = jQuery('#password').val();

        // Отправить данные на сервер
        jQuery.ajax({
            url: 'login.php',
            method: 'POST',
            data: {
                username: username,
                password: password
            },
            success: function(response) {
    if (response === 'success') {
        // Авторизовать пользователя
        window.location.href = "index.php";
    } else {
        // Показать модальное окно с сообщением об ошибке
        jQuery('.error-message').text('Неверное имя пользователя или пароль.').show();
    }
}
        });
    });
});

//west.php

jQuery("#tg").treegrid({
   onClickRow: function(row){
      var node = jQuery('#tg').treegrid('getSelected');
      if (node) {
         var tabs = jQuery("#tabs");
         var tab = tabs.tabs("getTab", node.name);
         if (tab){
            tabs.tabs("select", node.name);
         } else {
            //передача id 
            var s = node.text;
            if (node.id){
               s = node.id;
            }
            jQuery.ajax({
               type: "POST",
               url: "centergetdata.php", 
               data: {id: s}}).
			   always(function(data, e, l) {
               // создание новой вкладки
               if ('OK' == l.statusText) {
                  tabs.tabs('add', {
                     title:node.name,
                     //href:'center.php',
                     content: data,
                     closable:true,
                  });
               }
            });
         }
      }
   }
});