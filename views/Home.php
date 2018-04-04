<?php
require_once '../classes/Contact.php';
$contact = new Contact();
if(!isset($_SESSION['login'])) {
    echo "<h3>У Вас нет доступа.</h3>";
    exit;
}else{
    if (!empty($_POST)) {
        $contact->saveContact();
        header('Location: Home.php');
        exit;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>ContactBook</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="shortcut icon" href="../images/favicon.gif" />
    <link rel="stylesheet" type="text/css" href="viewsCSS.css"/>
</head>

<body>
<!--Header Begin-->
<div id="header">
    <div class="center">
        <div id="logo"><a target="_blank" href="https://github.com/prybudko">Contact Book</a></div>
        <!--Menu Begin-->
        <div id="menu">
            <ul>
                <li><a class="active"><span>Home</span></a></li>
                <li><a href="NewContact.php"><span>New Contact</span></a></li>
                <li><a href="MyContact.php"><span>My Contact</span></a></li>
            </ul>
        </div>
        <!--Menu END-->
    </div>
</div>
<!--Header END-->
<!--Toprow Begin-->
<div id="toprow">
    <div class="center">
        <br>
    </div>
    <form class="formMargin" action="../classes/LogOut.php">
        <h2 align="center">Здравствуй, <?=$_SESSION['userLogin'];?>!
            <br>Этот сайт поможет тебе сохранять и редактировать свои контакты в удобной форме</h2>
        <h4>С помощью кнопок меню, ты можеш выбрать какие действия совершить:</h4>
        <h3>Home - перейти на домашнюю страницу;</h3>
        <h3>New Contact - создать новый контакт;</h3>
        <h3>My Contact - просмотреть список своих контактов.</h3>
        <button class="button" name="logOut" value="logOut">Выйти</button>
    </form>
</div>

<div id="footer">
    <div align="center" class="foot"> <span>Contact Book</span> by <a target="_blank" href="https://github.com/prybudko">Prybudko R. </div>
</div>
<!--Footer END-->
</body>
</html>