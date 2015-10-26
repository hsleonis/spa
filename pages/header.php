<?php
/**
 * SPA header file
 * @author Shahriar
 * @version 1.0.1
*/

// Post submit
if(isset($_POST['postsubmit'])){
	$target_file='';
	if($_FILES["postimg"]["name"]!=''){
		$target_dir = "uploads/";
		$tmp=basename($_FILES["postimg"]["name"]);
		$imageFileType = pathinfo($tmp,PATHINFO_EXTENSION);
		$tmp=md5($tmp.''.time()).'.'.$imageFileType;
		$target_file = $target_dir.$tmp;
		move_uploaded_file($_FILES["postimg"]["tmp_name"], $target_file);
	}
	
	date_default_timezone_set('Asia/Dhaka');
 	$args=array(
		'username' => $_SESSION['name'],
		'uid' => $_SESSION['uid'],
		'postdate' => date("d-m-Y"),
		'posttitle' => $_POST['posttitle'],
		'postdesc' => $_POST['postdesc'],
		'postimg' => $target_file
	);
	
	$chk=insert_data('post', $args);
 }
?>


<!DOCTYPE html>
<html xmlns:fb="http://ogp.me/ns/fb#" lang="en">
	<head>
		<title>SPA</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="bin/css/bootstrap.css">
		<link rel="stylesheet" href="bin/css/font-awesome.css">
		<link rel="stylesheet" href="bin/css/style.css">
		
		<script src="bin/js/angular.min.js"></script>
		<script src="bin/js/angular-route.min.js"></script>
		<script src="bin/js/angular-animate.min.js"></script>
		<script src="bin/js/angular-sanitize.min.js"></script>
		<script src="bin/js/jquery.js"></script>
		<script src="bin/js/bootstrap.js"></script>
		<script src="bin/js/app.js"></script>
	</head>
	
	<body ng-app="forum">
		
		<!-- facebook SDK -->
		<div id="fb-root"></div>
		<script>
		  function statusChangeCallback(response) {
		    console.log('statusChangeCallback');
		    console.log(response);
		    if (response.status === 'connected') {
		      testAPI();
		    } else if (response.status === 'not_authorized') {
		      document.getElementById('status').innerHTML = 'Please log ' +
		        'into this app.';
		    } else {
		      document.getElementById('status').innerHTML = 'Please log ' +
		        'into Facebook.';
		    }
		  }
		
		  function checkLoginState() {
		    FB.getLoginStatus(function(response) {
		      statusChangeCallback(response);
		    });
		  }
		
		  window.fbAsyncInit = function() {
			  FB.init({
			    appId      : '1576253079330821',
			    cookie     : true,  // enable cookies to allow the server to access 
			                        // the session
			    xfbml      : true,  // parse social plugins on this page
			    version    : 'v2.2' // use version 2.2
			  });
			
			  FB.getLoginStatus(function(response) {
			    statusChangeCallback(response);
			  });
		
		  };
		
		  // Load the SDK asynchronously
		  (function(d, s, id) {
		    var js, fjs = d.getElementsByTagName(s)[0];
		    if (d.getElementById(id)) return;
		    js = d.createElement(s); js.id = id;
		    js.src = "//connect.facebook.net/en_US/sdk.js";
		    fjs.parentNode.insertBefore(js, fjs);
		  }(document, 'script', 'facebook-jssdk'));
		
		  function testAPI() {
		    console.log('Welcome!  Fetching your information.... ');
		    FB.api('/me', function(response) {
		      	var API="apis/user";
		   		$.ajax({
			        type: "POST",
			        url: API,
			        dataType: 'json',
			        async: false,
			        data: JSON.stringify({sub: 'regUser', username: response.name, email: response.email, password: response.email}),
			        success: function () {
			        	console.log('Successful login for: ' + response.name);
						//window.self.location.reload();
			        }
			    });
		    });
		  }
		</script>
		<!-- /facebook SDK -->
		
		<!-- Base url -->
		<base href="http://localhost/spa/" />
		<!-- /Base url -->
		
		<!-- Navbar -->
		<nav class="container" data-ng-controller="navController" data-ng-init="fblogin(FBres)">
			<span class="logo">{{logo}}</span>
		  <ul>
		    <li><a href="home" class="current" data-hover="Home">Home</a></li>
		    <li ng-repeat="link in links"><a href="{{link.url}}" data-hover="{{link.name}}">{{link.name}}</a></li>
		  </ul>
		  <?php if(!isset($_SESSION['logged'])): ?>
		  	<span class="btn-login user" data-toggle="modal" data-target="#loginModal">Login</span>
		  <?php else: ?>
		  	<span class="btn-post user" data-toggle="modal" data-target="#postModal">Write a post</span>
		  <?php endif; ?>
		</nav>
		<!-- /Navbar -->
		<!-- Main -->
		<div class="container">