<html>
 <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<script type="text/javascript" src="easyui/jquery.min.js"></script>
    <script type="text/javascript" src="easyui/jquery.easyui.min.js"></script>
	<script src="application_script.js"></script>
</head>
<body>
	<table id="tg" class="easyui-treegrid" style="width:auto; height: calc 100% -5px"
			url="west_getdata.php"
			rownumbers="folse"
			idField="id" treeField="name" id="folder-view">
		<thead>
			<tr>
				<th field="name" width="190px" height="100%" margin-left="10px">&nbsp;&nbsp;<b>Каталог</b></th>
			</tr>
		</thead>
	</table>
	 <script type="text/javascript">
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
                     content: data,
                     closable:true,
                  });
               }
            });
         }
      }
   }
});
</script>
</body>
</html>   