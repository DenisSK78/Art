<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
//$nameSes=$_SESSION['gal'];
if(isset($_POST["textZ"])){
    // проверку + запись в файл по имени юзера
    include ("../conBD_g.php");

    $queryAll=mysqli_query($connBDsql,"SELECT * FROM `events`");
    mysqli_close($connBDsql);
    while ($queryAll_=mysqli_fetch_assoc($queryAll)){ //--------------------- перебираем результат запроса
        $dataQuery[]=$queryAll_; //------------------------------------------ собирает все строки запроса в масив
    }

    for ($i=0; $i<count($dataQuery);$i++){
        $arrdateFBd=explode("-", $dataQuery[$i]['event_date']);
        $dateFBd=$arrdateFBd[2].".".$arrdateFBd[1].".".$arrdateFBd[0];
        $dataQuery[$i]['event_date']=$dateFBd;
    }

    array_unshift($dataQuery,['ind'=>count($dataQuery)]);
    $rowJsonFile=json_encode($dataQuery, JSON_UNESCAPED_UNICODE);//-- кодируем в JSON весь запрос
    echo $rowJsonFile;
    file_put_contents('../ajax_json/user1Eve.json',$rowJsonFile);//-- записываем в файл с именем юзера результат
    exit();
}

if(isset($_POST["nowSub"])){
    $postEveN=$_POST['nowSub'];
    $arrEveN=explode("^", $postEveN);

    $arrdateFBd=explode(".",$arrEveN[2]);
    $dateFBd=$arrdateFBd[2].'/'.$arrdateFBd[1].'/'.$arrdateFBd[0];

    include ("../conBD_g.php");

    $queryAll=mysqli_query($connBDsql,"INSERT INTO `events`(`event_name`, `event_date`, `event_addr`, `event_prim`, `event_vid`) VALUES ( '$arrEveN[0]','$dateFBd','$arrEveN[3]','$arrEveN[4]','$arrEveN[1]');");
    $queryAll1=mysqli_query($connBDsql,"SELECT * FROM `events`");
    mysqli_close($connBDsql);
    while ($queryAll_=mysqli_fetch_assoc($queryAll1)){ //--------------------- перебираем результат запроса
        $dataQuery[]=$queryAll_; //------------------------------------------ собирает все строки запроса в масив
    }

    for ($i=0; $i<count($dataQuery);$i++){
        $arrdateFBd=explode("-", $dataQuery[$i]['event_date']);
        $dateFBd=$arrdateFBd[2].".".$arrdateFBd[1].".".$arrdateFBd[0];
        $dataQuery[$i]['event_date']=$dateFBd;
    }

    array_unshift($dataQuery,['ind'=>count($dataQuery)]);
    $rowJsonFile=json_encode($dataQuery, JSON_UNESCAPED_UNICODE);//-- кодируем в JSON весь запрос
    file_put_contents('../ajax_json/user1Eve.json',$rowJsonFile);//-- записываем в файл с именем юзера результат
    $colvo=count($dataQuery)-1;
    $arr=[];
    array_unshift($arr,['ind'=>$colvo]);
    $send=json_encode($arr, JSON_UNESCAPED_UNICODE);
    echo count($dataQuery)-1;
    exit();
}

if(isset($_POST["reqVid"])){
    $val=$_POST["reqVid"];
    include ("../conBD_g.php");
    $queryAll=mysqli_query($connBDsql,"SELECT * FROM `events` WHERE `event_vid`='$val' ORDER BY `event_date`");
    mysqli_close($connBDsql);
    while ($queryAll_=mysqli_fetch_assoc($queryAll)){
        $dataQuery[]=$queryAll_;
    }

    for ($i=0; $i<count($dataQuery);$i++){
        $arrdateFBd=explode("-", $dataQuery[$i]['event_date']);
        $dateFBd=$arrdateFBd[2].".".$arrdateFBd[1].".".$arrdateFBd[0];
        $dataQuery[$i]['event_date']=$dateFBd;
    }

    $rowJsonFile=json_encode($dataQuery, JSON_UNESCAPED_UNICODE);
    echo $rowJsonFile;
    file_put_contents('../ajax_json/user1Eve.json',$rowJsonFile);
    exit();
//        echo (json_encode($val));
}

if(isset($_POST["reqNear"])){
    $today = date("Y-m-d");
    include ("../conBD_g.php");
    $queryAll=mysqli_query($connBDsql,"SELECT * FROM `events` WHERE `event_date`>'$today' ORDER BY `event_date`;");
    mysqli_close($connBDsql);
    while ($queryAll_=mysqli_fetch_assoc($queryAll)){
        $dataQuery[]=$queryAll_;
    }

    for ($i=0; $i<count($dataQuery);$i++){
        $arrdateFBd=explode("-", $dataQuery[$i]['event_date']);
        $dateFBd=$arrdateFBd[2].".".$arrdateFBd[1].".".$arrdateFBd[0];
        $dataQuery[$i]['event_date']=$dateFBd;
    }

    $rowJsonFile=json_encode($dataQuery, JSON_UNESCAPED_UNICODE);
    echo $rowJsonFile;
    file_put_contents('../ajax_json/user1Eve.json',$rowJsonFile);
    exit();
}

if(isset($_POST["del"])){
    $idBd = $_POST["del"];
    include ("../conBD_g.php");
    $query=mysqli_query($connBDsql,"DELETE FROM `events` WHERE `event_id`='$idBd';");
    $queryAll=mysqli_query($connBDsql,"SELECT * FROM `events`");
    mysqli_close($connBDsql);
    while ($queryAll_=mysqli_fetch_assoc($queryAll)){
        $dataQuery[]=$queryAll_;
    }

    for ($i=0; $i<count($dataQuery);$i++){
        $arrdateFBd=explode("-", $dataQuery[$i]['event_date']);
        $dateFBd=$arrdateFBd[2].".".$arrdateFBd[1].".".$arrdateFBd[0];
        $dataQuery[$i]['event_date']=$dateFBd;
    }

    array_unshift($dataQuery,['ind'=>count($dataQuery)]);
    $rowJsonFile=json_encode($dataQuery, JSON_UNESCAPED_UNICODE);
    file_put_contents('../ajax_json/user1Eve.json',$rowJsonFile);
    echo count($dataQuery)-1;
    exit();
}

if(isset($_POST["redSub"])){
    $str=$_POST["redSub"];
    $arrStr=explode('^', $str);
    include ("../conBD_g.php");

    $arrdateFBd=explode(".",$arrStr[2]);
    $dateFBd=$arrdateFBd[2].'/'.$arrdateFBd[1].'/'.$arrdateFBd[0];

    $query=mysqli_query($connBDsql,"UPDATE `events` SET `event_name`='$arrStr[0]',`event_date`='$dateFBd',`event_addr`='$arrStr[3]',`event_prim`='$arrStr[4]',`event_vid`='$arrStr[1]' WHERE `event_id`='$arrStr[5]';");
    $queryAll=mysqli_query($connBDsql,"SELECT * FROM `events`");
    mysqli_close($connBDsql);
    while ($queryAll_=mysqli_fetch_assoc($queryAll)){
        $dataQuery[]=$queryAll_;
    }

    for ($i=0; $i<count($dataQuery);$i++){
        $arrdateFBd=explode("-", $dataQuery[$i]['event_date']);
        $dateFBd=$arrdateFBd[2].".".$arrdateFBd[1].".".$arrdateFBd[0];
        $dataQuery[$i]['event_date']=$dateFBd;
    }

    array_unshift($dataQuery,['ind'=>count($dataQuery)]);
    $rowJsonFile=json_encode($dataQuery, JSON_UNESCAPED_UNICODE);
    file_put_contents('../ajax_json/user1Eve.json',$rowJsonFile);
    echo (json_encode($arrStr[6]));
    exit();
//    echo (json_encode("OK"));
}


