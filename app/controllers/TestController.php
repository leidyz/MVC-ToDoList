<?php

class TestController extends App_Controller 
{
	public function indexAction()
	{
		$this->view->message = "hello from application::home";
	}
	
	public function checkAction()
	{
		echo "hello from test::check";
	}
}
