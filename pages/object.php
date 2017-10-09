<?php
session_start();
//$nameSes=$_SESSION['gal'];
if(isset($_POST["textZ"])){
    // проверку + запись в файл по имени юзера
    include ("../conBD_g.php");
    $queryAll=mysqli_query($connBDsql,"SELECT `subj_id`, `subj_name`, `subj_b_date`, `subj_razmX`, `subj_razmY`, `subj_razmZ`, `author_name`, `subj_mat`, `subj_vid`, `subj_prim` FROM `subjects` NATURAL JOIN author ORDER BY `subj_id`");
    mysqli_close($connBDsql);
    while ($queryAll_=mysqli_fetch_assoc($queryAll)){ //--------------------- перебираем результат запроса
        $dataQuery[]=$queryAll_; //------------------------------------------ собирает все строки запроса в масив
    }
    array_unshift($dataQuery,['ind'=>count($dataQuery)]);
    $rowJsonFile=json_encode($dataQuery, JSON_UNESCAPED_UNICODE);//-- кодируем в JSON весь запрос
    echo $rowJsonFile;
    file_put_contents('../ajax_json/user1Obj.json',$rowJsonFile);//-- записываем в файл с именем юзера результат
    exit();
}

if(isset($_POST["nowSub"])){

    $postObjN=$_POST["nowSub"];
    $arrObjN=explode('^',$postObjN);
    include ("../conBD_g.php");
    $queryAllS=mysqli_query($connBDsql,"SELECT `author_id` FROM `author` WHERE `author_name`='$arrObjN[5]'");
    $idAut=mysqli_fetch_row($queryAllS); //$idAut[0];
    $queryAllRobj=mysqli_query($connBDsql,"INSERT INTO `subjects`(`subj_name`, `subj_b_date`, `subj_razmX`, `subj_razmY`, `subj_razmZ`, `author_id`, `subj_mat`, `subj_vid`, `subj_prim`) VALUES ('$arrObjN[0]','$arrObjN[4]','$arrObjN[3]','$arrObjN[7]','$arrObjN[8]','$idAut[0]','$arrObjN[2]','$arrObjN[1]','$arrObjN[6]');");
    $queryAll=mysqli_query($connBDsql,"SELECT `subj_id`, `subj_name`, `subj_b_date`, `subj_razmX`, `subj_razmY`, `subj_razmZ`, `author_name`, `subj_mat`, `subj_vid`, `subj_prim` FROM `subjects` NATURAL JOIN author ORDER BY `subj_id`");
    mysqli_close($connBDsql);
    while ($queryAll_=mysqli_fetch_assoc($queryAll)){ //--------------------- перебираем результат запроса
        $dataQuery[]=$queryAll_; //------------------------------------------ собирает все строки запроса в масив
    }
    array_unshift($dataQuery,['ind'=>count($dataQuery)]);
    $rowJsonFile=json_encode($dataQuery, JSON_UNESCAPED_UNICODE);//-- кодируем в JSON весь запрос
    file_put_contents('../ajax_json/user1Obj.json',$rowJsonFile);//-- записываем в файл с именем юзера результат
    $colvo=count($dataQuery)-1;
    $arr=[];
    array_unshift($arr,['ind'=>$colvo]);
    $send=json_encode($arr, JSON_UNESCAPED_UNICODE);
    echo count($dataQuery)-1;

    exit();
}

if(isset($_POST["reqAllobj"])){
    include ("../conBD_g.php");
    $queryAll=mysqli_query($connBDsql,"SELECT `subj_id`, `subj_name`, `subj_b_date`, `subj_razmX`, `subj_razmY`, `subj_razmZ`, `author_name`, `subj_mat`, `subj_vid`, `subj_prim` FROM `subjects` NATURAL JOIN author ORDER BY `subj_id`");
    mysqli_close($connBDsql);
    while ($queryAll_=mysqli_fetch_assoc($queryAll)){ //--------------------- перебираем результат запроса
        $dataQuery[]=$queryAll_; //------------------------------------------ собирает все строки запроса в масив
    }
    array_unshift($dataQuery,['ind'=>count($dataQuery)]);
    $rowJsonFile=json_encode($dataQuery, JSON_UNESCAPED_UNICODE);//-- кодируем в JSON весь запрос
    echo $rowJsonFile;
    file_put_contents('../ajax_json/user1Obj.json',$rowJsonFile);//-- записываем в файл с именем юзера результат
    exit();
}

if(isset($_POST["reqObjMat"])){
    $mat=$_POST["reqObjMat"];
    include ("../conBD_g.php");
    $queryAll=mysqli_query($connBDsql,"SELECT `subj_id`, `subj_name`, `subj_b_date`, `subj_razmX`, `subj_razmY`, `subj_razmZ`, `author_name`, `subj_mat`, `subj_vid`, `subj_prim` FROM `subjects` NATURAL JOIN author ORDER BY `subj_id`");
    mysqli_close($connBDsql);
    while ($queryAll_=mysqli_fetch_assoc($queryAll)){ //--------------------- перебираем результат запроса
        $dataQuery[]=$queryAll_; //------------------------------------------ собирает все строки запроса в масив
    }

    $lengthArr=count($dataQuery);
    $dataQuery2=[];
    for ($i=0; $i<$lengthArr; $i++){
        if ($dataQuery[$i]['subj_mat']===$mat){
            $dataQuery2[$i]=$dataQuery[$i];
        }
    }
    array_unshift($dataQuery2,['ind'=>count($dataQuery2)]);
    $rowJsonFile=json_encode($dataQuery2, JSON_UNESCAPED_UNICODE);//-- кодируем в JSON весь запрос
    echo $rowJsonFile;
    exit();
}

if(isset($_POST["reqObjAut"])){
    $aut=$_POST["reqObjAut"];
    include ("../conBD_g.php");
    $queryAll=mysqli_query($connBDsql,"SELECT `subj_id`, `subj_name`, `subj_b_date`, `subj_razmX`, `subj_razmY`, `subj_razmZ`, `author_name`, `subj_mat`, `subj_vid`, `subj_prim` FROM `subjects` NATURAL JOIN author ORDER BY `subj_id`");
    mysqli_close($connBDsql);
    while ($queryAll_=mysqli_fetch_assoc($queryAll)){
        $dataQuery[]=$queryAll_;
    }
    $lengthArr=count($dataQuery);
    $dataQuery2=[];
    for ($i=0; $i<$lengthArr; $i++){
        if ($dataQuery[$i]['author_name']===$aut){
            $dataQuery2[$i]=$dataQuery[$i];
        }
    }
    array_unshift($dataQuery2,['ind'=>count($dataQuery2)]);
    $rowJsonFile=json_encode($dataQuery2, JSON_UNESCAPED_UNICODE);
    echo $rowJsonFile;
    exit();
}

if(isset($_POST["reqObjVid"])){
    $vid=$_POST["reqObjVid"];
    include ("../conBD_g.php");
    $queryAll=mysqli_query($connBDsql,"SELECT `subj_id`, `subj_name`, `subj_b_date`, `subj_razmX`, `subj_razmY`, `subj_razmZ`, `author_name`, `subj_mat`, `subj_vid`, `subj_prim` FROM `subjects` NATURAL JOIN author ORDER BY `subj_id`");
    mysqli_close($connBDsql);
    while ($queryAll_=mysqli_fetch_assoc($queryAll)){
        $dataQuery[]=$queryAll_;
    }
    $lengthArr=count($dataQuery);
    $dataQuery2=[];
    for ($i=0; $i<$lengthArr; $i++){
        if ($dataQuery[$i]['subj_vid']===$vid){
            $dataQuery2[$i]=$dataQuery[$i];
        }
    }
    array_unshift($dataQuery2,['ind'=>count($dataQuery2)]);
    $rowJsonFile=json_encode($dataQuery2, JSON_UNESCAPED_UNICODE);
    echo $rowJsonFile;
    exit();
}

if(isset($_POST["del"])){
    $idBd = $_POST["del"];
    include ("../conBD_g.php");
    $query=mysqli_query($connBDsql,"DELETE FROM `subjects` WHERE `subj_id`='$idBd';");
    $queryAll=mysqli_query($connBDsql,"SELECT `subj_id`, `subj_name`, `subj_b_date`, `subj_razmX`, `subj_razmY`, `subj_razmZ`, `author_name`, `subj_mat`, `subj_vid`, `subj_prim` FROM `subjects` NATURAL JOIN author ORDER BY `subj_id`");
    mysqli_close($connBDsql);
    while ($queryAll_=mysqli_fetch_assoc($queryAll)){ //--------------------- перебираем результат запроса
        $dataQuery[]=$queryAll_; //------------------------------------------ собирает все строки запроса в масив
    }
    array_unshift($dataQuery,['ind'=>count($dataQuery)]);
    $rowJsonFile=json_encode($dataQuery, JSON_UNESCAPED_UNICODE);//-- кодируем в JSON весь запрос
    file_put_contents('../ajax_json/user1Obj.json',$rowJsonFile);//-- записываем в файл с именем юзера результат
    echo count($dataQuery)-1;
    exit();
}

if(isset($_POST["redSub"])){
    $str=$_POST["redSub"];
    $arrStr=explode('^', $str);
    include ("../conBD_g.php");

    $queryAllS=mysqli_query($connBDsql,"SELECT `author_id` FROM `author` WHERE `author_name`='$arrStr[6]'");
    $idAut=mysqli_fetch_row($queryAllS); //$idAut[0];
    $query=mysqli_query($connBDsql,"UPDATE `subjects` SET `subj_name`='$arrStr[0]',`subj_b_date`='$arrStr[7]',`subj_razmX`='$arrStr[3]',`subj_razmY`='$arrStr[4]',`subj_razmZ`='$arrStr[5]',`author_id`='$idAut[0]',`subj_mat`='$arrStr[2]',`subj_vid`='$arrStr[1]',`subj_prim`='$arrStr[8]' WHERE `subj_id`='$arrStr[9]';");

    $queryAll=mysqli_query($connBDsql,"SELECT `subj_id`, `subj_name`, `subj_b_date`, `subj_razmX`, `subj_razmY`, `subj_razmZ`, `author_name`, `subj_mat`, `subj_vid`, `subj_prim` FROM `subjects` NATURAL JOIN author ORDER BY `subj_id`");
    mysqli_close($connBDsql);
    while ($queryAll_=mysqli_fetch_assoc($queryAll)){ //--------------------- перебираем результат запроса
        $dataQuery[]=$queryAll_; //------------------------------------------ собирает все строки запроса в масив
    }
    array_unshift($dataQuery,['ind'=>count($dataQuery)]);
    $rowJsonFile=json_encode($dataQuery, JSON_UNESCAPED_UNICODE);//-- кодируем в JSON весь запрос
    file_put_contents('../ajax_json/user1Obj.json',$rowJsonFile);//-- записываем в файл с именем юзера результат
    echo (json_encode($arrStr[10]));
    exit();

//    echo (json_encode("OK"));
}