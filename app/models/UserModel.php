<?php
class User {
    private string $username;
    private string $password;
    private string $encrypted_password;
    private string $raw_password;
    public string $error;
    public string $success;
    private $storage;
    private $stored_users;
    private array $new_user; 

    public function __construct() {
        $this->storage = __DIR__ . "../../../app/models/UserData.json";
    }

    public function register($username, $password) {


        if (!$this->checkFieldValues($username, $password)) {
            throw new Exception("Both fields are required.");
        }

        $raw_password = filter_var(trim($password), FILTER_SANITIZE_STRING);
        $encrypted_password = password_hash($raw_password, PASSWORD_DEFAULT);

        $stored_users = json_decode(file_get_contents($this->storage), true);

        $new_user = [
            "username" => $username,
            "password" => $encrypted_password
        ];

        if ($this->insertUser($new_user, $stored_users)) {
            if (file_put_contents($this->storage, json_encode($stored_users, JSON_PRETTY_PRINT)) === false) {
                throw new Exception("Failed to write JSON data.");
            }
    
            return "Your registration was successful.";
        } else {
            throw new Exception("An error occurred while trying to save your data. Please try again.");
        }
        /*
           
            return "Your registration was successful.";
        } else {
            throw new Exception("An error occurred while trying to save your data. Please try again.");
        }*/
    }

    public function login($username, $password) {


        $stored_users = json_decode(file_get_contents($this->storage), true);

        if ($this->authenticateUser($username, $password, $stored_users)) {
            return true;
        } else {
            throw new Exception("Wrong username or password.");
        }
    }

    
    private function checkFieldValues($username, $password) {
        return !empty($username) && !empty($password);
    }

    private function insertUser($new_user, &$stored_users) {
        if (!$this->usernameExists($new_user['username'], $stored_users)) {
            array_push($stored_users, $new_user);
            if (file_put_contents($this->storage, json_encode($stored_users, JSON_PRETTY_PRINT))) {
                return true;
            } else {
                return false;
            }
        }
    }

    private function usernameExists($username, $stored_users) {
        foreach ($stored_users as $user) {
            if ($user["username"] == $username) {
                return true;
            }
        }
        return false;
    }

    private function authenticateUser($username, $password, $stored_users) {
  
        foreach ($stored_users as $user) {
            if ($user['username'] == $username) {
                if (password_verify($password, $user['password'])) {
                    return true;
                }
            }
        }
        return false;
    }
}


?>
