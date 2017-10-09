<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
$sss=$_SESSION['gal'];//-------------------------Разобраться
include "../styleHtml/header.php";
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Меню</title>
    <link href="../style/all_work_style.css" rel="stylesheet"/>
    <script src="../javascript/jquery-3.2.0.js"></script>
</head>
<body>
<div id="div_center">
    <div id="all6div">
        <div class="firstPD" id="d1">Аудитория</div>
        <div class="firstPD" id="d2">Авторы</div>
        <div class="firstPD" id="d3">Объекты</div>
        <div class="firstPD" id="d4">Мероприятия</div>
        <div class="firstPD" id="d5">Отчёты</div>
        <div class="firstPD" id="d6_req">Запросы</div>
    </div>
    <div id="second">Запросы</div>
</div>
</body>
</html>

<script>
    $('#d1').click(function(){
        window.location.href = "auditoria.php";
    });

    $('#d2').click(function(){
        window.location.href = "autors.php";
    });

    $('#d3').click(function(){
        window.location.href = "object.php";
    });

    $('#d4').click(function(){
        window.location.href = "events.php";
    });

    $('#d5').click(function(){
        window.location.href = "reports.php";
    });

    $('#d6_req').attr({style: "background-color: #A2C8EB;"});
</script>