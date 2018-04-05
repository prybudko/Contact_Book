<?php
require_once '../classes/DBConnect.php';
require_once '../Entrance.php';
class Register
{
    private $db;
    private $err;
    function __construct()
    {
        $this->db = new DBConnect();
        $this->db -> connectToDataBase();
    }

    function registerUser(){

        if (isset($_POST))
        {
            // проверям логин
            $this->checkCorrectLogin();
            // проверяем, не сущестует ли пользователя с таким именем
            $this->checkLogin();
            // проверяем существование пользователя с таким email
            $this->checkEmail();
            // проверяем на идентичность два введенных пароля
            $this->checkPassword();
            // Если нет ошибок, то добавляем в БД нового пользователя

            if (!is_array($this->err)) {
                $login = $_POST['login'];
                $email = $_POST['email'];


                // Делаем двойное шифрование
                $password = md5(md5($_POST['password']));
                // Добавляем нового пользователя
                $query = "INSERT INTO users SET userLogin='" . $login . "', userPassword='" . $password . "', email='" . $email . "'";
                $result = mysqli_query($this->db->mysqli, $query) or die('not done2');

                // Узнаем id добавленного пользователя
                $query = "SELECT userId FROM users WHERE userLogin='" . mysqli_real_escape_string($this->db->mysqli, $_POST['login']) . "' LIMIT 1";
                $result = mysqli_query($this->db->mysqli, $query) or die('not done');
                $data = mysqli_fetch_assoc($result);

                //Делаем для того, чтобы сразу зайти на домашнюю страницу
                $entrance = new Entrance();

                // Генерируем случайное число и шифруем его
                $hash = md5($entrance->generateCode(10));

                // Записываем в БД новый хеш авторизации
                $query = "UPDATE users SET userHash='" . $hash . "'  WHERE userId='" . $data['userId'] . "'";
                mysqli_query($this->db->mysqli, $query);

                // Ставим куки
                setcookie("id", $data['userId'], time() + 60 * 60 * 24 * 30);
                setcookie("hash", $hash, time() + 60 * 60 * 24 * 30);
                $_SESSION['userLogin'] = $login;
                $_SESSION['login'] = $entrance->getUserId($login);
                $this->sendEmail();
            } else {
                echo "<b>При регистрации произошли следующие ошибки:</b><br>";
              foreach ($this->err AS $error) {
                 echo $error . "<br>";
                }
            }
        }
    }

    function checkCorrectLogin(){
        if (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['login']))
        {
            $this->err[] = "Логин может состоять только из букв английского алфавита и цифр";
        }
        if (strlen($_POST['login']) < 3 or strlen($_POST['login']) > 15) {
            $this->err[] = "Логин должен быть не меньше 3-х символов и не больше 15";
        }

    }
    function checkPassword(){

        if($_POST['password'] != $_POST['password2']){
            $this->err[] = "Неверно введённый пароль";

        }

    }
    function checkEmail(){

        $queryEmail = "SELECT userId FROM users WHERE email='" . mysqli_real_escape_string($this->db->mysqli, $_POST['email']) . "'";
        $resultEmail = mysqli_query($this->db->mysqli, $queryEmail) or die('not done1');
        if (mysqli_num_rows($resultEmail) > 0) {
            $this->err[] = "Пользователь с такой почтой уже существует в базе данных";

        }

    }
    function checkLogin(){

        $queryId = "SELECT userId FROM users WHERE userLogin='" . mysqli_real_escape_string($this->db->mysqli, $_POST['login']) . "'";
        $resultId = mysqli_query($this->db->mysqli, $queryId) or die('not done1');
        if (mysqli_num_rows($resultId) > 0) {
            $this->err[] = "Пользователь с таким логином уже существует в базе данных";
        }

    }
    function sendEmail(){
        $db = new DBConnect();
        $db->connectToDataBase();
        $query = "SELECT email FROM users WHERE userLogin='" . mysqli_real_escape_string($db->mysqli, $_POST['login']) . "'";
        $result = mysqli_query($db->mysqli, $query) or die('not done');
        $data = mysqli_fetch_assoc($result);
        $userEmail = $data['email'];
        $subject = "Регистрация на сайте \"Contact Book\"";
        $message = "Привет. Вы успешно зарегистрировались на сайте.";
        $headers  = "Content-type: text/html; charset=utf-8 \r\n";
        mail($userEmail, $subject, $message, $headers);
    }
}
$register = new Register();
$register->registerUser();


