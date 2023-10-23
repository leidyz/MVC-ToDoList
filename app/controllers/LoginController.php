<?php

session_start();
require "../app/models/login.php";
class LoginController{
    public function indexAction(){
        if(isset($_SESSION['login']))
        header('location:' .urlsite);
        require 'views/LoginView.php';
    }

}



?>