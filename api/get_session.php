<?php

include_once "db.php";

$id=$_GET['movieId'];
$date=$_GET['date'];

$movies=$Movies->find($id);
$ondate=strtotime($movies['ondate']);
$today=strtotime(date('Y-m-d'));

$start=0;
$hr=date("G");
if($date == date("Y-m-d") && $hr>13 ){
    $start=ceil(($hr-13)/2);
}


for($i=$start;$i<5;$i++){
    
    echo "<option value='{$sessStr[$i]}'>";
    echo $sessStr[$i];
    echo "</option>";
}