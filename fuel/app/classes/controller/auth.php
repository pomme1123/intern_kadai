<?php

class Controller_Auth extends Controller_Template
{

	public function action_index()
	{
		$data["subnav"] = array('index'=> 'active' );
		$this->template->title = 'Auth &raquo; Index';
		$this->template->content = View::forge('auth/index', $data);
	}

}
