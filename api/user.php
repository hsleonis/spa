<?php
/**
 * SPA user API
 * @author Shahriar
 * @version 1.0.1
*/
 session_start();
 $data = json_decode(file_get_contents("php://input"));
 if(!$data) die();
 $sub = mysql_real_escape_string($data->sub);
 
 if($sub=='regUser'){	// Add new user
 	date_default_timezone_set('Asia/Dhaka');
 	$args=array(
		'username' => $data->username,
		'email' => $data->email,
		'password' => md5($data->password),
		'joindate' => date("d-m-Y")
	);
	
	$chk=insert_data('users', $args);
	if($chk) {
		login_user($data);
	}
	else echo err_json('Registration Error');
 }
 elseif($sub=='loginUser'){	// user login
	 	login_user($data);
 }
 elseif($sub=='joinUser'){	// user details
	 	$chk=table_data("users","id='".$data->uid."'","id,username,joindate");
		print_r($chk);
 }
 else echo err_json('Login Error');