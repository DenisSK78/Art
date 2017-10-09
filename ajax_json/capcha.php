<?php
header('Content-Type: text/html; charset=utf-8');

if ($_POST['name']==3){
    $capJson=file_get_contents('cap.json');
    echo $capJson;
    exit();
}

if ($_POST['rend']==1){
    $rend=rand(1,12);
    echo $rend;
//    $rendR=["ans"=>$rend];
//    $rendRJ=json_encode($rendR);
//    echo $rendRJ;
    exit();
}
