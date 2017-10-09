<?php
if(empty($_SESSION['d'])){
    session_start();
    $aaa=$_SESSION['d'];
    unset($_SESSION['d']);
}
?>

<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
    <link href="style/login.css" rel="stylesheet"/>
    <script src="javascript/jquery-3.2.1.min.js"></script>
</head>
<body>

<div id="login">
    <form name='logpas' id="logpas" action='af_index.php' method='POST'>
        <span>&#128274;</span>
        <input type='text' id='user' placeholder='Логин' name='log_'>
        <span>&#128273;</span>
        <input type='password' id='pass' placeholder='Пароль' name='pass_'>
        <div id='img'></div>
        <input type="hidden" name="cp" id="cp" value="">
        <input type="hidden" name="cpen" id="cpen" value="">
        <input type='text' class='capcha' id="capcha" name='capcha_'>
        <input type='button' id="but" class="sm" value='Войти'>
    </form>
    <p><a href="firstP.php" style="font-size: 30px;">Вход без пароля</a></p>
</div>
</body>
<?php
if($aaa==1)
    echo "<script>alert ('Не верный логин пароль !!!')</script>";//-------------------------Разобраться
?>
<script src="javascript/logpas.js"></script>
</html>


