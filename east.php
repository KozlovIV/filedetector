<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<script src="application_script.js"></script>
</head>
<body>
   <table class="easyui-datagrid" id="dg" style="width:auto;height:auto"
            data-options="rownumbers:false,singleSelect:true,url:'east_data.php',toolbar:toolbar">
        <thead>
            <tr>
                <th data-options="field:'name',width:170">Теги</th>
            </tr>
        </thead>
    </table>
</body>
</html>