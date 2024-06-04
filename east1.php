<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>

<div id="p" class="easyui-panel" title="Basic Panel" style="width:700px;height:200px;padding:10px;">
</div>

<script type="text/javascript">

    $.ajax({
    url: 'east_data.php',
    method: 'get',
    dataType: "json",
    success: function(data) {
        var decodedData = decodeURIComponent(data);
        var parsedData = JSON.parse(decodedData);

        $('#p').panel('loadData', parsedData.Rows);
        $('#p').panel('reload');
    }
});
</script>

</body>
</html>