<?php

class TestController extends ApplicationController
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
