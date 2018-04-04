<?php
require_once 'DBConnect.php';
session_start();
class Contact
{
    private $DBConnect;
    function __construct()
    {
        $this->DBConnect = new DBConnect();
        $this->DBConnect->connectToDataBase();

    }

    function saveContact()
    {
        $name = mysqli_real_escape_string($this->DBConnect->mysqli, $_POST['name']);
        $userId = $_SESSION['login'];
        $birthday = mysqli_real_escape_string($this->DBConnect->mysqli, $_POST['birthday']);
        $phone = mysqli_real_escape_string($this->DBConnect->mysqli, $_POST['phone']);
        $email = mysqli_real_escape_string($this->DBConnect->mysqli, $_POST['email']);
        $query = "insert into ContactTable (name, userId, birthday, phone, email) values ('$name', '$userId', '$birthday', '$phone', '$email')";
        $result = mysqli_query($this->DBConnect->mysqli, $query) or die('not done');
        mysqli_close($this->DBConnect->mysqli);
    }

    function getContact()
    {
        $db = new DBConnect();
        $db->connectToDataBase();
        $user = $_SESSION['login'];
        $query = "select * from ContactTable where userId = {$user}";
        $res = mysqli_query($this->DBConnect->mysqli, $query);
        return mysqli_fetch_all($res, MYSQLI_ASSOC);
    }

    function getContactById($id){
        $db = new DBConnect();
        $db->connectToDataBase();
        $query = "select * from ContactTable where id = {$id}";
        $res = mysqli_query($this->DBConnect->mysqli, $query);
        return mysqli_fetch_all($res, MYSQLI_ASSOC);
    }
}


