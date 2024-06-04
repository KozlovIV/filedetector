<html>
 <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="easyui/themes/icon.css">
    <script type="text/javascript" src="easyui/jquery.min.js"></script>
    <script type="text/javascript" src="easyui/jquery.easyui.min.js"></script>
	<script src="easyui/locale/easyui-lang-ru.js"></script>
	<script src="application_script.js"></script>
	<style>
	.error-message {
  left: 120px;
 
}
	</style>
</head>
<body class="easyui-layout">
	<div id="loginModal" class="easyui-window" title="Вход в систему" data-options="modal:true, closable:false, collapsible:false, minimizable:false, maximizable:false, draggable:false, resizable:false, modal:true, iconCls:'icon-save'" style="width:500px;height:200px;padding:10px;">
         <form action="login.php" method="post" style="margin-left:110px; margin-top:20px;">
            <label  for="username">&nbsp;&nbsp;Логин:</label>
            <input class="easyui-validatebox" type="text" name="username" id="username" data-options="required:true"/>
            <br /><br />
            <label for="password">Пароль:</label>
            <input class="easyui-validatebox" type="password" name="password" id="password" data-options="required:true"/>
            <br /><br />
            <input class="easyui-linkbutton" id="submit-button" type="submit" value="Войти" style="position: absolute; width:70px; height:30px; right: 50px; margin-bottom: 5px;"/>
            <div class="error-message" style="display: none; color: red; position: absolute; top: 150px; right: 50px;"></div>
        </form>
    </div>
</body>  
</html>  