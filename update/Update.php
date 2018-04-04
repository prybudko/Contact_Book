<?php
require_once '../classes/DBConnect.php';
error_reporting(0);
class Update {
    public function updateInformation(){
            $db = new DBConnect();
            $db->connectToDataBase();
            $data_json = json_decode($_POST['json'],true);
            $name = mysqli_real_escape_string($db->mysqli, $data_json['name']);
            $birthday = mysqli_real_escape_string($db->mysqli, $data_json['birthday']);
            $phone = mysqli_real_escape_string($db->mysqli, $data_json['phone']);
            $email = mysqli_real_escape_string($db->mysqli, $data_json['email']);
            $id = (int)mysqli_real_escape_string($db->mysqli, $data_json['id']);
            $query = "update ContactTable set name = '$name', birthday = '$birthday', phone = '$phone', email = '$email' where id = '$id'";
            $result = mysqli_query($db->mysqli, $query) or die('not done');
            mysqli_close($db->mysqli);
            $json = json_encode($data_json);
            echo $json;

        }
    }
$update = new Update();
$update->updateInformation();


