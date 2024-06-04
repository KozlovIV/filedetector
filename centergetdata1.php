<html>
<head>

</head>
    <body>
	
<?php

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

$id = $_POST['id'];
$con = mysqli_connect("localhost","root","1234","mydb");
$result = array();
$rs = mysqli_query($con, "select id, name, filepath from `filetree` where parent_id=$id");
while($row = mysqli_fetch_array($rs)){
	 $rows[] = array(
	"id" => $row['id'],
    "name" => $row['name'],
    "filepath" => $row['filepath']);
	
}
//$window_width = $_SERVER['REQUEST_WIDTH'];

$rows_count = count($rows);
$rows_widths = array();

for ($i = 0; $i < $rows_count; $i++) {
  $rows_info = getimagesize($rows[$i]);
  $rows_widths[] = $rows_info[0];
}

$total_rows_width = 0;
foreach ($rows_widths as $rows_width) {
  $total_rows_width += $rows_width;
}

if ($total_rows_width > $window_width) {
    $line_rows_count = floor($window_width / max($rows_widths));
	$rows_per_line = array_chunk($rows, $line_rows_count);
foreach ($rows_per_line as $rows) {
echo "<div class='row'>";
foreach ($rows as $image) {
echo "<img src=' . $image . '/>";
}
echo "</div>";
}
} else {
echo "<div class='col'>";
foreach ($rows as $image) {
echo "<img src=' . $image . '/>";
}
echo "</div>";
}
?>
</body>
</html>