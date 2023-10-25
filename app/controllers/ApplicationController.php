<?php
session_start();
require_once  '../app/models/UserModel.php';
require_once  '../config/environment.inc.php';
/**
 * Base controller for the application.
 * Add general things in this controller.
 */
class ApplicationController extends Controller {
	private $userModel;
     
    public function __construct(){
        $this->userModel = new User();
    }

    public function indexAction(){
  
    }
    public function registerAction(){

        $username = $_POST['username'];
        $password = $_POST['password'];

        if($this->userModel->register($username,$password)){
         redirect("../LoginView.php");
     }else{
         die("Something went wrong");
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




