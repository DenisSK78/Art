<?php
header('Content-Type: text/html; charset=utf-8');
if((empty($_POST['log_']))||(empty($_POST['pass_']))){
    redirect_();
}
$logLP=$_POST['log_'];
$pasLP=$_POST['pass_'];


include 'fil.php';
$logLP=for_fil($logLP);
$pasLP=for_fil($pasLP);
$logLP_long=length_str($logLP,5,20);
$pasLP_long=length_str($pasLP,5,20);
$sol="sol";
//----------------------------------------------------------разобраться
if(($logLP_long==1)&&($pasLP_long==1)) {                  //если длинна норм
    include 'conBD_g.php';
    $query=mysqli_query($connBDsql,"SELECT lg_logg, lg_pass FROM logg_pass WHERE lg_logg='$logLP';");
    $row=mysqli_fetch_row($query);
    mysqli_close($connBDsql);
    if(empty($row)){                                      //не найден в бд
        redirect_();
    }

    $checkLP=$sol.$logLP.$pasLP;
    if (password_verify($checkLP,$row[1])) {              //вериф.
        if($logLP=='admin'){
            header("location: admin.php");
            exit();
        }
        session_start();
        $_SESSION['gal']="$logLP";
        setcookie("name",$logLP, time() +1800);
        header("location: firstP.php");
    }
    else redirect_();                                     //ненайдено совпадение Л-П.
}
else redirect_();                                         //если что то короче
function redirect_(){
    session_start();
    $_SESSION['d']='1';
    header("location: index.php");
    exit();
}
function for_fil($str_enter){
    $str_enter=clean($str_enter);
    $str_enter=sp_chars($str_enter);
    return($str_enter);
}
