<?php
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

$con = mysqli_connect("localhost","root","1234","mydb");
$result = array();
$rs = mysqli_query($con, "select * from `filetree` where parent_id=$id and type='folder'");
while($row = mysqli_fetch_array($rs)){
    $row['state'] = has_child($row['id']) ? 'closed' : 'open';
    $row['total'] = $row['parent_id'];
    array_push($result, $row);
}

echo json_encode($result);

function has_child($id){
    $con = mysqli_connect("localhost","root","1234","mydb");
    $rs = mysqli_query($con, "select count(*) from `filetree` where parent_id=$id");
    $row = mysqli_fetch_array($rs);
    return $row[0] > 0 ? true : false;
}
?>