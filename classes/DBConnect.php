<?php
class DBConnect
{
    private static $host = 'localhost'; // адрес сервера
    private static $database = 'Contact'; // имя базы данных
    private static $user = 'root'; // имя пользователя
    private static $password = ''; // пароль
    public $mysqli;

    public function connectToDataBase()
    {
        $this->mysqli = new mysqli(self::$host, self::$user, self::$password, self::$database);
        if (mysqli_connect_error()) {
            die('Ошибка подключения (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error());
        }
    }
}
