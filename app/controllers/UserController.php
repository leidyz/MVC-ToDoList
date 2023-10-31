<?php

require_once('../app/models/UserModel.php');
require_once(__DIR__.'/../../lib/base/Controller.php');


class UserController extends Controller{
    private $userModel;

    public function __construct(){
        $this->userModel = new User();
    }

    public function indexAction(){
       
    }

    public function RegisterViewAction() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            try {
                $result = $this->userModel->register($username, $password);
                // display a success message.
                echo $result;
                header("Location: LoginView.phtml");
                exit();
            } catch (Exception $e) {
                // display an error message.
                echo $e->getMessage();
            }
        }
    }

    public function LoginViewAction() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
    
            try {
                if ($this->userModel->login($username, $password)) {
                    // Redirect to the account view after successful login
                    header("Location: AccountView.phtml");
                    exit();
                } else {
                    // Handle login failure
                    // You can decide how to handle login errors and redirection
                    // For now, let's display a login error message.
                    echo "Login failed.";
                }
            } catch (Exception $e) {
                // Handle login error
                // You can decide how to handle login errors and redirection
                // For now, let's display a login error message.
                echo $e->getMessage();
            }
        } 
    }

    public function AccountViewAction() {
    }
    
}

?>
