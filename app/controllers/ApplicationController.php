<?php

require_once  '../app/models/RegisterUserModel.php';
require_once  '../app/models/LoginUserModel.php';
/**
 * Base controller for the application.
 * Add general things in this controller.
 */
class ApplicationController extends Controller {
	

    public function RegisterUserAction(){
        if(isset($_POST['submit'])){
            $user = new RegisterUser($_POST['username'],$_POST['password']);
        }
    }


    public function LoginUserAction(){
        if(isset($_POST['submit'])){
            $user = new LoginUser($_POST['username'],$_POST['password']);
        }
    }

    //para activar el de acccountview
    public function LogoutUserAction(){
        session_start();
        if(!isset($_SESSION['user'])){
        header("location: LoginView.phtml"); exit();

        }

        if(isset($_GET['logout'])){
        unset($_SESSION['user']);
        header("location: LoginView.phtml"); exit();
        }
    }

}


?>



}
