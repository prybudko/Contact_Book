<?php
if (!empty($_POST)){
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Форма регистрации</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="shortcut icon" href="../images/favicon.gif" />
    <link rel="stylesheet" type="text/css" href="registrationCSS.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
    <script src="AjaxRegister.js"></script>
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
    <form id="ajaxForm">
        <section class="container one">
            <p ><label for="user_name">Логин</label>
                <input name="login"  title="login" required><span></span></p>

            <p><label for="email">Эл. почта</label>
                <input type="email" name="email" title="email" required><span></span></p>

            <p><label for="password">Пароль</label>
                <input type="password" name="password" title="password" required><span></span></p>

            <p><label for="password">Повторите</label>
                <input type="password" name="password2" title="password2" required><span></span></p>
        </section>

        <section class="container two">
            <button class="button" name="submit">Зарегистрироваться</button>
        </section>
    </form>
    <div id = "divError"></div>
</div>

<div id="footer">
    <div align="center" class="foot"> <span>Contact Book</span> by <a target="_blank" href="https://github.com/prybudko">Prybudko R. </div>
</div>
<!--Footer END-->
</body>
</html