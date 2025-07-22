<?php include_once "db.php";

if(!empty($_FILES['img']['tmp_name'])){
    move_uploaded_file($_FILES['img']['tmp_name'],"../images/".$_FILES['img']['name']);
    $Poster->save([
        'name'=>$_POST['name'],
        'img'=>$_FILES['img']['name'],
        'sh'=>1,
        'rank'=>$Poster->max('id')+1,
        'ani'=>rand(1,3),
    ]);
}

to("../backend.php?do=poster");