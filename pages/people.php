<?php
//session_start();
//$nameSes=$_SESSION['gal'];
if(isset($_POST["textZ"])){
    include ("../conBD_g.php");

    $queryAll=mysqli_query($connBDsql,"SELECT * FROM `person`");
    mysqli_close($connBDsql);
    while ($queryAll_=mysqli_fetch_assoc($queryAll)){
        $dataQuery[]=$queryAll_;
    }

    for ($i=0; $i<count($dataQuery);$i++){
        $arrdateFBd=explode("-", $dataQuery[$i]['pers_birth']);
        $dateFBd=$arrdateFBd[2].".".$arrdateFBd[1].".".$arrdateFBd[0];
        $dataQuery[$i]['pers_birth']=$dateFBd;
    }

    array_unshift($dataQuery,['ind'=>count($dataQuery)]);
    $rowJsonFile=json_encode($dataQuery, JSON_UNESCAPED_UNICODE);
    echo $rowJsonFile;
    file_put_contents("../ajax_json/user1Aud.json",$rowJsonFile);
    exit();
}

if(isset($_POST["reqAllaud"])){
    include ("../conBD_g.php");

    $queryAll=mysqli_query($connBDsql,"SELECT * FROM `person`");
    mysqli_close($connBDsql);
    while ($queryAll_=mysqli_fetch_assoc($queryAll)){
        $dataQuery[]=$queryAll_;
    }

    for ($i=0; $i<count($dataQuery);$i++){
        $arrdateFBd=explode("-", $dataQuery[$i]['pers_birth']);
        $dateFBd=$arrdateFBd[2].".".$arrdateFBd[1].".".$arrdateFBd[0];
        $dataQuery[$i]['pers_birth']=$dateFBd;
    }

    array_unshift($dataQuery,['ind'=>count($dataQuery)]);
    $rowJsonFile=json_encode($dataQuery, JSON_UNESCAPED_UNICODE);
    echo $rowJsonFile;
    file_put_contents("../ajax_json/user1Aud.json",$rowJsonFile);
    exit();
//    echo (json_encode('Ok!'));
}

if(isset($_POST["reqBerthAud"])){
    $today=date("m-d");
    $today30=date('m-d', strtotime(date("Y-m-d")) + 30 * 24 * 3600);

    include ("../conBD_g.php");
    $queryAll=mysqli_query($connBDsql,"SELECT * FROM `person` WHERE DATE_FORMAT( `pers_birth` , '%m-%d') > '$today' AND DATE_FORMAT( `pers_birth` , '%m-%d') < '$today30'");

    mysqli_close($connBDsql);
    while ($queryAll_=mysqli_fetch_assoc($queryAll)){
        $dataQuery[]=$queryAll_;
    }

    for ($i=0; $i<count($dataQuery);$i++){
        $arrdateFBd=explode("-", $dataQuery[$i]['pers_birth']);
        $dateFBd=$arrdateFBd[2].".".$arrdateFBd[1].".".$arrdateFBd[0];
        $dataQuery[$i]['pers_birth']=$dateFBd;
    }

    $rowJsonFile=json_encode($dataQuery, JSON_UNESCAPED_UNICODE);
    echo $rowJsonFile;
}

if(isset($_POST["nowSub"])){
    $enter=$_POST['nowSub'];
    $arrAudN=explode('^',$enter);
    include ("../conBD_g.php");

    $arrdateFBd=explode(".",$arrAudN[2]);
    $dateFBd=$arrdateFBd[2].'/'.$arrdateFBd[1].'/'.$arrdateFBd[0];

    $query=mysqli_query($connBDsql,"INSERT INTO `person`(`pers_name`, `pers_sex`, `pers_birth`, `pers_tel`, `pers_email`, `pers_adres`, `pers_con_phone`, `pers_con_email`, `pers_con_vib`, `pers_con_whats`, `pers_con_telegr`, `pers_con_mesen`, `pers_prim`) VALUES ('$arrAudN[0]','$arrAudN[1]','$dateFBd','$arrAudN[3]','$arrAudN[4]','$arrAudN[5]','$arrAudN[6]','$arrAudN[7]','$arrAudN[8]','$arrAudN[9]','$arrAudN[10]','$arrAudN[11]','$arrAudN[12]');");
    $queryAll=mysqli_query($connBDsql,"SELECT * FROM `person`");
    mysqli_close($connBDsql);
    while ($queryAll_=mysqli_fetch_assoc($queryAll)){
        $dataQuery[]=$queryAll_;
    }

    for ($i=0; $i<count($dataQuery);$i++){
        $arrdateFBd=explode("-", $dataQuery[$i]['pers_birth']);
        $dateFBd=$arrdateFBd[2].".".$arrdateFBd[1].".".$arrdateFBd[0];
        $dataQuery[$i]['pers_birth']=$dateFBd;
    }

    array_unshift($dataQuery,['ind'=>count($dataQuery)]);
    $rowJsonFile=json_encode($dataQuery, JSON_UNESCAPED_UNICODE);
    file_put_contents("../ajax_json/user1Aud.json",$rowJsonFile);
    echo json_encode(count($dataQuery)-1);
    exit();
}

if(isset($_POST["del"])){
    $idBd = $_POST["del"];
    include ("../conBD_g.php");
    $query=mysqli_query($connBDsql,"DELETE FROM `person` WHERE `person`.`person_id` = '$idBd'");
    $queryAll=mysqli_query($connBDsql,"SELECT * FROM `person`");
    mysqli_close($connBDsql);
    while ($queryAll_=mysqli_fetch_assoc($queryAll)){
        $dataQuery[]=$queryAll_;
    }

    for ($i=0; $i<count($dataQuery);$i++){
        $arrdateFBd=explode("-", $dataQuery[$i]['pers_birth']);
        $dateFBd=$arrdateFBd[2].".".$arrdateFBd[1].".".$arrdateFBd[0];
        $dataQuery[$i]['pers_birth']=$dateFBd;
    }

    array_unshift($dataQuery,['ind'=>count($dataQuery)]);
    $rowJsonFile=json_encode($dataQuery, JSON_UNESCAPED_UNICODE);
    file_put_contents("../ajax_json/user1Aud.json",$rowJsonFile);
    echo count($dataQuery)-1;
    exit();
}

if(isset($_POST["reqConAud"])){
    $idConn=$_POST["reqConAud"];
    $arrIdConn=explode('^',$idConn);
    for($i=0; $i<6; $i++){
        if($arrIdConn[$i]==1){
            $first=$i;
            $arrIdConn[$i]=0;
            break;
        }
    }
    switch ($first){
        case 0: $query="SELECT * FROM `person` WHERE `pers_con_phone`=1"; break;
        case 1: $query="SELECT * FROM `person` WHERE `pers_con_email`=1"; break;
        case 2: $query="SELECT * FROM `person` WHERE `pers_con_vib`=1"; break;
        case 3: $query="SELECT * FROM `person` WHERE `pers_con_whats`=1"; break;
        case 4: $query="SELECT * FROM `person` WHERE `pers_con_telegr`=1"; break;
        case 5: $query="SELECT * FROM `person` WHERE `pers_con_mesen`=1"; break;
    }
    if($arrIdConn[1]==1) $query=$query." AND `pers_con_email`=1";
    if($arrIdConn[2]==1) $query=$query." AND `pers_con_vib`=1";
    if($arrIdConn[3]==1) $query=$query." AND `pers_con_whats`=1";
    if($arrIdConn[4]==1) $query=$query." AND `pers_con_telegr`=1";
    if($arrIdConn[5]==1) $query=$query." AND `pers_con_mesen`=1";
    include ("../conBD_g.php");
    $queryAll=mysqli_query($connBDsql,$query);
    mysqli_close($connBDsql);
    while ($queryAll_=mysqli_fetch_assoc($queryAll)){
        $dataQuery[]=$queryAll_;
    }
    if(count($dataQuery)==0){
            echo (json_encode("0"));
            exit();
    }
    else {
        array_unshift($dataQuery, ['ind' => count($dataQuery)]);
        $rowJsonFile = json_encode($dataQuery, JSON_UNESCAPED_UNICODE);
        echo $rowJsonFile;
        exit();
//    echo (json_encode("$query"));
    }
}

if(isset($_POST["redSub"])){
    $str=$_POST["redSub"];
    $arrStr=explode('^', $str);
    include ("../conBD_g.php");

    $arrdateFBd=explode(".",$arrStr[2]);
    $dateFBd=$arrdateFBd[2].'/'.$arrdateFBd[1].'/'.$arrdateFBd[0];

    $queryAll=mysqli_query($connBDsql, "UPDATE `person` SET `pers_name`='$arrStr[0]',`pers_sex`='$arrStr[1]',`pers_birth`='$dateFBd',`pers_tel`='$arrStr[3]',`pers_email`='$arrStr[4]',`pers_adres`='$arrStr[5]',`pers_con_phone`='$arrStr[6]',`pers_con_email`='$arrStr[7]',`pers_con_vib`='$arrStr[8]',`pers_con_whats`='$arrStr[9]',`pers_con_telegr`='$arrStr[10]',`pers_con_mesen`='$arrStr[11]',`pers_prim`='$arrStr[12]' WHERE  `person_id`='$arrStr[13]';");

    $queryAll=mysqli_query($connBDsql,"SELECT * FROM `person`");
    mysqli_close($connBDsql);
    while ($queryAll_=mysqli_fetch_assoc($queryAll)){
        $dataQuery[]=$queryAll_;
    }

    for ($i=0; $i<count($dataQuery);$i++){
        $arrdateFBd=explode("-", $dataQuery[$i]['pers_birth']);
        $dateFBd=$arrdateFBd[2].".".$arrdateFBd[1].".".$arrdateFBd[0];
        $dataQuery[$i]['pers_birth']=$dateFBd;
    }

    array_unshift($dataQuery,['ind'=>count($dataQuery)]);
    $rowJsonFile=json_encode($dataQuery, JSON_UNESCAPED_UNICODE);
    file_put_contents("../ajax_json/user1Aud.json",$rowJsonFile);
    echo (json_encode($arrStr[14]));
    exit();
//    echo (json_encode("OK"));
}


