<?php 

/**
* Functions helpers below
*
* 
**/

if (! function_exists('getFileList')) {
	function getFileList($directory){
		return array_diff(scandir($directory, 1), ['.', '..']);
	}
}
if (! function_exists('redirect')) {
	function redirect($redirectPath){
		$host = $_SERVER['HTTP_HOST'];
		$redirectPath = ltrim($redirectPath, '/');
		header('Location: http://'.$host.'/' . $redirectPath);
	}
}



