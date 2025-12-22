<?php
return array(
	'_root_'  => 'users/login',     // デフォルトでログインページへ
    'signup'  => 'users/signup',
    'login'   => 'users/login',
	'_root_'  => 'welcome/index',  // The default route
	'_404_'   => 'welcome/404',    // The main 404 route
	
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
);
