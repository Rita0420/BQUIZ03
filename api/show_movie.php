<?php
include_once "db.php";

$movie=$Movies->find($_POST['id']);

$movie['sh']=($movie['sh']+1)%2;

$Movies->save($movie);