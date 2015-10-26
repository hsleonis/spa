<?php
/**
 * SPA comment API
 * @author Shahriar
 * @version 1.0.1
*/
 session_start();
 $data = json_decode(file_get_contents("php://input"));
 if(!$data) die();
 $sub = mysql_real_escape_string($data->sub);
 
 if($sub=='addComment'){	// Add new comment
  	date_default_timezone_set('Asia/Dhaka');
 	$args=array(
 		'postid' => $data->postid,
		'viewer' => $data->name,
		'comment' =>$data->comment,
		'comdate' => date("d-m-Y")
	);
	
	$chk=insert_data('comments', $args);
	if($chk) echo success_json();
	else echo err_json('Submission error');
 }
 elseif($sub=='getComment'){	// Get single post
 	$chk=table_data("comments","postid='".$data->postid."' order by comid desc");
	print_r($chk);
 }
 else echo err_json('Login Error');