<?php
/**
 * SPA post API
 * @author Shahriar
 * @version 1.0.1
*/
 session_start();
 $data = json_decode(file_get_contents("php://input"));
 if(!$data) die();
 $sub = mysql_real_escape_string($data->sub);
 
 if($sub=='getPost'){	// Get all posts
  	print_r(table_data("post","1 ORDER BY postid DESC"));
 }
 elseif($sub=='singlePost'){	// Get single post
 	$chk=table_data("post","postid='".$data->postid."'");
	print_r($chk);
 }
 else echo err_json('Login Error');