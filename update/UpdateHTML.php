<?php
require_once '../classes/Contact.php';
if(!isset($_SESSION['login'])) {
    echo "<h3>У Вас нет доступа.</h3>";
    exit;
}else {
    if (empty($_GET)) {
        header("Location: UpdateHTML.php?id={$_GET['id']}");
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
    <link rel="stylesheet" type="text/css" href="updateCSS.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
    <script src="AjaxUpdate.js"></script>
    <script>
        function firstLoad() {
            <?php
            $contact = new Contact();
            $contacts = $contact->getContactById($_GET['id']);
            if(!empty($contacts)):?>
            <?php foreach ($contacts as $item):?>
            document.getElementById("name").value = "<?=$item['name']?>";
            document.getElementById("birthday").value = "<?=$item['birthday']?>";
            document.getElementById("phone").value = "<?=$item['phone']?>";
            document.getElementById("email").value = "<?=$item['email']?>";
            document.getElementById("hidden").value = "<?=$item['id']?>";
            <?php endforeach;?>
            <?php endif;?>
        }
    </script>
</head>

<body onload="firstLoad()">
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
        <br>
    </div>
    <form class="formMargin" id = "ajaxForm">
        Имя:<br>
        <input id = "name" name = "name" title = "name"  required><br>
        <br>День рождения:<br>
        <input id = "birthday" name = "birthday" title = "birthday"  required><br>
        <br>Телефон:<br>
        <input id = "phone" name = "phone" title = "phone"  required><br>
        <br>Email:<br>
        <input id = "email" type="email" name = "email" title = "email"  required><br><br>

        <input id = "hidden" type="hidden" name = "id" title = "id" >

        <input class="button" type="submit" name="submit" value="Изменить контакт">

        <input class="button" type="button" value="Назад" onClick='location.href="../views/MyContact.php"'>
        <div id="successDiv"><h3>Изменение прошло успешно</h3></div>
    </form>
</div>

<div id="footer">
    <div align="center" class="foot"> <span>Contact Book</span> by <a target="_blank" href="https://github.com/prybudko">Prybudko R. </div>
</div>
<!--Footer END-->
</body>
</html>
