<?php
	/**
	 * SPA Main Functions File
	 * @author Shahriar
	 * @version 1.0.1
	*/
	
	/**
	 * Check if url is valid
	 * @return bool
	 */
	function url_valid(){
		$pages=array('index','header','footer','404');
		if(isset($_GET['page']) && file_exists("admin/".$_GET['page'].".php")){
				if(in_array($_GET['page'], $pages)) return FALSE;
				else return TRUE;
			}
		else return FALSE;
	}
	
	/**
	 * Success JSON API
	 * @return json
	 */
	 function success_json($msg='Completed'){
	 	$args=array();
		$args['success']=1;
		$args['message']=$msg;
		return json_encode($args);
	 }
	
	/**
	 * Error JSON API
	 * @return json
	 */
	 function err_json($msg='Error'){
		$args=array();
		$args['success']=0;
		$args['message']=$msg;
		return json_encode($args);
	 }
