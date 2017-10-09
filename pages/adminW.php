<?php
header('Content-Type: text/html; charset=utf-8');


if(isset($_POST["dataS"])){

    $dataS=$_POST["dataS"];
    $arrDataS=explode("^", $dataS);

    $sol="sol";
    $loggi= $arrDataS[0];
    $possw= $arrDataS[1];

    function Hash1($a, $b, $c)
    {
        $nikPasF = $a . $b . $c;
        $hash = password_hash($nikPasF, PASSWORD_BCRYPT);
        return $hash;
    }

    $str_hash = Hash1($sol, $loggi, $possw);

    include "../conBD_g.php";

    $query= mysqli_query($connBDsql, "INSERT INTO `logg_pass`(`lg_logg`, `lg_pass`) VALUES ('$loggi','$str_hash')");


    if ($query) {
        $answ='{"tut"=>"Сохранено"}';
        $answ=json_encode($answ, JSON_UNESCAPED_UNICODE);
        echo $answ;
    } else {
        echo "Гдето бяда :(";
    }
    mysqli_close($connBDsql);
    exit();
}

if(isset($_POST["dataUS"])){
    include "../conBD_g.php";

    $query=mysqli_query($connBDsql, "SELECT `lg_logg` FROM `logg_pass` ");
    while ($queryAll=mysqli_fetch_array($query)){
        $arrQuery[]=$queryAll;
    }

    $JsonFile=json_encode($arrQuery, JSON_UNESCAPED_UNICODE);
    echo $JsonFile;
    mysqli_close($connBDsql);
    exit();
}

if(isset($_POST["dataDel"])){
    include "../conBD_g.php";

    $del=$_POST["dataDel"];

    $query=mysqli_query($connBDsql, "DELETE FROM `logg_pass` WHERE `lg_logg`='$del'");

    $answ='{"tut"=>"Удалено"}';
    $answ=json_encode($answ, JSON_UNESCAPED_UNICODE);
    echo $answ;
    mysqli_close($connBDsql);
    exit();
}

if(isset($_POST["delPodm"])){
    $arrDelPodm=explode("^", $_POST["delPodm"]);
    $json=file_get_contents("../ajax_json/jsonBD.json");
    $decJson=json_decode($json,true);

    $idex=$arrDelPodm[2]-1;
    unset($decJson[$arrDelPodm[0]][$idex]);
    sort($decJson[$arrDelPodm[0]]);
//    print_r($decJson);
    $strjson = json_encode($decJson, JSON_UNESCAPED_UNICODE);
    file_put_contents("../ajax_json/jsonBD.json", $strjson);
    echo (json_encode('Ok!'));
    exit();
}

if(isset($_POST["dobPodm"])){

    $arrDopPodm=explode("^", $_POST["dobPodm"]);
    $json=file_get_contents("../ajax_json/jsonBD.json");
    $decJsonD=json_decode($json,true);

    $arrCount=count($decJsonD[$arrDopPodm[0]]);
    $decJsonD[$arrDopPodm[0]][$arrCount]=$arrDopPodm[1];

//    print_r($arrDopPodm);
    $strjsonD=json_encode($decJsonD, JSON_UNESCAPED_UNICODE);
    file_put_contents("../ajax_json/jsonBD.json", $strjsonD);
    echo (json_encode('Ok!'));
    exit();
}