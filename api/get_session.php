<?php

include_once "db.php";

$id=$_GET['movieId'];
$date=$_GET['date'];

$movies=$Movies->find($id);
$ondate=strtotime($movies['ondate']);
$today=strtotime(date('Y-m-d'));

$start=0;
//G是1~24
$hr=date("G");
if($date == date("Y-m-d") && $hr>13 ){
    $start=ceil(($hr-13)/2);
}


for($i=$start;$i<5;$i++){
    $remaining=20; //假設每場剩餘20個座位，20-已被訂走的座位
    echo "<option value='{$sessStr[$i]}'>";
    echo $sessStr[$i];
    echo "剩餘座位 ";
    echo "$remaining 人";
    echo "</option>";
}