<?php

// Строим дерево.
function GetFilesTree($path)
{
        $dir = scandir($path);
        $res = array();
		
        foreach ($dir as $i => $subpath)
        {
			if (is_dir($path)){
                if ($subpath != "." AND $subpath != "..")
                {
                        if (is_dir($path.'/'.$subpath))
                        {
                                $res[$subpath]=GetFilesTree($path.'/'.$subpath);
                        }
                        else
                        {
                                $res[$subpath]=0;
                        }
                }
			}
        }
        return $res;
}
// Пихаем дерево в БД
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$con = mysqli_connect("localhost","root","1234","mydb");
foreach(glob('data/*', GLOB_ONLYDIR) as $dir) {
    $dir = str_replace('data/', '', $dir);
    
}
function InsertFilesTreeInDB ($tree,$path,$PID=0)
{
	

   foreach($tree as $f => $c)
   {
	  $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
      $con = mysqli_connect("localhost","root","1234","mydb");
      $r = mysqli_query($con, "INSERT INTO `filetree` (id,name,filepath,parent_id) VALUES (null,'$f','{$path}/',$PID)");
	 
      if ($c)
      {
         $npid = mysqli_insert_id($con);
         InsertFilesTreeInDB($c,$path.'/'.$f,$npid);
      }
   
   }
}

// Тестовый вызов
$path = 'data';
InsertFilesTreeInDB (GetFilesTree($path),$path)
?>
