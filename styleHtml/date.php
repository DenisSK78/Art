<?php
//header('Content-Type: text/html; charset=utf-8');
?>
<head>
    <link href="../style/jquery-ui.min.css" rel="stylesheet"/>
    <script src="../formstyler/jquery-3.2.1.min.js"></script>
    <script src="../javascript/jquery-ui.min.js"></script>
</head>
<script>
    $( function() {
        $( "#jform_mydate" ).datepicker({
            dateFormat: "dd.mm.yy",
            monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь',
                'Октябрь', 'Ноябрь', 'Декабрь'],
            dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
            firstDay: 1
            //            changeMonth: true,
            changeYear: true,
            yearRange: '-100:+3'
        });
    } );
</script>
<style>
    #jform_mydate{
        font-size: 20px;
        width: 335px;
        font-family: "Avant Garde", Avantgarde, "Century Gothic", CenturyGothic, "AppleGothic", sans-serif;
    }

</style>
<input type="text" id="jform_mydate" title="">
