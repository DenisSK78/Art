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
    <title>Меню</title>
    <link href="style/jquery-ui.min.css" rel="stylesheet"/>
    <script src="javascript/jquery-3.2.1.min.js"></script>
    <script src="javascript/jquery-ui.min.js"></script>
    <link href="style/all_work_style.css" rel="stylesheet"/>
    <link href="formstyler/jquery.formstyler.css" rel="stylesheet" />
    <link href="formstyler/jquery.formstyler.theme.css" rel="stylesheet" />
    <link href="style/jquery.dataTables.min.css" rel="stylesheet"/>
    <script src="formstyler/jquery.formstyler.min.js"></script>
    <script src="javascript/jquery.maskedinput.min.js"></script>
    <script src="javascript/jquery.dataTables.min.js"></script>
    <script>(function($){$(function(){ $('.styler').styler({ selectSearch: true});});})(jQuery);</script>
</head>
<body>
<div id="div_center">
    <div id="all6div">
    <div class="firstPD" id="d1">Аудитория</div>
    <div class="firstPD" id="d2">Авторы</div>
    <div class="firstPD" id="d3">Объекты</div>
    <div class="firstPD" id="d4">Мероприятия</div>
    <div class="firstPD" id="d6">Запросы</div>
    <div class="firstPD" id="exit">Выход</div>
    </div>
    <input type="hidden" name="nambP" id="nambP" value="">
    <input type="hidden" name="nambPMax" id="nambPMax" value="">
    <input type="hidden" name="json" id="rezerv" value="">
    <div id="secondGL"><div id="second"></div><div id="search"></div></div>
    <div id="third"></div>
    <div id="dilog"></div>
</div>

<div class="modal_form" style="display: none; top: 45%; opacity: 0;" id="modal">
    <form action="" id="formRD" method="POST" onsubmit="">
        <div id="secondMod"></div>
        <div id="thirdMod"></div>
    </form>
</div>
<div id="overlay"></div>
</body>
</html>
<script>

    $('#third').attr({style : "background: url( picture/first.jpg) no-repeat center center fixed;"});

    function url(url){
        var addA=Math.floor((Math.random() * 100) + 1);
        url=url+"?v="+addA;
        return url;
    }

    function dilogDel(){
        $('#dilog').empty();
        $('<p>Вы действительно хотите удалить запись?</p><input type="button" class="button" value="Да" id="Yes"><input type="button" class="button" value="Нет" id="No">').prependTo('#dilog');
        $('#dilog').dialog();
        $('#No').on('click', function(){
            $('#dilog').dialog('close').empty();
        })
    }

    function contFChet(indexID,data) {
        $('#nambPMax').attr({value: data[0]['ind']});
        $('#nambP').attr({value: indexID});
        $("#drob").text(indexID+'/');
        $("#drob2").text(data[0]['ind']);
    }

    function button(batVal, marg, id) {
        var inpBut = "<input type='button' class='button' id='"+id+"' style='margin-left: "+marg+"' value='"+batVal+"'>";
        $(inpBut).prependTo('div #fourth');
    }

    function buttonMod(batVal, marg, id) {
        var inpBut = "<input type='button' class='button' id='"+id+"' style='margin-left: "+marg+"' value='"+batVal+"'>";
        $(inpBut).prependTo('div #fourthMod');
    }

    function content3div(nom) {
        $('#third').empty();
        var inpRazmetka = "<div class='div3_v"+nom+"' id='d1r'></div> <div class='div3_v"+nom+"' id='d2r'></div>  <div class='div3_v"+nom+"' id='d3r'></div> <div class='div3_v"+nom+"' id='d4r'></div> <div class='div3_v"+nom+"' id='d5r'><div id='drob'></div><div id='drob2'></div></div>  <div class='div3_v"+nom+"' id='d6r'></div> <div class='div3_v"+nom+"' id='d7r'></div>";
        $(inpRazmetka).prependTo('div #third');
    }

    function content3divMod(nom) {
        $('#thirdMod').empty();
        var inpRazmetka = "" +
            "<div class='div3_v"+nom+"' id='d1rMod'></div> <div class='div3_v"+nom+"' id='d2rMod'></div>" +
            "<div class='div3_v"+nom+"' id='d3rMod'></div> <div class='div3_v"+nom+"' id='d4rMod'></div>" +
            "<div class='div3_v"+nom+"' id='d5rMod'></div> <div class='div3_v"+nom+"' id='d6rMod'></div>" +
            "<div class='div3_v"+nom+"' id='d7rMod'></div>";
        $(inpRazmetka).prependTo('div #thirdMod');
    }

    function cleanFourth() {
        if($('div').is('#fourth')){$('div #fourth').empty();}
        else {$('<div id="fourth"></div>').insertAfter('div #third');}
    }

    function cleanFourthMod() {
        if($('div').is('#fourthMod')){$('div #fourthMod').empty();}
        else {$('<div id="fourthMod"></div>').insertAfter('div #thirdMod');}
    }

    function clickMenu(atr,name) {
        $('.firstPD').attr({style: 'background-color: inherit'});
        $(atr).attr({style: 'background-color: #A2C8EB;'});
        $('#second').attr({style: 'border-bottom: double 3px; border-color: #0B6BDB; ' +
        'text-shadow: 0px 1px 1px #FFFFFF;'}).text(name);

    }

    function secondMod(name) {
        $('#secondMod').attr({style: 'border-bottom: double 3px; border-color: #0B6BDB; width: 570px;'}).text(name);
    }

    function ajaxFromFirst(adr,vidZap,text, funNum) {/*доработать крутёлку*/
        var address;
        var funcDo;
        var textZ_=text+"^"+vidZap;

        switch (adr){
            case "aud": address="pages/people.php"; break;
            case "aut": address="pages/authors.php"; break;
            case "eve": address="pages/events.php"; break;
            case "obj": address="pages/object.php"; break;
            case "rep": address="pages/reports.php"; break;
            case "req": address="pages/requests.php"; break;
            default: alert("adrPost!");
        }

        switch (funNum) {
            case "audDo": funcDo = doFFirstAud; break;
            case "autDo": funcDo = doFFirstAut; break;
            case "eveDo": funcDo = doFFirstEve; break;
            case "objDo": funcDo = doFFirstObj; break;
            case "repDo": funcDo = doFFirstRep; break;
            case "reqDo": funcDo = doFFirstReq; break;
            case "eveN": funcDo = doEveN; break;
            case "objAutSel": funcDo = doObjAutSel; break;
            case "objN" : funcDo = doObjN; break;
            case "autN" : funcDo = doAutN; break;
            case "audN" : funcDo = doAudN; break;
            case "audEd" : funcDo = doAudE; break;
            case "autEd" : funcDo = doAutE; break;
            case "objEd" : funcDo = doObjE; break;
            case "eveEd" : funcDo = doEveE; break;
            default: alert("doPost!");
        }

        switch (vidZap) {
            case "cont":
                $.ajax({
                    url: address,
                    type: "POST",
                    data: {textZ: textZ_},
                    dataType: "json",
                    success: funcDo
                });
                break;

            case "now":
                $.ajax({
                    url: address,
                    type: "POST",
                    data: {nowSub: textZ_},
                    dataType: "text",
                    success: funcDo
                });
                break;

            case "red":
                $.ajax({
                    url: address,
                    type: "POST",
                    data: {redSub: textZ_},
                    dataType: "json",
                    success: funcDo
                });
                break;
        }
    }

//---------------------------------------------------------------

    function funIndexID(indexID) {
        if(indexID<1||indexID < $('#nambPMax').val() ){
            +indexID++;
            $('#nambP').attr({value: indexID});
            return +indexID;
        }
        return +indexID;
    }

    function funIndexIDback(indexID) {
        if (indexID>1){
            +indexID--;
            $('#nambP').attr({value: indexID});
            return +indexID;
        }
        return +indexID;
    }
//---------------------------------------------------------------

    function doFFirstAud (data) {
        $('#third').attr({style : "background: url(picture/french-stucco.png), repeat; background-color: #fefff7;"});
        var indexID=funIndexID(0);
        contentAud(indexID,data);
        contFChet(indexID,data);
        saerch(data, 'pers_name');

        $('#butT1_1').on('click',function () {
            $.getJSON(url('ajax_json/user1Aud.json'), function(val) {
            contentNEXT($('#nambP').val(),val,'Aud');
            })
        });

        $('#butT1_2').on('click',function () {
            $('#overlay').fadeIn(400,function () {
                $('.modal_form').css('display', 'block').animate({opacity: 1, top: '50%'}, 250);
                secondMod('Аудитрия - новая запись');
                div_tourthModNew();
                content3divMod('ModNAud');
                contentAudMod();
                exitMod();
            });
        });

        $('#butT1_3').on('click',function () {
            $('#overlay').fadeIn(400,function () {
                $('.modal_form').css('display', 'block').animate({opacity: 1, top: '50%'}, 250);
                secondMod('Аудитрия - редактирование');
                div_tourthModRed();
                content3divMod('ModRAud');
                contentAudModEdit();
                exitMod();
            });
        });

        $('#butT1_4').on('click', function(){
            var idPril=$('#nambP').val();
            dilogDel();
            $('#Yes').on('click', function(){
                $.getJSON(url('ajax_json/user1Aud.json'), function(val){
                    var indBd=val[idPril]['person_id'];
                    $.ajax({
                        url: "pages/people.php",
                        type: "POST",
                        data: {del: indBd},
                        dataType: "json",
                        success: funcDel
                    });
                   function funcDel(data){
                        $('#nambPMax').attr({value: data});
                        $("#drob2").text(data);
                        $.getJSON(url('ajax_json/user1Aud.json'), function(val){
                         contentBACK($('#nambP').val(), val,'Aud');
                        })
                   }
                });
                $('#dilog').dialog('close').empty();
            })
        });

        $('#butT1_5').on('click',function () {
            $.getJSON(url('ajax_json/user1Aud.json'), function(val) {
            contentBACK($('#nambP').val(),val,'Aud');
            })
        });

        $('#butSearch').on('click', function(){
            $.getJSON(url('ajax_json/user1Aud.json'), function(val) {
                var lengthD = Object.keys(val).length;
                var id;
                for(i=1;i<lengthD;i++){
                    if (val[i]['pers_name']===$('#txtSerch').val()){
                        id=i-1;
                        contentNEXT(id,val,'Aud');
                    }
                }
            })
        })
    }
//------------------------------------------------------
    function doFFirstAut(data) {
        $('#third').attr({style : "background: url(picture/french-stucco.png), repeat; background-color: #fefff7;"});
        var indexID=funIndexID(0);
        contentAut (indexID,data);
        contFChet(indexID,data);
        saerch(data, 'author_name');

        $('#butT2_1').on('click',function () {
            $.getJSON(url('ajax_json/user1Aut.json'), function(val) {
            contentNEXT($('#nambP').val(), val, 'Aut');
            })
        });

        $('#butT2_2').on('click',function () {
            $('#overlay').fadeIn(400,function () {
                $('.modal_form').css('display', 'block').animate({opacity: 1, top: '50%'}, 250);
                secondMod('Авторы - новая запись');
                div_tourthModNew();
                content3divMod('ModNAut');
                contentAutMod();
                exitMod();
            });
        });

        $('#butT2_3').on('click',function () {
            $('#overlay').fadeIn(400,function () {
                $('.modal_form').css('display', 'block').animate({opacity: 1, top: '50%'}, 250);
                secondMod('Авторы - редактирование');
                div_tourthModRed();
                content3divMod('ModRAud');
                contentAutModEdit();
                exitMod();
            });
        });

        $('#butT2_4').on('click', function(){
            var idPril=$('#nambP').val();
            dilogDel();
            $('#Yes').on('click', function(){
                $.getJSON(url('ajax_json/user1Aut.json'), function(val){
                    var indBd=val[idPril]['author_id'];
                    $.ajax({
                        url: "pages/authors.php",
                        type: "POST",
                        data: {del: indBd},
                        dataType: "json",
                        success: funcDel
                    });
                    function funcDel(data){
                        $('#nambPMax').attr({value: data});
                        $("#drob2").text(data);
                        $.getJSON(url('ajax_json/user1Aut.json'), function(val){
                            contentBACK($('#nambP').val(), val,'Aut');
                        })
                    }
                });
                $('#dilog').dialog('close').empty();
            })
        });

        $('#butT2_5').on('click',function () {
            $.getJSON(url('ajax_json/user1Aut.json'), function(val) {
            contentBACK($('#nambP').val(), val, 'Aut');
            })
        });

        $('#butSearch').on('click', function(){
            $.getJSON(url('ajax_json/user1Aut.json'), function(val) {
                var lengthD = Object.keys(val).length;
                var id;
                for(i=1;i<lengthD;i++){
                    if (val[i]['author_name']===$('#txtSerch').val()){
                        id=i-1;
                        contentNEXT(id,val,'Aut');
                    }
                }
            })
        })
    }
//------------------------------------------------------

    function doFFirstObj(data) {
        $('#third').attr({style : "background: url(picture/french-stucco.png), repeat; background-color: #fefff7;"});
        var indexID=funIndexID(0);
        contentObj (indexID,data);
        contFChet(indexID,data);
        saerch(data, 'subj_name');

        $('#butT3_1').on('click',function () {
            $.getJSON(url('ajax_json/user1Obj.json'), function(val) {
            contentNEXT($('#nambP').val(),val,'Obj');
            })
        });

        $('#butT3_2').on('click',function () {
            $('#overlay').fadeIn(400,function () {
                $('.modal_form').css('display', 'block').animate({opacity: 1, top: '50%'}, 250);
                secondMod('Объекты - новая запись');
                div_tourthModNew();
                content3divMod('ModNObj');
                contentObjMod();
                exitMod();
            });
        });

        $('#butT3_3').on('click',function () {
            $('#overlay').fadeIn(400,function () {
                $('.modal_form').css('display', 'block').animate({opacity: 1, top: '50%'}, 250);
                secondMod('Объекты - редактирование');
                div_tourthModRed();
                content3divMod('ModRObj');
                contentObjModEdit();
                exitMod();
            });
        });

        $('#butT3_4').on('click', function(){
            var idPril=$('#nambP').val();
            dilogDel();
            $('#Yes').on('click', function(){
                $.getJSON(url('ajax_json/user1Obj.json'), function(val){
                    var indBd=val[idPril]['subj_id'];
                    $.ajax({
                        url: "pages/object.php",
                        type: "POST",
                        data: {del: indBd},
                        dataType: "json",
                        success: funcDel
                    });
                function funcDel(data){
                        $('#nambPMax').attr({value: data});
                        $("#drob2").text(data);
                        $.getJSON(url('ajax_json/user1Obj.json'), function(val){
                            contentBACK($('#nambP').val(), val,'Obj');
                        })
                    }
                });
                $('#dilog').dialog('close').empty();
            })
        });

        $('#butT3_5').on('click',function () {
            $.getJSON(url('ajax_json/user1Obj.json'), function(val) {
            contentBACK($('#nambP').val(), val, 'Obj');
            })
        });

        $('#butSearch').on('click', function(){
            $.getJSON(url('ajax_json/user1Obj.json'), function(val) {
                var lengthD = Object.keys(val).length;
                var id;
                for(i=1;i<lengthD;i++){
                    if (val[i]['subj_name']===$('#txtSerch').val()){
                        id=i-1;
                        contentNEXT(id,val,'Obj');
                    }
                }
            })
        })
    }

//---------------------------------------------------------------------

    function doFFirstEve(data) {
        $('#third').attr({style : "background: url(picture/french-stucco.png), repeat; background-color: #fefff7;"});
        var indexID=funIndexID(0);
        contentEve (indexID,data);
        contFChet(indexID,data);
        saerch(data, 'event_name');

        $('#butT4_1').on('click',function () {
            $.getJSON(url('ajax_json/user1Eve.json'), function(val) {
                contentNEXT($('#nambP').val(), val,'Eve');
            })
        });

        $('#butT4_2').on('click',function () {
            $('#overlay').fadeIn(400,function () {
                $('.modal_form').css('display', 'block').animate({opacity: 1, top: '50%'}, 250);
                secondMod('Мероприятия - новая запись');
                div_tourthModNew();
                content3divMod('ModNEve');
                contentEveMod();
                exitMod();
            });
        });

        $('#butT4_3').on('click',function () {
            $('#overlay').fadeIn(400,function () {
                $('.modal_form').css('display', 'block').animate({opacity: 1, top: '50%'}, 250);
                secondMod('Мероприятия - редактирование');
                div_tourthModRed();
                content3divMod('ModREve');
                contentEveModEdit ();
                exitMod();
            });
        });

        $('#butT4_4').on('click', function(){
            var idPril=$('#nambP').val();
            dilogDel();
            $('#Yes').on('click', function(){
               $.getJSON(url('ajax_json/user1Eve.json'), function(val){
                   var indBd=val[idPril]['event_id'];
                   $.ajax({
                       url: "pages/events.php",
                       type: "POST",
                       data: {del: indBd},
                       dataType: "json",
                       success: funcDel
                   });
                   function funcDel(data){
                        $('#nambPMax').attr({value: data});
                        $("#drob2").text(data);
                        $.getJSON(url('ajax_json/user1Eve.json'), function(val){
                            contentBACK($('#nambP').val(), val,'Eve');
                        })
                    }
                });
                $('#dilog').dialog('close').empty();
            })
        });

        $('#butT4_5').on('click',function () {
            $.getJSON(url('ajax_json/user1Eve.json'), function(val){
                contentBACK($('#nambP').val(),val,'Eve');
            })
        });

        $('#butSearch').on('click', function(){
            $.getJSON(url('ajax_json/user1Eve.json'), function(val) {
                var lengthD = Object.keys(val).length;
                var id;
                for(i=1;i<lengthD;i++){
                    if (val[i]['event_name']===$('#txtSerch').val()){
                        id=i-1;
                        contentNEXT(id,val,'Eve');
                    }
                }
            })
        })
    }

    function doEveN(data) {
        $('#nambPMax').attr({value: data});
        $("#drob2").text(data);
        $('.modal_form').animate({opacity: 0, top: '45%'}, 200,
            function () {
                $(this).css('display', 'none');
                $('#overlay').fadeOut(400);
            }
        );
    }

    function doEveE(data){
        $.getJSON(url('ajax_json/user1Eve.json'), function(val) {
            var id = data - 1;
            contentNEXT(id, val, "Eve");
            $('.modal_form').animate({opacity: 0, top: '45%'}, 200,
                function () {
                    $(this).css('display', 'none');
                    $('#overlay').fadeOut(400);
                }
            );
        })
    }

    function doAutN(data){
        $('#nambPMax').attr({value: data});
        $("#drob2").text(data);
        $('.modal_form').animate({opacity: 0, top: '45%'}, 200,
            function () {
                $(this).css('display', 'none');
                $('#overlay').fadeOut(400);
            }
        );
    }

    function doAutE(data){
        $.getJSON(url('ajax_json/user1Aut.json'), function(val) {
            var id = data - 1;
            contentNEXT(id, val, "Aut");
            $('.modal_form').animate({opacity: 0, top: '45%'}, 200,
                function () {
                    $(this).css('display', 'none');
                    $('#overlay').fadeOut(400);
                }
            );
        })
    }

    function doAudN(data){
        $('#nambPMax').attr({value: data});
        $("#drob2").text(data);
        $('.modal_form').animate({opacity: 0, top: '45%'}, 200,
            function () {
                $(this).css('display', 'none');
                $('#overlay').fadeOut(400);
            }
        );
    }

    function doAudE(data){
        $.getJSON(url('ajax_json/user1Aud.json'), function(val) {
            var id = data - 1;
            contentNEXT(id, val, "Aud");
            $('.modal_form').animate({opacity: 0, top: '45%'}, 200,
                function () {
                    $(this).css('display', 'none');
                    $('#overlay').fadeOut(400);
                }
            );
        })
    }

    function doObjN(data) {
        $('#nambPMax').attr({value: data});
        $("#drob2").text(data);
        $('.modal_form').animate({opacity: 0, top: '45%'}, 200,
            function () {
                $(this).css('display', 'none');
                $('#overlay').fadeOut(400);
            }
        );
    }

    function doObjE(data){
        $.getJSON(url('ajax_json/user1Obj.json'), function(val) {
            var id = +data - 1;
            contentNEXT(+id, val, "Obj");
            $('.modal_form').animate({opacity: 0, top: '45%'}, 200,
                function () {
                    $(this).css('display', 'none');
                    $('#overlay').fadeOut(400);
                }
            );
        })
    }

//---------------------------------------------------------------

    function div_tourth1() {
        cleanFourth();
        var mrgPX="24px";
        button("Вперёд", mrgPX, "butT1_1");
        button("Новая запись", mrgPX, "butT1_2");
        button("Редактровать", mrgPX, "butT1_3");
        button("Удалить", mrgPX, "butT1_4");
        button("Назад", mrgPX, "butT1_5");
    }

    function div_tourth2() {
        cleanFourth();
        var mrgPX="24px";
        button("Вперёд", mrgPX, "butT2_1");
        button("Новый автор", mrgPX, "butT2_2");
        button("Редактровать", mrgPX, "butT2_3");
        button("Удалить", mrgPX, "butT2_4");
        button("Назад", mrgPX, "butT2_5");
    }

    function div_tourth3() {
        cleanFourth();
        var mrgPX="24px";
        button("Вперёд", mrgPX, "butT3_1");
        button("Новый объект", mrgPX, "butT3_2");
        button("Редактровать", mrgPX, "butT3_3");
        button("Удалить", mrgPX, "butT3_4");
        button("Назад", mrgPX, "butT3_5");
    }

    function div_tourth4() {
        cleanFourth();
        var mrgPX="24px";
        button("Вперёд", mrgPX, "butT4_1");
        button("Новая запись", mrgPX, "butT4_2");
        button("Редактровать", mrgPX, "butT4_3");
        button("Удалить", mrgPX, "butT4_4");
        button("Назад", mrgPX, "butT4_5");
    }

    function div_tourth5() {
        cleanFourth();
        var mrgPX="61px";
        button("Вперёд", mrgPX, "butT5_1");
        button("Выборка", mrgPX, "butT5_2");
        button("Сформировать", mrgPX, "butT5_3");
        button("Назад", mrgPX, "butT5_4");
    }

    function div_tourthModNew() {
    cleanFourthMod();
        var mrgPX="200px";
    buttonMod("Сохранить", mrgPX, "butButFNow");
    buttonMod("Назад", mrgPX, "butBack");

    }

    function div_tourthModRed() {
        cleanFourthMod();
        var mrgPX="200px";
        buttonMod("Сохранить", mrgPX, "butButFNow");
        buttonMod("Назад", mrgPX, "butBack");
    }

    function div_tourthModReq() {
        cleanFourthMod();
        var mrgPX="200px";
        buttonMod("Печать", mrgPX, "butPrint");
        buttonMod("Назад", mrgPX, "butBack");
    }

//----------------------------------------------------------------

$('#d1').on('click',function () {
    clickMenu('#d1','Аудитория');
    div_tourth1();
    content3div('Aud');
    ajaxFromFirst("aud","cont", document.cookie, 'audDo');
});

$('#d2').on('click',function () {
    clickMenu('#d2', 'Авторы');
    div_tourth2();
    content3div('Aut');
    ajaxFromFirst("aut","cont","abrval", 'autDo');
});

$('#d3').on('click',function () {
    clickMenu('#d3', 'Объекты');
    div_tourth3();
    content3div('Obj');
    ajaxFromFirst("obj","cont","abrval", 'objDo');
});

$('#d4').on('click',function () {
    clickMenu('#d4', 'Мероприятия');
    div_tourth4();
    content3div('Eve');
    ajaxFromFirst("eve","cont","abrval", 'eveDo');
});

$('#d5').on('click',function () {
    clickMenu('#d5', 'Отчёты');
    div_tourth5();
    $('#third').empty();
});

$('#d6').on('click',function () {
    $('#third').attr({style : "background: url(picture/french-stucco.png), repeat; background-color: #fefff7;"});
    clickMenu('#d6', 'Запросы');
    $('#fourth').remove();
    $('#third').empty();
    $('#search').empty();

    $('<div class="req" id="audReq">Аудитория</div><div class="req" id="objReq">Объекты</div><div class="req" id="eveReq">Мероприятия</div>').prependTo('#third');

    $('#audReq').on('click', function () {
        $('#third').empty();
        $('<div class="name">Аудитория</div><div class="req" id="audReqCon">Средство связи</div><div class="req" id="audReqBerth">День рождения</div><div class="req" id="audReqAll">Все клиенты</div>').prependTo('#third');

        $('#audReqCon').on('click',function () {
            $('#third').empty();
            $('<div id="coonect" style="padding-left: 400px; padding-top: 40px"></div>').prependTo('#third');
            var check = "<div id='message'><input type='checkbox' class='styler' name='tel' value='1' id='ch1'>Телефон<br><input type='checkbox' class='styler' name='mail' value='1' id='ch2'>Email<br><input type='checkbox' class='styler' name='vib' value='1' id='ch3'>Viber<br><input type='checkbox' class='styler' name='what' value='1' id='ch4'>WhatsApp<br><input type='checkbox' class='styler' name='teleg' value='1' id='ch5'>Telegram<br><input type='checkbox' class='styler' name='mess' value='1' id='ch6'>Messenger</div><input type='button' value='Выбрать' id='reqAutCon' class='button'>";
            $(check).prependTo("#coonect");
            $("<p style='margin-left: 35px;'>Средство связи:</p>").prependTo("#coonect");
            (function($){$(function(){ $('.styler').styler({ selectSearch: true});});})(jQuery);
            $('#reqAutCon').on('click', function(){
                var tel=0;
                var mail=0;
                var vib=0;
                var what=0;
                var teleg=0;
                var mess=0;
                var shet=0;
                if($('input[name="tel"]:checked').val()==='1') {tel=1; shet++}
                if($('input[name="mail"]:checked').val()==='1') {mail=1; shet++}
                if($('input[name="vib"]:checked').val()==='1') {vib=1; shet++}
                if($('input[name="what"]:checked').val()==='1') {what=1; shet++}
                if($('input[name="teleg"]:checked').val()==='1') {teleg=1; shet++}
                if($('input[name="mess"]:checked').val()==='1') {mess=1; shet++}
                var str=tel+"^"+mail+"^"+vib+"^"+what+"^"+teleg+"^"+mess;
                if(shet>0) {
                    $('#overlay').fadeIn(400,function () {
                        $('.modal_form').css('display', 'block').animate({opacity: 1, top: '50%'}, 250);
                        $('#thirdMod').empty().css({overflow: "scroll"});
                        div_tourthModReq();
                        secondMod("Аудитория контакты");

                        $.ajax({
                            url: "pages/people.php",
                            type: "POST",
                            data: {reqConAud: str},
                            dataType: "json",
                            success: funDoAudCon
                        });
                        function funDoAudCon(data) {
                            var Table="<table id='dTable'><thead><tr><th>№</th><th>Ф.И.О.</th><th>День рождения:</th><th>Телефон:</th><th>Email:</th><th>Адрес:</th><tr></thead><tbody>";
                            fSel=(Object.keys(data).length);
                            for(i=1; i<fSel; i++) {
                                Table=Table+"<tr><td>"+i+"</td><td>"+data[+i]['pers_name']+"</td><td>"+data[+i]['pers_birth']+"</td><td>"+data[+i]['pers_tel']+"</td><td>"+data[+i]['pers_email']+"</td><td>"+data[+i]['pers_adres']+"</td><tr>";
                            }
                            Table=Table+"</tbody></table>";
                            $(Table).prependTo('#thirdMod');
                            $('#dTable').dataTable();
                        }
                        exitMod();
                        print();
                    })
                }
            })
        });

        $('#audReqBerth').on('click',function () {
            $('#overlay').fadeIn(400,function () {
                $('.modal_form').css('display', 'block').animate({opacity: 1, top: '50%'}, 250);
                $('#thirdMod').empty().css({overflow: "scroll"});
                div_tourthModReq();
                secondMod("Аудитория");
                $.ajax({
                    url: "pages/people.php",
                    type: "POST",
                    data: {reqBerthAud: '1'},
                    dataType: "json",
                    success: funDoTable
                });
                function funDoTable(data) {
                    var Table="<table id='dTable'><thead><tr><th>№</th><th>Ф.И.О.</th><th>День рождения:</th><th>Телефон:</th><th>Email:</th><th>Адрес:</th><tr></thead><tbody>";
                    fSel=(Object.keys(data).length);
                    for(i=1; i<fSel; i++) {
                        var ind=+i;
                        Table=Table+"<tr><td>"+ind+"</td><td>"+data[+ind]['pers_name']+"</td><td>"+data[+ind]['pers_birth']+"</td><td>"+data[+ind]['pers_tel']+"</td><td>"+data[+ind]['pers_email']+"</td><td>"+data[+ind]['pers_adres']+"</td><tr>";
                    }
                    Table=Table+"</tbody></table>";
                    $(Table).prependTo('#thirdMod');
                    $('#dTable').dataTable();
                }
                exitMod();
                print();
            });
        });

        $('#audReqAll').on('click',function () {
            $('#overlay').fadeIn(400,function () {
                $('.modal_form').css('display', 'block').animate({opacity: 1, top: '50%'}, 250);
                $('#thirdMod').empty().css({overflow: "scroll"});
                div_tourthModReq();
                secondMod("Аудитория");
                $.ajax({
                    url: "pages/people.php",
                    type: "POST",
                    data: {reqAllaud: '1'},
                    dataType: "json",
                    success: funDoTable
                });
                function funDoTable(data) {
                    var Table="<table id='dTable'><thead><tr><th>№</th><th>Ф.И.О.</th><th>День рождения:</th><th>Телефон:</th><th>Email:</th><th>Адрес:</th><tr></thead><tbody>";
                    fSel=(Object.keys(data).length);
                    for(i=1; i<fSel; i++) {
                    var ind=+i;
                    Table=Table+"<tr><td>"+ind+"</td><td>"+data[+ind]['pers_name']+"</td><td>"+data[+ind]['pers_birth']+"</td><td>"+data[+ind]['pers_tel']+"</td><td>"+data[+ind]['pers_email']+"</td><td>"+data[+ind]['pers_adres']+"</td><tr>";
                    }
                    Table=Table+"</tbody></table>";
                    $(Table).prependTo('#thirdMod');
                    $('#dTable').dataTable();
                }
                exitMod();
                print();
            });
        });
    });

    $('#objReq').on('click', function () {
        $('#third').empty();
        $('<div class="name">Объекты</div><div class="req" id="objReqVid">Вид объекта</div><div class="req" id="objReqAut">Автор</div><div class="req" id="objReqMat">Материал</div><div class="req" id="objReqAll">Все объекты</div>').prependTo('#third');

        $('#objReqVid').on('click',function () {
            $('#third').empty();
            $("<div id='req'></div>").prependTo('#third');
            $.getJSON(url('ajax_json/jsonBD.json'), function (data) {
                nSel=(Object.keys(data['objVid']).length);
                var vidEv="<option value='0'>Выбор..</option>";
                for (i=0; i<nSel;i++){
                    ind=+i+1;
                    vidEv=vidEv+"<option value='"+ind+"'>"+data['objVid'][i]+"</option>"
                }
                vidEv="<select id='ModVib' title=''>"+vidEv+"</select><input type='button' value='Выбрать' id='reqSelbut' class='button'>";
                $(vidEv).prependTo('#req');
                $('<div class="name">Объекты вид</div>').prependTo('#third');
                $('#ModVib').selectmenu({
                    width: 335,
                    change: function (event, ui) {
                        valSel=ui.item.label;
                    }
                });
                $('#reqSelbut').on('click', function () {
                    $('#overlay').fadeIn(400,function () {
                        $('.modal_form').css('display', 'block').animate({opacity: 1, top: '50%'}, 250);
                        $('#thirdMod').empty().css({overflow: "scroll"});
                        div_tourthModReq();
                        secondMod("Объекты по виду");
                        $.ajax({
                            url: "pages/object.php",
                            type: "POST",
                            data: {reqObjVid: valSel},
                            dataType: "json",
                            success: funDoTable
                        });
                        function funDoTable(data) {
                            var Table="<table id='dTable'><thead><tr><th>№</th><th>Наименование</th><th>Дата:</th><th>Размер:</th><th>Автор:</th><th>Материал:</th><th>Вид:</th><tr></thead><tbody>";
                            fSel=(Object.keys(data).length);
                            for(i=1; i<fSel; i++){
                                var ind=+i;
                                Table=Table+"<tr><td>"+ind+"</td><td>"+data[+ind]['subj_name']+"</td><td>"+data[+ind]['subj_b_date']+"</td><td>"+data[+ind]['subj_razmX']+"x"+data[+ind]['subj_razmY']+"x"+data[+ind]['subj_razmZ']+"</td><td>"+data[+ind]['author_name']+"</td><td>"+data[+ind]['subj_mat']+"</td><td>"+data[+ind]['subj_vid']+"</td><tr>";
                            }
                            Table=Table+"</tbody></table>";
                            $(Table).prependTo('#thirdMod');
                            $('#dTable').dataTable();
                        }
                        exitMod();
                        print();
                    });
                })
            })
        });

        $('#objReqAut').on('click',function () {
            $('#third').empty();
            $("<div id='req'></div>").prependTo('#third');
            $.getJSON(url('ajax_json/user1Aut.json'), function (data) {
                nSel=(Object.keys(data).length)-1;
                var vidEv="<option value='0'>Выбор..</option>";
                for (i=1; i<=nSel;i++){
                    ind=+i;
                    vidEv=vidEv+"<option value='"+ind+"'>"+data[i]['author_name']+"</option>"
                }
                vidEv="<select id='ModVib' title=''>"+vidEv+"</select><input type='button' value='Выбрать' id='reqSelbut' class='button'>";
                $(vidEv).prependTo('#req');
                $('<div class="name">Объекты автор</div>').prependTo('#third');
                $('#ModVib').selectmenu({
                    width: 335,
                    change: function (event, ui) {
                        valSel=ui.item.label;
                    }
                });
                $('#reqSelbut').on('click', function () {
                    $('#overlay').fadeIn(400,function () {
                        $('.modal_form').css('display', 'block').animate({opacity: 1, top: '50%'}, 250);
                        $('#thirdMod').empty().css({overflow: "scroll"});
                        div_tourthModReq();
                        secondMod("Объекты автор");
                        $.ajax({
                            url: "pages/object.php",
                            type: "POST",
                            data: {reqObjAut: valSel},
                            dataType: "json",
                            success: funDoTable
                        });
                        function funDoTable(data) {
                            var Table="<table id='dTable'><thead><tr><th>№</th><th>Наименование</th><th>Дата:</th><th>Размер:</th><th>Автор:</th><th>Материал:</th><th>Вид:</th><tr></thead><tbody>";
                            fSel=(Object.keys(data).length);
                            for(i=1; i<fSel; i++){
                                var ind=+i;
                                Table=Table+"<tr><td>"+ind+"</td><td>"+data[+ind]['subj_name']+"</td><td>"+data[+ind]['subj_b_date']+"</td><td>"+data[+ind]['subj_razmX']+"x"+data[+ind]['subj_razmY']+"x"+data[+ind]['subj_razmZ']+"</td><td>"+data[+ind]['author_name']+"</td><td>"+data[+ind]['subj_mat']+"</td><td>"+data[+ind]['subj_vid']+"</td><tr>";
                            }
                            Table=Table+"</tbody></table>";
                            $(Table).prependTo('#thirdMod');
                            $('#dTable').dataTable();
                        }
                        print();
                        exitMod();
                    });
                })
            })

        });

        $('#objReqMat').on('click',function () {
            $('#third').empty();
            $("<div id='req'></div>").prependTo('#third');
            $.getJSON(url('ajax_json/jsonBD.json'), function (data) {
                nSel=(Object.keys(data['objMat']).length);
                var vidEv="<option value='0'>Выбор..</option>";
                for (i=0; i<nSel;i++){
                    ind=+i+1;
                    vidEv=vidEv+"<option value='"+ind+"'>"+data['objMat'][i]+"</option>"
                }
                vidEv="<select id='ModVib' title=''>"+vidEv+"</select><input type='button' value='Выбрать' id='reqSelbut' class='button'>";
                $(vidEv).prependTo('#req');
                $('<div class="name">Объекты материал</div>').prependTo('#third');
                $('#ModVib').selectmenu({
                    width: 335,
                    change: function (event, ui) {
                        valSel=ui.item.label;
                    }
                });
                $('#reqSelbut').on('click', function () {
                    $('#overlay').fadeIn(400,function () {
                        $('.modal_form').css('display', 'block').animate({opacity: 1, top: '50%'}, 250);
                        $('#thirdMod').empty().css({overflow: "scroll"});
                        div_tourthModReq();
                        secondMod("Объекты материал");
                        $.ajax({
                            url: "pages/object.php",
                            type: "POST",
                            data: {reqObjMat: valSel},
                            dataType: "json",
                            success: funDoTable
                        });
                        function funDoTable(data) {
                            var Table="<table id='dTable'><thead><tr><th>№</th><th>Наименование</th><th>Дата:</th><th>Размер:</th><th>Автор:</th><th>Материал:</th><th>Вид:</th><tr></thead><tbody>";
                            fSel=(Object.keys(data).length);
                            for(i=1; i<fSel; i++){
                                var ind=+i;
                                Table=Table+"<tr><td>"+ind+"</td><td>"+data[+ind]['subj_name']+"</td><td>"+data[+ind]['subj_b_date']+"</td><td>"+data[+ind]['subj_razmX']+"x"+data[+ind]['subj_razmY']+"x"+data[+ind]['subj_razmZ']+"</td><td>"+data[+ind]['author_name']+"</td><td>"+data[+ind]['subj_mat']+"</td><td>"+data[+ind]['subj_vid']+"</td><tr>";
                            }
                            Table=Table+"</tbody></table>";
                            $(Table).prependTo('#thirdMod');
                            $('#dTable').dataTable();
                        }
                        print();
                        exitMod();
                    });
                })
            })
        });

        $('#objReqAll').on('click',function () {
            $('#overlay').fadeIn(400,function () {
                $('.modal_form').css('display', 'block').animate({opacity: 1, top: '50%'}, 250);
                    $('#thirdMod').empty().css({overflow: "scroll"});
                    div_tourthModReq();
                    secondMod("Объекты");
                    $.ajax({
                        url: "pages/object.php",
                        type: "POST",
                        data: {reqAllobj: '1'},
                        dataType: "json",
                        success: funDoTable
                    });
                    function funDoTable(data) {
                        var Table="<table id='dTable'><thead><tr><th>№</th><th>Наименование</th><th>Дата:</th><th>Размер:</th><th>Автор:</th><th>Материал:</th><th>Вид:</th><tr></thead><tbody>";
                        fSel=(Object.keys(data).length);
                        for(i=1; i<fSel; i++){
                            var ind=+i;
                            Table=Table+"<tr><td>"+ind+"</td><td>"+data[+ind]['subj_name']+"</td><td>"+data[+ind]['subj_b_date']+"</td><td>"+data[+ind]['subj_razmX']+"x"+data[+ind]['subj_razmY']+"x"+data[+ind]['subj_razmZ']+"</td><td>"+data[+ind]['author_name']+"</td><td>"+data[+ind]['subj_mat']+"</td><td>"+data[+ind]['subj_vid']+"</td><tr>";
                        }
                        Table=Table+"</tbody></table>";
                        $(Table).prependTo('#thirdMod');
                        $('#dTable').dataTable();
                    }
                print();
                exitMod();
            });
        });
    });

    $('#eveReq').on('click', function () {
        $('#third').empty();
        $('<div class="name">Мероприятия</div><div class="req" id="eveReqNear">Ближайшие</div><div class="req" id="eveReqTip">Тип мероприятия</div>').prependTo('#third');

        $('#eveReqNear').on('click',function () {
            $('#overlay').fadeIn(400,function () {
                $('.modal_form').css('display', 'block').animate({opacity: 1, top: '50%'}, 250);
                $('#thirdMod').empty().css({overflow: "scroll"});
                div_tourthModReq();
                secondMod("Ближайшие мероприятия");
                $.ajax({
                    url: "pages/events.php",
                    type: "POST",
                    data: {reqNear: '1'},
                    dataType: "json",
                    success: funDoTable
                });
                function funDoTable(data) {
                    var Table="<table id='dTable'><thead><tr><th>№</th><th>Наименование</th><th>Дата:</th><th>Адрес:</th><th>Тип мероприятия:</th><tr></thead><tbody>";
                    fSel=(Object.keys(data).length);
                    for(i=0; i<fSel; i++){
                        var ind=+i+1;
                        Table=Table+"<tr><td>"+ind+"</td><td>"+data[+i]['event_name']+"</td><td>"+data[+i]['event_date']+"</td><td>"+data[+i]['event_addr']+"</td><td>"+data[+i]['event_vid']+"</td><tr>";
                    }
                    Table=Table+"</tbody></table>";
                    $(Table).prependTo('#thirdMod');
                    $('#dTable').dataTable();
                }
                print();
                exitMod();
            });
        });

        $('#eveReqTip').on('click',function () {
            $('#third').empty();
            $("<div id='req'></div>").prependTo('#third');
            $.getJSON(url('ajax_json/jsonBD.json'), function (data) {
                nSel=(Object.keys(data['eveVid']).length);
                var vidEv="<option value='0'>Выбор..</option>";
                for (i=0; i<nSel;i++){
                    ind=+i+1;
                    vidEv=vidEv+"<option value='"+ind+"'>"+data['eveVid'][i]+"</option>"
                }
                vidEv="<select id='ModVib' title=''>"+vidEv+"</select><input type='button' value='Выбрать' id='reqSelbut' class='button'>";
                $(vidEv).prependTo('#req');
                $('<div class="name">Мероприятия тип</div>').prependTo('#third');
                $('#ModVib').selectmenu({
                    width: 335,
                    change: function (event, ui) {
                        valSel=ui.item.label;
                    }
                });
                $('#reqSelbut').on('click', function () {
                    $('#overlay').fadeIn(400,function () {
                        $('.modal_form').css('display', 'block').animate({opacity: 1, top: '50%'}, 250);
                        $('#thirdMod').empty().css({overflow: "scroll"});
                        div_tourthModReq();
                        secondMod("Мероприятия по виду");
                        $.ajax({
                            url: "pages/events.php",
                            type: "POST",
                            data: {reqVid: valSel},
                            dataType: "json",
                            success: funDoTable
                        });
                        function funDoTable(data) {
                            var Table="<table id='dTable'><thead><tr><th>№</th><th>Наименование</th><th>Дата:</th><th>Адрес:</th><th>Тип мероприятия:</th><tr></thead><tbody>";
                            fSel=(Object.keys(data).length);
                            for(i=0; i<fSel; i++){
                                var ind=+i+1;
                                Table=Table+"<tr><td>"+ind+"</td><td>"+data[+i]['event_name']+"</td><td>"+data[+i]['event_date']+"</td><td>"+data[+i]['event_addr']+"</td><td>"+data[+i]['event_vid']+"</td><tr>";
                            }
                            Table=Table+"</tbody></table>";
                            $(Table).prependTo('#thirdMod');
                            $('#dTable').dataTable();
                        }
                        print();
                        exitMod();
                    });
                })
            })
        });
    });
});

//----------------------------------------------------------------

function contentNEXT(val,data,from) {
      var indexID=funIndexID(+val);
       content3div(from);
       caseNextBack(indexID,data,from);
        $("#drob").text(indexID+'/');
       $("#drob2").text($('#nambPMax').val());
    }

function contentBACK(val,data,from) {
        var indexID=funIndexIDback(+val);
        content3div(from);
        caseNextBack(indexID,data,from);
        $("#drob").text(indexID+'/');
        $("#drob2").text($('#nambPMax').val());
    }

function caseNextBack(indexID,data,from) {
    switch (from) {
        case "Aud": contentAud(indexID, data); break;
        case "Aut": contentAut(indexID, data); break;
        case "Obj": contentObj(indexID, data); break;
        case "Eve": contentEve(indexID, data); break;
    }
}

//----------------------------------------------------------------

function contentAud (indexID,data) {
    $("<div id='Div_d6r1'><p class='Pd6r'>Примечание:</p></div><div id='Div_d6r2'>"+data[indexID]['pers_prim']+"</div>").prependTo('#d6r');
    $("<p class='Pd3r'>Ф.И.О.</p><p class='Pd3r'>Пол:</p><p class='Pd3r'>День рождения:</p><p class='Pd3r'>Телефон:</p><p class='Pd3r'>Email:</p><p class='Pd3r'>Адрес:</p>").prependTo('#d3r');
    $("<p class='Pd4r'>"+data[indexID]['pers_name']+"</p><p class='Pd4r'>"+data[indexID]['pers_sex']+"</p><p class='Pd4r'>"+data[indexID]['pers_birth']+"</p><p class='Pd4r'>"+data[indexID]['pers_tel']+"</p><p class='Pd4r'>"+data[indexID]['pers_email']+"</p><p class='Pd4r'>"+data[indexID]['pers_adres']+"</p>").prependTo('#d4r');
    $('<div id="coonect" style="padding-left: 55px"></div>').insertAfter('div #drob2');
    var check = "<div id='message'><input type='checkbox' class='styler' name='tel' value='1' id='ch1' onclick='window.event.returnValue=false'>Телефон<br><input type='checkbox' class='styler' name='mail' value='1' id='ch2' onclick='window.event.returnValue=false'>Email<br><input type='checkbox' class='styler' name='vib' value='1' id='ch3' onclick='window.event.returnValue=false'>Viber<br><input type='checkbox' class='styler' name='what' value='1' id='ch4' onclick='window.event.returnValue=false'>WhatsApp<br><input type='checkbox' class='styler' name='teleg' value='1' id='ch5' onclick='window.event.returnValue=false'>Telegram<br><input type='checkbox' class='styler' name='mess' value='1' id='ch6' onclick='window.event.returnValue=false'>Messenger</div>";
    $(check).prependTo("#coonect");
    $("<p style='margin-left: 35px;'>Средство связи:</p>").prependTo("#coonect");
    if((+data[indexID]['pers_con_phone'])===1) $('#ch1').attr({checked:'1'});
    if((+data[indexID]['pers_con_email'])===1) $('#ch2').attr({checked:'1'});
    if((+data[indexID]['pers_con_vib'])===1) $('#ch3').attr({checked:'1'});
    if((+data[indexID]['pers_con_whats'])===1) $('#ch4').attr({checked:'1'});
    if((+data[indexID]['pers_con_telegr'])===1) $('#ch5').attr({checked:'1'});
    if((+data[indexID]['pers_con_mesen'])===1) $('#ch6').attr({checked:'1'});
    (function($){$(function(){ $('.styler').styler({ selectSearch: true});});})(jQuery);
}

function contentAut (indexID,data) {
    $("<p class='Pd3r'>Ф.И.О.</p><p class='Pd3r'>День рождения:</p><p class='Pd3r'>Псевдоним:</p><p class='Pd3r'>Телефон:</p><p class='Pd3r'>Направление:</p>").prependTo('#d3r');
    $("<div id='Div_d6r1'><p class='Pd6r'>Примечание:</p></div><div id='Div_d6r2'>"+data[indexID]['aut_prim']+"</div>").prependTo('#d6r');
    $("<p class='Pd4r'>"+data[indexID]['pers_name']+"</p><p class='Pd4r'>"+data[indexID]['pers_birth']+"</p><p class='Pd4r'>"+data[indexID]['author_name']+"</p><p class='Pd4r'>"+data[indexID]['pers_tel']+"</p><p class='Pd4r'>"+data[indexID]['aut_napr']+"</p>").prependTo('#d4r');
}

function contentObj (indexID,data) {
    $("<p class='Pd3r'>Наименование:</p><p class='Pd3r'>Вид:</p><p class='Pd3r'>Материал:</p><p class='Pd3r'>Размер:</p><p class='Pd3r'>Год:</p><p class='Pd3r'>Автор:</p>").prependTo('#d3r');
    $("<div id='Div_d6r1'><p class='Pd6r'>Примечание:</p></div><div id='Div_d6r2'>"+data[indexID]['subj_prim']+"</div>").prependTo('#d6r');
    $("<p class='Pd4r'>"+data[indexID]['subj_name']+"</p><p class='Pd4r'>"+data[indexID]['subj_vid']+"</p><p class='Pd4r'>"+data[indexID]['subj_mat']+"</p><p class='Pd4r'>"+data[indexID]['subj_razmX']+"x"+data[indexID]['subj_razmY']+"x"+data[indexID]['subj_razmZ']+" мм.</p><p class='Pd4r'>"+data[indexID]['subj_b_date']+"</p><p class='Pd4r'>"+data[indexID]['author_name']+"</p>").prependTo('#d4r');
}

function contentEve (indexID,data) {
    $("<p class='Pd3r' id='Pd3r1P'>Наименование:</p><p class='Pd3r'>Мероприятие:</p><p class='Pd3r'>Дата:</p><p class='Pd3r'>Адрес:</p><p class='Pd3r'></p>").prependTo('#d3r');
    $("<div id='Div_d6r1'><p class='Pd6r'>Примечание:</p></div><div id='Div_d6r2'>"+data[indexID]['event_prim']+"</div>").prependTo('#d6r');
    $("<p class='Pd4r'>"+data[indexID]['event_name']+"</p><p class='Pd4r'>"+data[indexID]['event_vid']+"</p><p class='Pd4r'>"+data[indexID]['event_date']+"</p><p class='Pd4r'>"+data[indexID]['event_addr']+"</p><p class='Pd4r'></p>").prependTo('#d4r');
}

function contentAudMod () {
    $("<p class='Pd3r'>Ф.И.О.</p><p class='Pd3r'>Пол:</p><p class='Pd3r'>День рождения:</p><p class='Pd3r'>Телефон:</p><p class='Pd3r'>Email:</p><p class='Pd3r'>Адрес:</p>").prependTo('#d3rMod');
    $("<div id='Div_d6r1Mod'><p class='Pd6r'>Примечание:</p></div><div id='Div_d6r2Mod'><input type='text' id='prime4'></div>").prependTo('#d6rMod');
    $("<p><input type='text' id='audAdres' title='Адрес'></p>").prependTo('#d4rMod');
    $("<p><input type='text' id='audEmale' title='Email'></p>").prependTo('#d4rMod');
    $("<p><input type='text' id='audPhone' title='Телефон'></p>").prependTo('#d4rMod');
    $('#audPhone').mask("(999) 999-99-99");
    $("<p><input type='text' id='dateAud' title=''></p>").prependTo('#d4rMod');
    $("#dateAud").datepicker({
        dateFormat: "dd.mm.yy",
        monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь',
            'Октябрь', 'Ноябрь', 'Декабрь'],
        dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
        firstDay: 1,
        changeYear: true,
        yearRange: '-100:+3'
    });
    $("<p><select class='box' id='sex'><option>Выбор...</option><option>Мужской</option><option>Женский</option></select></p>").prependTo('#d4rMod');
    var sex=0;
    $('#sex').selectmenu({
        width: 335,
        change: function (event, ui) {
            sex=ui.item.label;
        }
    });
    $("<p><input type='text' id='audName' title='ФИО'></p>").prependTo('#d4rMod');
    var check = "<div id='message'><input type='checkbox' class='styler' name='tel1' id='tel1' value='1'>Телефон<br><input type='checkbox' class='styler' name='mail1' id='mail1' value='1'>Email<br><input type='checkbox' class='styler' id='vib1' name='vib1' value='1'>Viber<br><input type='checkbox' class='styler' id='what1' name='what1' value='1'>WhatsApp<br><input type='checkbox' class='styler' id='teleg1' name='teleg1' value='1'>Telegram<br><input type='checkbox' class='styler' id='mess1' name='mess1' value='1'>Messenger</div>";
    $(check).prependTo("#d5rMod");
    (function($){$(function(){ $('.styler').styler({ selectSearch: true});});})(jQuery);
    $("<p style='margin-left: 40px;'>Средство связи:</p>").prependTo("#d5rMod");

    $('#butButFNow').on('click', function(){
        var tel=0;
        var mail=0;
        var vib=0;
        var what=0;
        var teleg=0;
        var mess=0;
//        if($('#tel1').attr('checked'))tel=1;  //                              $('#siteform input[type="checkbox"]:checked')        input[name="tel1"]
        if($('input[name="tel1"]:checked').val()==='1') tel=1;
        if($('input[name="mail1"]:checked').val()==='1') mail=1;
        if($('input[name="vib1"]:checked').val()==='1') vib=1;
        if($('input[name="what1"]:checked').val()==='1') what=1;
        if($('input[name="teleg1"]:checked').val()==='1') teleg=1;
        if($('input[name="mess1"]:checked').val()==='1') mess=1;
        var str1=$('#audName').val();
        if(sex===0)sex='мужской';
        var str2=sex;
        var str3=$('#dateAud').val();
        var str4=$('#audPhone').val();
        var str5=$('#audEmale').val();
        var str6=$('#audAdres').val();
        var str7=$('#prime4').val();
        var str=str1+"^"+str2+"^"+str3+"^"+str4+"^"+str5+"^"+str6+"^"+tel+"^"+mail+"^"+vib+"^"+what+"^"+teleg+"^"+mess+"^"+str7;
        ajaxFromFirst('aud', 'now', str, 'audN');
    })
}

function contentAudModEdit(){
    $.getJSON(url('ajax_json/user1Aud.json'), function (data) {
        $("<p class='Pd3r'>Ф.И.О.</p><p class='Pd3r'>Пол:</p><p class='Pd3r'>День рождения:</p><p class='Pd3r'>Телефон:</p><p class='Pd3r'>Email:</p><p class='Pd3r'>Адрес:</p>").prependTo('#d3rMod');
        $("<div id='Div_d6r1Mod'><p class='Pd6r' id=primEd>Примечание:</p></div><div id='Div_d6r2Mod'><input type='text' id='prime4'></div>").prependTo('#d6rMod');
        $("<p><input type='text' id='audAdres' title='Адрес'></p>").prependTo('#d4rMod');
        $("<p><input type='text' id='audEmale' title='Email'></p>").prependTo('#d4rMod');
        $("<p><input type='text' id='audPhone' title='Телефон'></p>").prependTo('#d4rMod');
        $('#audPhone').mask("(999) 999-99-99");
        $("<p><input type='text' id='dateAud' title=''></p>").prependTo('#d4rMod');
        $("#dateAud").datepicker({
            dateFormat: "dd.mm.yy",
            monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь',
              'Октябрь', 'Ноябрь', 'Декабрь'],
            dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
            firstDay: 1,
            changeYear: true,
            yearRange: '-100:+3'
        });

        var index=$('#nambP').val();
        var sex1;
        var sex2;
        if(data[index]['pers_sex']==='мужской'){
            sex1='мужской';
            sex2='женский';
        }
        else{
            sex2='мужской';
            sex1='женский';
        }

        $("<p><select class='box' id='sex'><option>"+sex1+"</option><option>"+sex2+"</option></select></p>").prependTo('#d4rMod');
        var sex=0;
        $('#sex').selectmenu({
            width: 335,
            change: function (event, ui) {
                sex=ui.item.label;
            }
        });
        $("<p><input type='text' id='audName' title='ФИО'></p>").prependTo('#d4rMod');
        var check = "<div id='message'><input type='checkbox' class='styler' name='tel2' value='1' id='ch1e'>Телефон<br><input type='checkbox' class='styler' name='mail2' value='1' id='ch2e'>Email<br><input type='checkbox' class='styler' name='vib2' value='1' id='ch3e'>Viber<br><input type='checkbox' class='styler' name='what2' value='1' id='ch4e'>WhatsApp<br><input type='checkbox' class='styler' name='teleg2' value='1' id='ch5e'>Telegram<br><input type='checkbox' class='styler' name='mess2' value='1' id='ch6e'>Messenger</div>";
        $(check).prependTo("#d5rMod");
        $("<p style='margin-left: 40px;'>Средство связи:</p>").prependTo("#d5rMod");

        $('#audName').val(data[index]['pers_name']);
        $('#dateAud').val(data[index]['pers_birth']);
        $('#audPhone').val(data[index]['pers_tel']);
        $('#audEmale').val(data[index]['pers_email']);
        $('#audAdres').val(data[index]['pers_adres']);
        $('#prime4').val(data[index]['pers_prim']);

        if((+data[index]['pers_con_phone'])===1) $('#ch1e').attr({checked:'1'});
        if((+data[index]['pers_con_email'])===1) $('#ch2e').attr({checked:'1'});
        if((+data[index]['pers_con_vib'])===1) $('#ch3e').attr({checked:'1'});
        if((+data[index]['pers_con_whats'])===1) $('#ch4e').attr({checked:'1'});
        if((+data[index]['pers_con_telegr'])===1) $('#ch5e').attr({checked:'1'});
        if((+data[index]['pers_con_mesen'])===1) $('#ch6e').attr({checked:'1'});
        (function($){$(function(){ $('.styler').styler({ selectSearch: true});});})(jQuery);

        $('#butButFNow').on('click', function(){
            var tel=0;
            var mail=0;
            var vib=0;
            var what=0;
            var teleg=0;
            var mess=0;
            if($('input[name="tel2"]:checked').val()==='1') tel=1;
            if($('input[name="mail2"]:checked').val()==='1') mail=1;
            if($('input[name="vib2"]:checked').val()==='1') vib=1;
            if($('input[name="what2"]:checked').val()==='1') what=1;
            if($('input[name="teleg2"]:checked').val()==='1') teleg=1;
            if($('input[name="mess2"]:checked').val()==='1') mess=1;
            var str1=$('#audName').val();
            if(sex===0)sex=sex1;
            var str2=sex;
            var str3=$('#dateAud').val();
            var str4=$('#audPhone').val();
            var str5=$('#audEmale').val();
            var str6=$('#audAdres').val();
            var str7=$('#prime4').val();
            var id_p=data[index]['person_id'];
            var str=str1+"^"+str2+"^"+str3+"^"+str4+"^"+str5+"^"+str6+"^"+tel+"^"+mail+"^"+vib+"^"+what+"^"+teleg+"^"+mess+"^"+str7+"^"+id_p+"^"+index;
            ajaxFromFirst('aud', 'red', str, 'audEd');
        })
    });
}

function contentAutMod () {
    $("<p class='Pd3r'>Ф.И.О.</p><p class='Pd3r'>День рождения:</p><p class='Pd3r'>Псевдоним:</p><p class='Pd3r'>Телефон:</p><p class='Pd3r'>Направление:</p>").prependTo('#d3rMod');
    $("<div id='Div_d6r1Mod'><p class='Pd6r'>Примечание:</p></div><div id='Div_d6r2Mod'><input type='text' id='prime4'></div>").prependTo('#d6rMod');
    $("<p id='autN2' class='Pd4rAut' style='margin-top: 14px;'></p><p id='autN3' class='Pd4rAut' style='margin-top: 14px;'></p><p id='autN4' class='Pd4rAut' style='margin-top: 14px;'></p><p id='autN5' class='Pd4rAut' style='margin-top: 14px;'></p>").prependTo('#d4rMod');

    $.getJSON(url('ajax_json/user1Aud.json'), function(sel){
        fSel=Object.keys(sel).length;
        var strSel="<option value='0'>"+"Выбор..."+"</option>";
        for(i=1; i<fSel; i++){
            strSel=strSel+"<option value='"+sel[i]['person_id']+"'>"+sel[i]['pers_name']+"</option>";
        }
        $("<p class='Pd4rAut'><select class='box' id='str6'>"+strSel+"</select></p>").prependTo('#d4rMod');
        var idName;
        var autNapN=0;
        $('#str6').selectmenu({
            width: 335,
            change: function (event, ui) {
                Name=ui.item.label;
                idName=ui.item.index;
                idAud=ui.item.value;
                $("#autN2, #autN3, #autN4, #autN5").empty();
                $("#autN2").text(sel[idName]['pers_birth']);
                $("<input type='text' id='AutNPs' title='Псевдоним'>").prependTo("#autN3");
                $("#autN4").text(sel[idName]['pers_tel']);
                $.getJSON(url('ajax_json/jsonBD.json'), function (sel) {
                    fSel=Object.keys(sel['autNap']).length;
                    var strSel="<option value='0'>"+"Выбор..."+"</option>";
                    for(i=0; i<fSel; i++){
                        strSel=strSel+"<option value='"+i+"'>"+sel['autNap'][i]+"</option>";
                    }
                    $("<select class='box' id='autNapN'>"+strSel+"</select>").prependTo('#autN5');
                    $('#autNapN').selectmenu({
                        width: 335,
                        change: function (event, ui) {
                            autNapN=ui.item.label;
                        }
                    });
                })
            }
        });
        $("#butButFNow").on('click', function(){
           var str1 = $('#AutNPs').val();
           var str2 = +idAud;
           var str3 = $('#prime4').val();
           if(autNapN===0)autNapN='не выбрано';
           var str4 = autNapN;
           var str=str1+"^"+(+str2)+"^"+str3+"^"+str4;
           ajaxFromFirst('aut', 'now', str, 'autN');
        })
    })
}

function contentAutModEdit(){
    $("<p class='Pd3r'>Ф.И.О.</p><p class='Pd3r'>День рождения:</p><p class='Pd3r'>Псевдоним:</p><p class='Pd3r'>Телефон:</p><p class='Pd3r'>Направление:</p>").prependTo('#d3rMod');
    $("<div id='Div_d6r1Mod'><p class='Pd6r'>Примечание:</p></div><div id='Div_d6r2Mod'><input type='text' id='prime4'></div>").prependTo('#d6rMod');
    $("<p id='autN2' class='Pd4rAut' style='margin-top: 14px;'></p><p id='autN3' class='Pd4rAut' style='margin-top: 14px;'></p><p id='autN4' class='Pd4rAut' style='margin-top: 14px;'></p><p id='autN5' class='Pd4rAut' style='margin-top: 14px;'></p>").prependTo('#d4rMod');
    var index=$("#nambP").val();
    $.getJSON(url('ajax_json/user1Aut.json'), function(sel){

        var autNapE = 0;
        $.getJSON(url('ajax_json/jsonBD.json'), function (sel2) {
            fSel=Object.keys(sel2['autNap']).length;
            var strSel="<option value='0'>"+sel[index]['aut_napr']+"</option>";
            for(i=0; i<fSel; i++){
                if(sel2['autNap'][i]===sel[index]['aut_napr']) continue;
                strSel=strSel+"<option value='"+i+"'>"+sel2['autNap'][i]+"</option>";
            }
            $("<p class='Pd4rAutE'  style='margin-top: 14px;'><select class='box' id='autNapN'>"+strSel+"</select></p>").prependTo('#autN5');
            $('#autNapN').selectmenu({
                width: 335,
                change: function (event, ui) {
                    autNapE=ui.item.label;
                }
            });
        });
        $("<p class='Pd4rAutE'  style='margin-top: 16px;'>"+sel[index]['pers_tel']+"</p>").prependTo('#d4rMod');
        $("<p class='Pd4rAutE'  style='margin-top: 16px;'><input type='text' id='psevd' title='Псевдоним'></p>").prependTo('#d4rMod');
        $("<p class='Pd4rAutE'  style='margin-top: 16px;'>"+sel[index]['pers_birth']+"</p>").prependTo('#d4rMod');
        $("<p class='Pd4rAutE'  style='margin-top: 16px;'>"+sel[index]['pers_name']+"</p>").prependTo('#d4rMod');
        $("#psevd").val(sel[index]['author_name']);
        $("#prime4").val(sel[index]['aut_prim']);

        $('#butButFNow').on('click',function(){
            var str1 = $('#psevd').val();
            if(autNapE===0)autNapE=sel[index]['aut_napr'];
            var str2 = autNapE;
            var str3 = $('#prime4').val();
            var str=str1+'^'+str2+'^'+str3+'^'+index+'^'+sel[index]['author_id'];
            ajaxFromFirst( 'aut', 'red', str, "autEd");
        })
    })
}

function contentObjMod () {
    $("<p class='Pd3r'>Наименование:</p><p class='Pd3r'>Вид:</p><p class='Pd3r'>Материал:</p><p class='Pd3r'>Размер:</p><p class='Pd3r'>Год:</p><p class='Pd3r'>Автор:</p>").prependTo('#d3rMod');
    $("<div id='Div_d6r1Mod'><p class='Pd6r'>Примечание:</p></div><div id='Div_d6r2Mod'><input type='text' id='prime4'></div>").prependTo('#d6rMod');

    $.getJSON(url('pages/authors.php'), 'pAut' ,function (selaut){
        var strSel="<option value='0'>"+"Выбор..."+"</option>";
        for (i=1;i<=selaut[0]['ind'];i++){
            strSel=strSel+"<option value='"+i+"'>"+selaut[i]['author_name']+"</option>";
        }
        $("<p class='Pd4rObj'><select class='box' id='str6'>"+strSel+"</select></p>").prependTo('#d4rMod');
        var str6=0;
        $('#str6').selectmenu({
            width: 335,
            change: function (event, ui) {
                str6=ui.item.label;
            }
        });

        $("<p class='Pd4rObj'><input type='text' class='' id='conObj5'></p>").prependTo('#d4rMod');
        $('#conObj5').mask("9999");
        $("<p class='Pd4rObj'>ш:<input type='text' class='raz' id='conObj4x'>д:<input type='text' class='raz' id='conObj4y'>в:<input type='text' class='raz' id='conObj4z'></p>").prependTo('#d4rMod');

        $('.raz').bind("change keyup input click", function() { //--------------------------- валидация цифр
            if (this.value.match(/[^0-9]/g)) {
                this.value = this.value.replace(/[^0-9]/g, '');
            }
        });

        var  str3=0;
        $.getJSON(url('ajax_json/jsonBD.json'), function (sel) {
            fSel=(Object.keys(sel['objMat']).length);
            var strSel="<option value='0'>"+"Выбор..."+"</option>";
            for(i=0; i<fSel; i++){
            strSel=strSel+"<option value='"+i+"'>"+sel['objMat'][i]+"</option>";
            }
            $("<p class='Pd4rEve'><select class='box' id='str3'>"+strSel+"</select></p>").prependTo('#d4rMod');
            $('#str3').selectmenu({
                width: 335,
                change: function (event, ui) {
                    str3 = ui.item.label;
                }
            });
        });

        var str2=0;
        $.getJSON(url('ajax_json/jsonBD.json'), function (sel) {
            fSel=(Object.keys(sel['objVid']).length);
            var strSel="<option value='0'>"+"Выбор..."+"</option>";
            for(i=0; i<fSel; i++){
                strSel=strSel+"<option value='"+i+"'>"+sel['objVid'][i]+"</option>";
                }

            $("<p class='Pd4rEve'><select class='box' id='str2'>"+strSel+"</select></p>").prependTo('#d4rMod');
            $('#str2').selectmenu({
                width: 335,
                change: function (event, ui) {
                    str2 = ui.item.label;
                }
            });
            $("<p class='Pd4rObj'><input type='text' class='' id='conObj1'></p>").prependTo('#d4rMod');
        });

        $('#butButFNow').on('click', function () {
        str1=$('#conObj1').val();
        if(str2===0)str2='не выбрано';
        if(str3===0)str3='не выбрано';
        if(str6===0)str6='не выбрано';
        str4=$('#conObj4x').val();
        str8=$('#conObj4y').val();
        str9=$('#conObj4z').val();
        str5=$('#conObj5').val();
        str7=$('#prime4').val();
        //--------------------------------------------------// проверка
        var str= str1+"^"+str2+"^"+str3+"^"+str4+"^"+str5+"^"+str6+"^"+str7+"^"+str8+"^"+str9;
        ajaxFromFirst('obj', 'now', str, 'objN');
        })
    });
}

function contentObjModEdit (){
    $.getJSON(url('ajax_json/user1Obj.json'), function (data) {
        $("<p class='Pd3r'>Наименование:</p><p class='Pd3r'>Вид:</p><p class='Pd3r'>Материал:</p><p class='Pd3r'>Размер:</p><p class='Pd3r'>Год:</p><p class='Pd3r'>Автор:</p>").prependTo('#d3rMod');
        $("<div id='Div_d6r1Mod'><p class='Pd6r'>Примечание:</p></div><div id='Div_d6r2Mod'><input type='text' id='prime4'></div>").prependTo('#d6rMod');

        var indCon = $("#nambP").val();

        $.getJSON(url('pages/authors.php'), 'pAut', function (selaut) {
            var strSel = "<option value='0' id='autNE'>" + data[indCon]['author_name'] + "</option>";
            for (i = 1; i <= selaut[0]['ind']; i++) {
                if (selaut[i]['author_name'] === data[indCon]['author_name']) continue;
                strSel = strSel + "<option value='" + i + "'>" + selaut[i]['author_name'] + "</option>";
            }
            $("<p class='Pd4rObj'><select class='box' id='str6'>" + strSel + "</select></p>").prependTo('#d4rMod');
            var str7 = 0;
            $('#str6').selectmenu({
                width: 335,
                change: function (event, ui) {
                    str7 = ui.item.label;
                }
            });

            $("<p class='Pd4rObj'><input type='text' class='' id='conObj5'></p>").prependTo('#d4rMod');
            $('#conObj5').mask("9999");
            $("<p class='Pd4rObj'>ш:<input type='text' class='raz' id='conObj4x'>д:<input type='text' class='raz' id='conObj4y'>в:<input type='text' class='raz' id='conObj4z'></p>").prependTo('#d4rMod');

            $('.raz').bind("change keyup input click", function () { //--------------------------- валидация цифр
                if (this.value.match(/[^0-9]/g)) {
                    this.value = this.value.replace(/[^0-9]/g, '');
                }
            });

            var str3 = 0;
            var str2 = 0;
            $.getJSON(url('ajax_json/jsonBD.json'), function (sel) {
                fSel = (Object.keys(sel['objMat']).length);
                var strSel = "<option value='0'>" + data[indCon]['subj_mat'] + "</option>";
                for (i = 0; i < fSel; i++) {
                    if (sel['objMat'][i] === data[indCon]['subj_mat']) continue;
                    strSel = strSel + "<option value='" + i + "'>" + sel['objMat'][i] + "</option>";
                }
                $("<p class='Pd4rEve'><select class='box' id='str3'>" + strSel + "</select></p>").prependTo('#d4rMod');
                $('#str3').selectmenu({
                    width: 335,
                    change: function (event, ui) {
                        str3 = ui.item.label;
                    }
                });

                fSel = (Object.keys(sel['objVid']).length);
                var strSel2 = "<option value='0'>" + data[indCon]['subj_vid'] + "</option>";
                for (i = 0; i < fSel; i++) {
                    if (sel['objVid'][i] === data[indCon]['subj_vid']) {
                        continue;
                    }
                    strSel2 = strSel2 + "<option value='" + (+i + 1) + "'>" + sel['objVid'][i] + "</option>";
                }

                $("<p class='Pd4rEve'><select class='box' id='str2'>" + strSel2 + "</select></p>").prependTo('#d4rMod');
                $('#str2').selectmenu({
                    width: 335,
                    change: function (event, ui) {
                        str2 = ui.item.label;
                    }
                });
                $("<p class='Pd4rObj'><input type='text' class='' id='conObj1' value='" + data[indCon]['subj_name'] + "'></p>").prependTo('#d4rMod');

            });

            $.getJSON(url('ajax_json/user1Obj.json'), function (sel) {
                var index = $("#nambP").val();
                $('#conObj4x').val(sel[index]['subj_razmX']);
                $('#conObj4y').val(sel[index]['subj_razmY']);
                $('#conObj4z').val(sel[index]['subj_razmZ']);
                $('#conObj5').val(sel[index]['subj_b_date']);
                $('#prime4').val(sel[index]['subj_prim']);

            });

            $('#butButFNow').on('click', function () {
                str1 = $('#conObj1').val();
                if (str2 === 0) str2 = data[indCon]['subj_vid'];
                if (str3 === 0) str3 = data[indCon]['subj_mat'];
                str4 = $('#conObj4x').val();
                str5 = $('#conObj4y').val();
                str6 = $('#conObj4z').val();
                if (str7 === 0) str7 = data[indCon]['author_name'];
                str8 = $('#conObj5').val();
                str9 = $('#prime4').val();
                str10 = data[indCon]['subj_id'];
//            //--------------------------------------------------// проверка
                var str = str1 + "^" + str2 + "^" + str3 + "^" + str4 + "^" + str5 + "^" + str6 + "^" + str7 + "^" + str8 + "^" + str9 + "^" + str10 + "^" + indCon;
                ajaxFromFirst('obj', 'red', str, 'objEd');

            })
        });
    })
}

function contentEveMod () {
    $("<p class='Pd3r'>Наименование:</p><p class='Pd3r'>Мероприятие:</p><p class='Pd3r'>Дата:</p><p class='Pd3r'>Адрес:</p><p class='Pd3r'></p>").prependTo('#d3rMod');
    $("<div id='Div_d6r1Mod'><p class='Pd6r'>Примечание:</p></div><div id='Div_d6r2Mod'><input type='text' id='prime4'></div>").prependTo('#d6rMod');
    var fSel;
    $.getJSON(url('ajax_json/jsonBD.json'), function (sel) {
        fSel=(Object.keys(sel['eveVid']).length);
        var strSel="<option value='0'>"+"Выбор..."+"</option>";
        for(i=0; i<fSel; i++){
            strSel=strSel+"<option value='"+i+"'>"+sel['eveVid'][i]+"</option>";
        }
        $("<p class='Pd4rEve'><input type='text' class='' id='conEve4'></p>").prependTo('#d4rMod');
        $("<p><input type='text' id='dateEve' title=''></p>").prependTo('#d4rMod');
        $("#dateEve").datepicker({
            dateFormat: "dd.mm.yy",
            monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь',
                'Октябрь', 'Ноябрь', 'Декабрь'],
            dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
            firstDay: 1,
            changeYear: true,
            yearRange: '-100:+3'
        });
        $("<p class='Pd4rEve'><select class='box' id='conEve2'>"+strSel+"</select></p>").prependTo('#d4rMod');
        var str2=0;
        $('.box').selectmenu({
            width: 335,
            change: function (event, ui) {
                str2=ui.item.label;
            }
        });
        $("<p class='Pd4rEve'><input type='text' class='' id='conEve1'></p>").prependTo('#d4rMod');
        $('#butButFNow').on('click', function () {

            var str1=$('#conEve1').val();
            if (str2===0)str2='не выбрано';
            var str3=$('#dateEve').val();
            var str4=$('#conEve4').val();
            var str5=$('#prime4').val();
            //--------------------------------------------------// проверка
            var dataFormEN =str1+"^"+str2+"^"+str3+"^"+str4+"^"+str5;

            ajaxFromFirst('eve','now', dataFormEN, 'eveN');
        });
    })
}

function contentEveModEdit (){
    $.getJSON(url('ajax_json/user1Eve.json'), function (data) {
        $("<p class='Pd3r'>Наименование:</p><p class='Pd3r'>Мероприятие:</p><p class='Pd3r'>Дата:</p><p class='Pd3r'>Адрес:</p><p class='Pd3r'></p>").prependTo('#d3rMod');
        $("<div id='Div_d6r1Mod'><p class='Pd6r'>Примечание:</p></div><div id='Div_d6r2Mod'><input type='text' id='prime4'></div>").prependTo('#d6rMod');

        var indCon = $("#nambP").val();
        var fSel;
        $.getJSON(url('ajax_json/jsonBD.json'), function (sel) {
            fSel = (Object.keys(sel['eveVid']).length);
            var strSel = "<option value='0'>" + data[indCon]['event_vid'] + "</option>";
            for (i = 0; i < fSel; i++) {
                if (sel['eveVid'][i] === data[indCon]['event_vid']) {
                    continue;
                }
                strSel = strSel + "<option value='" + i + "'>" + sel['eveVid'][i] + "</option>";
            }
            $("<p class='Pd4rEve'><input type='text' class='' id='conEve4'></p>").prependTo('#d4rMod');
            $("<p><input type='text' id='dateEve' title=''></p>").prependTo('#d4rMod');
            $("#dateEve").datepicker({
                dateFormat: "dd.mm.yy",
                monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь',
                    'Октябрь', 'Ноябрь', 'Декабрь'],
                dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
                firstDay: 1,
                changeYear: true,
                yearRange: '-100:+3'
            }).val(data[indCon]['event_date']);
            $("<p class='Pd4rEve'><select class='box' id='conEve2'>" + strSel + "</select></p>").prependTo('#d4rMod');
            var str2 = 0;
            $('.box').selectmenu({
                width: 335,
                change: function (event, ui) {
                    str2 = ui.item.label;
                }
            });
            $("<p class='Pd4rEve'><input type='text' class='' id='conEve1'></p>").prependTo('#d4rMod');

            $('#conEve1').val(data[indCon]['event_name']);
            $('#conEve4').val(data[indCon]['event_addr']);
            $('#prime4').val(data[indCon]['event_prim']);

            $('#butButFNow').on('click', function () {

                var str1 = $('#conEve1').val();
                if (str2 === 0) str2 = data[indCon]['event_vid'];
                var str3 = $('#dateEve').val();
                var str4 = $('#conEve4').val();
                var str5 = $('#prime4').val();
                //--------------------------------------------------// проверка
                var dataFormEN = str1 + "^" + str2 + "^" + str3 + "^" + str4 + "^" + str5 + "^" + data[indCon]['event_id'] + "^" + indCon;
                ajaxFromFirst('eve', 'red', dataFormEN, 'eveEd');
            });
        })
    })
}

function exitMod() {
    $('#overlay, #butBack').click(function () {
        $('.modal_form').animate({opacity: 0, top: '45%'}, 200,
            function () {
                $(this).css('display', 'none');
                $('#overlay').fadeOut(400);
                $('#thirdMod').css({overflow: ""});
            }
        );
    });
}

function print() {
    $('#butPrint').click(function () {
        Popup($('#thirdMod').html());
        function PrintElem(elem){
            Popup($(elem).html());
        }
        function Popup(data){
            var mywindow = window.open('', 'my div', 'height=600, width=900');
            mywindow.document.write('<html><head><div id="dPrint1" style="font-size: xx-large; text-align: center">АРТПОРТ</div><div id="dPrint2" style="text-align: center"><b class="b_logo">ГАЛЕРЕЯ</b><b class="b_logo"> СОВРЕМЕННОГО</b><b class="b_logo"> ИСКУСТВА</b><hr></div>');
            mywindow.document.write('<style>th{border: solid 1px #C7C7C7;} td{ border: solid 1px #B0BED9;}</style>');
            mywindow.document.write('</head><body >');
            mywindow.document.write(data);
            mywindow.document.write('</body></html>');
            mywindow.document.close(); // для IE >= 10
            mywindow.focus();          // для IE >= 10
            mywindow.print();
            mywindow.close();
//            return true;
        }
    })
}

$('#exit').on('click', function(){
    $(location).attr('href','index.php');
    });

function saerch(data, from) {
    $('#search').empty();
    $('<input type="text" title="Поиск" id="txtSerch" style="font-size: 16px"><input type="button" value="&#128269" id="butSearch" class="button">').prependTo('#search');
    var arrey = [];
    var lengthD = Object.keys(data).length;
    for (i = 1; i < lengthD; i++) {
        subjArrS = {label: data[+i][from], value: data[+i]};
        arrey[+i - 1] = data[+i][from];
    }
    $('#txtSerch').autocomplete({
        source : arrey,
//        delay: 500,
        minLength: 2
    });
}
</script>

