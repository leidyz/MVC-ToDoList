<?php

class User{
    private string $username;
    private string $password;
    private string $encrypted_password;
    private string $raw_password;
    public string $error;
    public string $success;
    private $storage;
    private $stored_users;
    private array $new_user; 

    public function __construct(){
        $this->storage = __DIR__ . "../../../app/models/UserData.json";

    }

    public function register(string $username, string $password){
        $this->username = trim($this->username);
        $this->username = filter_var($username, FILTER_SANITIZE_STRING);

        $this->raw_password = filter_var(trim($password), FILTER_SANITIZE_STRING);
        $this->encrypted_password = password_hash($this->raw_password, PASSWORD_DEFAULT);

        $this->stored_users = json_decode(file_get_contents($this->storage),true);

        $this->new_user = [
            "username" => $this->username,
            "password" => $this->encrypted_password
        ];
       
        if($this->checkFieldValues()){ //if empty, insert the user info
            $this->insertUser();
        }
       
    }

    private function login($username, $password){
        $this->username = $username;
        $this->password = $password;
        $this->stored_users = json_decode(file_get_contents($this->storage),true);
        
        foreach($this->stored_users as $user){
            if($user['username']== $this->username){
                if(password_verify($this->encrypted_password,$user['password'])){
                    session_start();
                    $_SESSION['user'] = $this->username;
                    header("location: AccountView.php"); //here need to change to the task management page
                    exit();

                }
            }
        }
        return $this->error = "Wrong username or password";
    }

    private function checkFieldValues(){
        if (empty($this->username) || empty($this->encrypted_password)) {
            $this->error = "Both fields are required";
            return false;
        }else{
            return true;
        }
    }

    private function usernameExists(){
        foreach ($this->stored_users as $user){
            if ($user["username"] == $this->username){
                $this->error = "Username already exists! Please choose a different one.";
                return true;
            }
        }
        return false;
    }

    private function insertUser(){
        if($this->usernameExists() == FALSE){
        array_push($this->stored_users,$this->new_user);
        if(file_put_contents($this->storage,json_encode($this->stored_users,JSON_PRETTY_PRINT))){
            return $this->success = "Your registration was succesful";
        }else{
            return $this->error = "An error occurred while trying to save your data, please try again";
        }
        }

    }

}


?>