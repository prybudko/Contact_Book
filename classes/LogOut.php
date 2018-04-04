<?php
require_once '../classes/DBConnect.php';
session_start();
class LogOut
{
    function getlogOut(){
        setcookie("id", "", time() - 3600);
        setcookie("hash", "", time() - 3600);
        $this->deleteHash();
        session_destroy();
        header('Location: ../index.php');
    }
    function deleteHash(){
        $db = new DBConnect();
        $db->connectToDataBase();
        $hash = "";
        $query = "UPDATE users SET userHash='".$hash."'  WHERE userId='".$_SESSION['login']."'";
        mysqli_query($db->mysqli, $query);
    }
}
$logOut = new LogOut();
$logOut->getlogOut();