<?php
require_once 'classes/DBConnect.php';

session_start();
class Entrance
{
    //Функция для генерации случайной строки
    function generateCode($length=6) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clean = strlen($chars) - 1;
        while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clean)];
        }
        return $code;
    }

    function entranceInContactBook(){

        if (isset($_POST['register'])){
            header("Location: registration/registration.php");

        }else {
            // Соединямся с БД
            $db = new DBConnect();
            $db->connectToDataBase();

            if (isset($_POST['submit'])) {
                // Вытаскиваем из БД запись, у которой логин равняеться введенному
                $query = "SELECT userId, userPassword FROM users WHERE userLogin='" . mysqli_real_escape_string($db->mysqli, $_POST['login']) . "' LIMIT 1";
                $result = mysqli_query($db->mysqli, $query) or die('not done');
                $data = mysqli_fetch_assoc($result);
                // Соавниваем пароли
                if ($data['userPassword'] === md5(md5($_POST['password']))) {
                    // Генерируем случайное число и шифруем его
                    $hash = md5($this->generateCode(10));
                    // Записываем в БД новый хеш авторизации
                    $query = "UPDATE users SET userHash='" . $hash . "'  WHERE userId='" . $data['userId'] . "'";
                    mysqli_query($db->mysqli, $query);
                    // Ставим куки
                    setcookie("id", $data['userId'], time() + 60 * 60 * 24 * 30);
                    setcookie("hash", $hash, time() + 60 * 60 * 24 * 30);
                    $_SESSION['userLogin'] = $_POST['login'];
                    $_SESSION['login'] = $this->getUserId($_POST['login']);
                    header("Location: ../ContactBook/views/Home.php");
                } else {
                    $_SESSION['error'] = 'error';
                    header("Location: index.php");
                    //print "Вы ввели неправильный логин/пароль";
                }
            }
        }
    }
    function getUserId($login){
        $db = new DBConnect();
        $db->connectToDataBase();
        $queryId = "SELECT userId FROM users WHERE userLogin='" .mysqli_real_escape_string($db->mysqli, $login) . "'";
        $resultId = mysqli_query($db->mysqli, $queryId) or die('not done');
        $id = mysqli_fetch_all($resultId, MYSQLI_ASSOC);
        return $id[0]['userId'];
    }

}
