<?php

class LoginUser{
    private $username;
    private $password;
    public $error;
    public $success;
    private $storage = "UserData.json";
    private $stored_users;

    public function __construct(string $username, string $password){
        $this->username = $username;
        $this->password = $password;
        $this->stored_users = json_decode(file_get_contents($this->storage),true);
        $this->login();
    }

    private function login(){
        foreach($this->stored_users as $user){
            if($user['username']== $this->username){
                if(password_verify($this->password,$user['password'])){
                    session_start();
                    $_SESSION['user'] = $this->username;
                    header("location: account.php"); //here need to change to the task management page
                    exit();

                }
            }
        }
        return $this->error = "Wrong username or password";
    }
}


?>