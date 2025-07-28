<?php
include_once "db.php";

if(!empty($_FILES['poster']['tmp_name'])){
    move_uploaded_file($_FILES['poster']['tmp_name'],"../images/".$_FILES['poster']['name']);
    $_POST['poster']=$_FILES['poster']['name'];
}

if(!empty($_FILES['trailer']['tmp_name'])){
    move_uploaded_file($_FILES['trailer']['tmp_name'],"../images/".$_FILES['trailer']['name']);
    $_POST['trailer']=$_FILES['trailer']['name'];
}

$_POST['ondate']="{$_POST['year']}-{$_POST['month']}-{$_POST['day']}";
unset($_POST['year'],$_POST['month'],$_POST['day']);
if(!isset($_POST['id'])){
    $_POST['sh']=1;
    $_POST['rank']=$Movies->max('rank')+1;
}

$Movies->save($_POST);

to("../backend.php?do=movie");