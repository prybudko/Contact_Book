<?php
require_once 'Entrance.php';
if (!empty($_POST)){
    $entrance = new Entrance();
    $entrance->entranceInContactBook();
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Форма регистрации</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="shortcut icon" href="images/favicon.gif" />
    <link rel="stylesheet" type="text/css" href="indexCSS.css"/>
</head>

<body>
<!--Header Begin-->
<div id="header">
    <div class="center">
        <div id="logo"><a href="#">Contact Book</a></div>
    </div>
</div>
<!--Header END-->
<!--Toprow Begin-->
<div id="toprow">
    <div class="center">

    </div>
    <form class="formMargin" method="post">
        <section class="container one">
            <p ><label for="user_name">Логин</label>
                <input name="login"  title="login"><span></span></p>

            <p><label for="password">Пароль</label>
                <input type="password" name="password" title="password"><span></span></p>

        </section>
        <section class="container two">
            <button name="submit">Войти</button>
            <button name="register">Зарегестрироваться</button>
        </section>
    </form>
    <?php if(isset($_SESSION['error'])):?>
        <div><h3>Вы ввели неправильный логин/пароль</h3></div>
    <?php
    session_destroy();
    endif;?>
</div>

<div id="footer">
    <div align="center" class="foot"> <span>Contact Book</span> by <a target="_blank" href="https://github.com/prybudko">Prybudko R. </div>
</div>
<!--Footer END-->
</body>
</html