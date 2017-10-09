<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
//$nameSes=$_SESSION['gal'];
if(isset($_POST["textZ"])){
                                   // проверку + запись в файл по имени юзера
include ("../conBD_g.php");
$queryAll=mysqli_query($connBDsql,"SELECT `author_id`, `author_name`, `pers_name`, `pers_tel`, `pers_birth`, `author_biography`, `aut_prim`, `aut_napr` FROM `author` NATURAL JOIN `person`");
mysqli_close($connBDsql);
while ($queryAll_=mysqli_fetch_assoc($queryAll)){ //--------------------- перебираем результат запроса
    $dataQuery[]=$queryAll_; //------------------------------------------ собирает все строки запроса в масив
}

for ($i=0; $i<count($dataQuery);$i++){
    $arrdateFBd=explode("-", $dataQuery[$i]['pers_birth']);
    $dateFBd=$arrdateFBd[2].".".$arrdateFBd[1].".".$arrdateFBd[0];
    $dataQuery[$i]['pers_birth']=$dateFBd;
}

array_unshift($dataQuery,['ind'=>count($dataQuery)]);
$rowJsonFile=json_encode($dataQuery, JSON_UNESCAPED_UNICODE);//-- кодируем в JSON весь запрос
echo $rowJsonFile;
file_put_contents('../ajax_json/user1Aut.json',$rowJsonFile);//-- записываем в файл с именем юзера результат
exit();
}

if(isset($_GET["pAut"])){
include ("../conBD_g.php");
$queryAll=mysqli_query($connBDsql,"SELECT `author_name` FROM `author`");
mysqli_close($connBDsql);
    while ($queryAll_=mysqli_fetch_assoc($queryAll)){ //--------------------- перебираем результат запроса
        $dataQuery[]=$queryAll_; //------------------------------------------ собирает все строки запроса в масив
    }
    array_unshift($dataQuery,['ind'=>count($dataQuery)]);
    $rowJsonFile=json_encode($dataQuery, JSON_UNESCAPED_UNICODE);
echo $rowJsonFile;
}

if(isset($_POST["nowSub"])){
    $enter=$_POST['nowSub'];
    $arrAutN=explode('^',$enter);
    include ("../conBD_g.php");
    $query=mysqli_query($connBDsql,"INSERT INTO `author`(`author_name`, `person_id`, `aut_prim`, `aut_napr`) VALUES ('$arrAutN[0]','$arrAutN[1]','$arrAutN[2]','$arrAutN[3]')");
    $queryAll=mysqli_query($connBDsql,"SELECT `author_id`, `author_name`, `pers_name`, `pers_tel`, `pers_birth`, `author_biography`, `aut_prim`, `aut_napr` FROM `author` NATURAL JOIN `person` ORDER BY `author_id`");
    mysqli_close($connBDsql);
    while ($queryAll_=mysqli_fetch_assoc($queryAll)) {
        $dataQuery[] = $queryAll_;
    }

    for ($i=0; $i<count($dataQuery);$i++){
        $arrdateFBd=explode("-", $dataQuery[$i]['pers_birth']);
        $dateFBd=$arrdateFBd[2].".".$arrdateFBd[1].".".$arrdateFBd[0];
        $dataQuery[$i]['pers_birth']=$dateFBd;
    }

    array_unshift($dataQuery,['ind'=>count($dataQuery)]);
    $rowJsonFile=json_encode($dataQuery, JSON_UNESCAPED_UNICODE);
    file_put_contents('../ajax_json/user1Aut.json',$rowJsonFile);
    echo (count($dataQuery)-1);
    exit();
}

if(isset($_POST["del"])){
    $idBd = $_POST["del"];
    include ("../conBD_g.php");
    $query=mysqli_query($connBDsql,"DELETE FROM `author` WHERE `author`.`author_id` = '$idBd'");
    $queryAll=mysqli_query($connBDsql,"SELECT `author_id`, `author_name`, `pers_name`, `pers_tel`, `pers_birth`, `author_biography`, `aut_prim`, `aut_napr` FROM `author` NATURAL JOIN person ORDER BY `author_id`");
    mysqli_close($connBDsql);
    while ($queryAll_=mysqli_fetch_assoc($queryAll)) {
        $dataQuery[] = $queryAll_;
    }

    for ($i=0; $i<count($dataQuery);$i++){
        $arrdateFBd=explode("-", $dataQuery[$i]['pers_birth']);
        $dateFBd=$arrdateFBd[2].".".$arrdateFBd[1].".".$arrdateFBd[0];
        $dataQuery[$i]['pers_birth']=$dateFBd;
    }

    array_unshift($dataQuery,['ind'=>count($dataQuery)]);
    $rowJsonFile=json_encode($dataQuery, JSON_UNESCAPED_UNICODE);
    file_put_contents('../ajax_json/user1Aut.json',$rowJsonFile);
    echo (count($dataQuery)-1);
    exit();
}

if(isset($_POST["redSub"])){
    $str=$_POST["redSub"];
    $arrStr=explode('^', $str);
    include ("../conBD_g.php");
    $query=mysqli_query($connBDsql,"UPDATE `author` SET `author_name`='$arrStr[0]',`aut_prim`='$arrStr[2]',`aut_napr`='$arrStr[1]' WHERE `author_id`='$arrStr[4]'");
    $queryAll=mysqli_query($connBDsql,"SELECT `author_id`, `author_name`, `pers_name`, `pers_tel`, `pers_birth`, `author_biography`, `aut_prim`, `aut_napr` FROM `author` NATURAL JOIN `person`");
    mysqli_close($connBDsql);
    while ($queryAll_=mysqli_fetch_assoc($queryAll)){ //--------------------- перебираем результат запроса
        $dataQuery[]=$queryAll_; //------------------------------------------ собирает все строки запроса в масив
    }

    for ($i=0; $i<count($dataQuery);$i++){
        $arrdateFBd=explode("-", $dataQuery[$i]['pers_birth']);
        $dateFBd=$arrdateFBd[2].".".$arrdateFBd[1].".".$arrdateFBd[0];
        $dataQuery[$i]['pers_birth']=$dateFBd;
    }
    array_unshift($dataQuery,['ind'=>count($dataQuery)]);
    $rowJsonFile=json_encode($dataQuery, JSON_UNESCAPED_UNICODE);//-- кодируем в JSON весь запрос
    file_put_contents('../ajax_json/user1Aut.json',$rowJsonFile);//-- записываем в файл с именем юзера результат
    echo (json_encode($arrStr[3]));
    exit();
}