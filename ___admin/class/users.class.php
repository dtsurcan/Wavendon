<?php
require_once "DB.class.php";

class Users extends DB
{
    private $select = "SELECT id, name, password, type FROM users ";

    //User
    public $id = "";
    public $name = "";
    public $password = "";
    public $type = "";

    //Get user data by ID
    public function getUserDataById($id) {
        $DBH = $this->DBH;
        $query = $this->select . "WHERE id = " . $id . " LIMIT 1";
        $STH = $DBH->query($query);
        if($STH->rowCount() > 0) {
            $this->setParam($STH);
            return true;
        } else {
            return false;
        }
    }

    //Get user data by LOGIN and PASSWORD
    public function getUserDataByLogin($login, $password = "") {
        $DBH = $this->DBH;
        $query = $this->select . "WHERE (name = '" . $login . "')";
        if ($password != "") {
            $query .= " AND (password = '" . $password . "') LIMIT 1";
        }
        $STH = $DBH->query($query);
        if($STH->rowCount() > 0) {
            $this->setParam($STH);
            return true;
        } else {
            return false;
        }
    }

    public function checkUser($login, $password) {
        if($this->getUserDataByLogin($login, $password)) {
            $_SESSION["user_id"] = $this->id;
            $_SESSION["user_login"] = $this->name;
            $_SESSION["user_password"] = $this->password;
        }
    }

    public function addUser($login, $password) {
        $DBH = $this->DBH;
        $query = "INSERT INTO users (name, password) values ('$login', '$password')";
        $STH = $DBH->prepare($query);
        if($STH->execute()){
            return true;
        } else {
            return false;
        }
    }

    private function setParam($STH) {
        while($row = $STH->fetch()) {
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->password = $row['password'];
            $this->type = $row['type'];
        }
    }

    public function userLogout($id) {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_login']);
        unset($_SESSION['user_password']);
    }
}
?>