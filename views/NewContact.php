<?php
require_once '../classes/Contact.php';
if(!isset($_SESSION['login'])) {
    echo "<h3>У Вас нет доступа.</h3>";
    exit;
}else {
    if (!empty($_POST)) {
        header('Location: NewContact.php');
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
        <div id="logo"><a href="#">Contact Book</a></div>
        <!--Menu Begin-->
        <div id="menu">
            <ul>
                <li><a href="Home.php"><span>Home</span></a></li>
                <li><a class="active" href="NewContact.php"><span>New Contact</span></a></li>
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
    <form class="formMargin" action="Home.php" method="post">
        <h3>Имя:</h3>
        <input name = "name" title = "name" required>
        <h3>День рождения:</h3>
        <input name = "birthday" title = "birthday" required>
        <h3>Телефон:</h3>
        <input name = "phone" title = "phone" required>
        <h3>Email:</h3>
        <input type="email" name = "email" title = "email" required><br><br>
        <button class="button" name = "submit" >Сохранить контакт</button>
    </form>
</div>

<div id="footer">
    <div align="center" class="foot"> <span>Contact Book</span> by <a target="_blank" href="https://github.com/prybudko">Prybudko R. </div>
</div>
<!--Footer END-->
</body>
</html>

