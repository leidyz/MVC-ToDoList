<?php

require_once  '../app/models/RegisterUser.php';
/**
 * Base controller for the application.
 * Add general things in this controller.
 */
class ApplicationController extends Controller 
{
	

public function RegisterUserAction(){
    if(isset($_POST['submit'])){
        $user = new RegisterUser($_POST['username'],$_POST['password']);
    }
}



}
