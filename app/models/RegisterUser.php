<?php

class RegisterUser{
    private $username;
    private $password;
    private $encrypted_password;
    public $error;
    public $success;
    private $storage = "UserData.json";
    private $stored_users;
    private $new_user; //array

    public function __construct(string $username, string $password){
        $this->username = trim($this->username);
        $this->username = filter_var($username, FILTER_SANITIZE_STRING);

        $this->raw_password = filter_var(trim($password), FILTER_SANITIZE_STRING);
        $this->encrypted_password = password_hash($password,PASSWORD_DEFAULT);

        $this->stored_users = json_decode(file_get_contents($this->storage),true);

        $this->new_user = [
            "username" => $this->username,
            "password" => $this->encrypted_password
        ];
        
        if($this->checkFieldValues()){
            $this->insertUser();
        }
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