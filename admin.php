<?php
header('Expires: Thu, 19 Feb 1990 13:24:18 GMT');
header('Last-Modified: '. gmdate('D, d M Y H:i:s').' GMT');
header('Cache-Control: no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0');
header('Cache-Control: max-age=0');
header('Pragma: no-cache');
header('Content-Type: text/html; charset=utf-8');
session_start();
$sss=$_SESSION['gal'];//-------------------------Разобраться
include "styleHtml/header.php";

?>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Администратор</title>
    <link href="style/jquery-ui.min.css" rel="stylesheet"/>
    <script src="javascript/jquery-3.2.1.min.js"></script>
    <script src="javascript/jquery-ui.min.js"></script>
    <link href="style/all_work_style.css" rel="stylesheet"/>
    <link href="formstyler/jquery.formstyler.css" rel="stylesheet" />
    <link href="formstyler/jquery.formstyler.theme.css" rel="stylesheet" />
    <script src="formstyler/jquery.formstyler.min.js"></script>
    <script src="javascript/jquery.validate.min.js"></script>
    <script>(function($){$(function(){ $('.styler').styler({ selectSearch: true});});})(jQuery);</script>
</head>
<body>
<div id="div_centerAdm">


    <div id="d1Adm" class="divAdm">
        <div class="nameBlockAdm">Пользователи</div>
        <div class="workAdm">

            <div id="insAdm"><br>
        Добавление нового пользователя:<br><br>
            <input type="text" id="logAdmNU" title="Логин" placeholder="Логин.."><br>
            <input type="text" id="pasAdmNU" title="Пароль" placeholder="Пароль..">
            <input type="button" id="insAdmNUbut" value="Добавить" class="button">
                <br><br>
            </div>
            <div id="delAdm">
            <input type="button"  id="delAdmNUbut" value="Удалить"  class="button">
            </div>
        </div>
    </div>

    <div id="d2Adm" class="divAdm">
        <div class="nameBlockAdm">Работа с базой</div>
        <div id="workAdm">
            <br>Выбирите подменю:<br><br>
            <select class="box" id="vidFBd" title="">
                <option value="0">Выбор...</option>
                <option value="1">Вид объекта</option>
                <option value="2">Материал</option>
                <option value="3">Авторы направление</option>
                <option value="4">Мероприятия вид</option>
            </select>
            <input type="button"  id="ViborPMbut" value="Выбрать"  class="button"><br><br>
        </div>

        <div id="workAdm2"></div>
        <div id="workAdm3"></div>

    </div>
    <input type="button"  id="vixodAdmin" value="Выход"  class="button"><br><br>
</div>

<div class="modal_form" style="display: none; top: 45%; opacity: 0;">
    <form action="" id="formRD" method="POST" onsubmit="">
        <div id="secondMod"></div>
        <div id="thirdMod">
            <div id="admModDiv1">
                Удалить подменю:<br><br>
            <select id="ModVib" title=""></select>
                <input type="button"  id="DelPodm" value="Удалить"  class="button"><br><br><hr>
                Добавить новое подменю:<br><br>
                <input type="text" id="PodmN" title="" placeholder="Ввод..">
                <input type="button"  id="DobPodm" value="Добавить"  class="button"><br><br>
            </div>
        </div>
    </form>
    <input type="button"  id="vixodAdmin2" value="Выход"  class="button"><br><br>
</div>
<div id="overlay"></div>


</body>
</html>

<script>
    exitMod();
    function exitMod() {
        $('#overlay, #butBack').click(function () {
            $('.modal_form').animate({opacity: 0, top: '45%'}, 200,
                function () {
                    $(this).css('display', 'none');
                    $('#overlay').fadeOut(400);
                    $(location).attr('href','admin.php');
                }
            );
        });
    }


    var viborPod;
    var indViborPod;
    $('#ModVib').selectmenu({
        width: 335,
        change: function (event, ui) {
            viborPod=ui.item.label;
            indViborPod=ui.item.value;
        }
    });

    $('#insAdmNUbut').on('click',function () {

        if (($('#logAdmNU').val().length>5 && $('#logAdmNU').val().length<20) && (($('#pasAdmNU').val().length>5 && $('#pasAdmNU').val().length<20))){
            var logg=$('#logAdmNU').val();
            var pass=$('#pasAdmNU').val();
            var dataSs=logg+'^'+pass;
            $.ajax({
                url: "pages/adminW.php",
                type: "POST",
                data: {dataS: dataSs},
                dataType: "json",
                success: funIns
            });
            $('#logAdmNU').val('');
            $('#pasAdmNU').val('');
        }
        else alert("Вводите от 5 до 20 символов !");
    });

    function funIns() {
        alert("Сохранено !");
        $(location).attr('href','admin.php');
    }

    $.ajax({
        url: "pages/adminW.php",
        type: "POST",
        data: {dataUS: "1"},
        dataType: "json",
        success: doSel

    });

    function doSel(data){
        fSel=(Object.keys(data).length);
        strSel="<option value='0'>Выбор...</option>";
        for (i=0; i<fSel; i++){
            val=i+1;
            strSel=strSel+"<option value='"+val+"'>"+data[+i][0]+"</option>";
        }
        $("<br>Удаление пользователя:<br><br><br><br><select class='box' id='userDel' title=''></select>").prependTo('#delAdm');
        $(strSel).prependTo('#userDel');
        $('#userDel').selectmenu({
            width: 335,
            change: function (event, ui) {
                del=ui.item.label;
            }
        });
    }

    var del;

    $('#delAdmNUbut').on('click', function () {
        if(del==="admin") alert("Нельзя удалить !!! admin");
        else {
            $.ajax({
                url: "pages/adminW.php",
                type: "POST",
                data: {dataDel: del},
                dataType: "json",
                success: delAnsw
            });
        }
    });

    function delAnsw(data) {
        alert("Удалено !");
        $(location).attr('href','admin.php');
    }

    var vibor;

    $('#vidFBd').selectmenu({
        width: 335,
        change: function (event, ui) {
            vibor=ui.item.label;
        }
    });

    $('#ViborPMbut').on('click', function () {
//        $.getJSON('ajax_json/jsonBD.json', function (data) {
        $.getJSON(url('ajax_json/jsonBD.json'), function (data) {
            var podm;
            switch (vibor){
                case "Вид объекта": podm = "objVid"; break;
                case "Материал": podm = "objMat"; break;
                case "Авторы направление": podm = "autNap"; break;
                case "Мероприятия вид": podm = "eveVid"; break;
                default: alert("Вы не сделали выбор!");
            }

            $('#overlay').fadeIn(400,function () {
                $('.modal_form').css('display', 'block').animate({opacity: 1, top: '50%'}, 250);
                nSel=(Object.keys(data[podm]).length);
                var nSelNap="<option value='0'>Выбор..</option>";
                var ind;
                for (i=0; i<nSel;i++){
                   ind=+i+1;
                   nSelNap=nSelNap+"<option value='"+ind+"'>"+data[podm][i]+"</option>"
                }
                $(nSelNap).prependTo('#ModVib');

                exitMod();

            });
        })
    });

    $('#DelPodm').on('click', function () {
        var podm;
        switch (vibor){
            case "Вид объекта": podm = "objVid"; break;
            case "Материал": podm = "objMat"; break;
            case "Авторы направление": podm = "autNap"; break;
            case "Мероприятия вид": podm = "eveVid"; break;
            default: alert("Вы не сделали выбор!");
        }
        var DelPodm=podm+"^"+viborPod+"^"+indViborPod;
//        alert(DelPodm);
        $.ajax({
            url: "pages/adminW.php",
            type: "POST",
            data: {delPodm: DelPodm},
            dataType: "json",
            success: afterDel
        });
//        $('#ModVib').empty();
//        $("<option value='0'>Выбор..</option>").prependTo('#ModVib')
//        $(location).attr('href','admin.php');
    });
    
    function afterDel() {
        $('#ModVib').empty();
        $(location).attr('href','admin.php');
    }

    $('#vixodAdmin').on('click', function () {
        $(location).attr('href','index.php');
    });

    $('#vixodAdmin2').on('click', function () {
        $(location).attr('href','admin.php');
    });

    $('#DobPodm').on('click',function () {
    var ent;
    ent= $('#PodmN').val();
    if(ent.length<1)alert("Вы не сделали ввод !")
        else {
        var podMN;
        switch (vibor){
            case "Вид объекта": podm = "objVid"; break;
            case "Материал": podm = "objMat"; break;
            case "Авторы направление": podm = "autNap"; break;
            case "Мероприятия вид": podm = "eveVid"; break;
            default: alert("Вы не сделали выбор!");
        }
        podMN=podm+"^"+ent;
        $.ajax({
            url: "pages/adminW.php",
            type: "POST",
            data: {dobPodm: podMN},
            dataType: "json",
            success: afterDob
        })
    }
    });

    function afterDob(data) {
        $('#ModVib').empty();
        $(location).attr('href','admin.php');
    }

    function url(url){
        var addA=Math.floor((Math.random() * 100) + 1);
        url=url+"?v="+addA;
        return url;
    }
</script>


