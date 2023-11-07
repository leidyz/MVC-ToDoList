<?php

class TestController extends App_Controller 
{
	public function indexAction()
	{
		$this->view->message = "hello from test::index";
	}
	
	public function checkAction()
	{
		echo "hello from test::check";
	}
}
