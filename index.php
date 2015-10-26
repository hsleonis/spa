<?php
/**
 * SPA index file
 * @author Shahriar
 * @version 1.0.1
*/
	session_start();
	
	// Functions
	require_once('config/function.php');
	require_once('config/connect.php');
	require_once('config/db.php');
	
	// Page
	require_once('pages/header.php');
	require_once('pages/content.php');
	require_once('pages/footer.php');