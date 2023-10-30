<?php

require_once  ('../app/models/UserModel.php');

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
                // Handle a successful registration
                // display a success message.
                echo $result;
                //$this->view->render('user/LoginView.phtml');
                header("Location: LoginView.phtml");
                exit();
            } catch (Exception $e) {
                // Handle registration error
                // display an error message.
                echo $e->getMessage();
            }
        }/* else {
            // Display the registration form view
            $this->view->render('user/RegisterView.phtml');
        }*/
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
        } else {
            // Display the login form view
            require_once 'user/LoginView.phtml';
        }
    }
    
}

?>
