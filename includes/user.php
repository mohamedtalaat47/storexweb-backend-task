<?php

include_once('db.php');
class user extends dbconnect
{

    public function __construct()
    {
        parent::__construct();
    }

    public function UserRegister($username, $emailid, $password, $birthday)
    {
        $password = md5($password);
        $qr = "INSERT INTO users(name, email, password, birthday) values('" . $username . "','" . $emailid . "','" . $password . "','" . $birthday . "')";
        $result = $this->connection->query($qr);
        return $result;
    }
    public function Login($emailid, $password)
    {
        $qr = "SELECT * FROM users WHERE email = '" . $emailid . "' AND password = '" . md5($password) . "'";
        $result = $this->connection->query($qr); 
        $no_rows = mysqli_num_rows($result);

        if ($no_rows == 1) {
            session_start();
            $user = mysqli_fetch_array($result);

            $_SESSION['login'] = true;
            $_SESSION['username'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function isUserExist($emailid)
    {
        $qr = "SELECT * FROM users WHERE email = '" . $emailid . "'";
        $result = $this->connection->query($qr);
        $row = mysqli_num_rows($result);
        
        if ($row > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function logOut()
    {
        unset($_SESSION['login']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
    }
}
