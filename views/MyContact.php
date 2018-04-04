<?php
require_once '../classes/Contact.php';
$contact = new Contact();
if(!isset($_SESSION['login'])) {
    echo "<h3>У Вас нет доступа.</h3>";
    exit;
}else{if (!empty($_POST)){
    header('Location: MyContact.php');
    exit;
}
}
$contact = $contact->getContact();
?>
<!doctype html>
<html lang="en">
<head>
    <title>ContactBook</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="shortcut icon" href="../images/favicon.gif" />
    <link rel="stylesheet" type="text/css" href="viewsCSS.css" />
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
                <li><a href="NewContact.php"><span>New Contact</span></a></li>
                <li><a class="active" href="MyContact.php"><span>My Contact</span></a></li>
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
    <form class="formMargin" action="../update/Update.php" method="post">
        <?php if(!empty($contact)): ?>
        <?php foreach ($contact as $item):?>
        <ul>
            <a href = "../update/UpdateHTML.php?id=<?=$item['id'];?>">
             <h4>
                 <li>
                    Имя: <?=$item['name']?> || Телефон: <?=nl2br(htmlspecialchars($item['phone']))?>
                 </li>
             </h4>
            </a>
        </ul>
        <?php endforeach;?>
        <?php else: ?>
            <h4>У Вас еще нет записанных контактов.</h4>
        <?php endif;?>
        <input class="button" type="button" value="На главную" onClick='location.href="Home.php"'>
    </form>
</div>

<div id="footer">
    <div align="center" class="foot"> <span>Contact Book</span> by <a target="_blank" href="https://github.com/prybudko">Prybudko R. </div>
</div>
<!--Footer END-->
</body>
</html>