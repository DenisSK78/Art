<?php

function filterLP($inp){
    $inp=filter_var($inp,FILTER_SANITIZE_STRING); // удаляет теги
    $inp=filter_var($inp,FILTER_SANITIZE_MAGIC_QUOTES);  //экранирует спец символы
    return $inp;
}

function filterInt($intImp){
    $intImp=filter_var($intImp,FILTER_SANITIZE_NUMBER_INT);//удаляет всё кроме цифр
    return $intImp;
}

function clean($val){
    $val=trim($val);
    $val=stripcslashes($val);
    $val=strip_tags($val);
    return $val;
}

function sp_chars($val) {
    $val=htmlspecialchars($val);
    return $val;
}

function length_str($val, $min, $max){
    if( mb_strlen($val)<$min || mb_strlen($val)>$max ){
        return 0;}
    else {return 1;}
}

function email_check($val){
    $val=filter_var($val, FILTER_VALIDATE_EMAIL);
    return $val;
}

