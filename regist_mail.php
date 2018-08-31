<?php

include_once("./common/user_data.php");
include_once("./common/common.php");
// include_once("./login.php");

try{
	main();
}catch(Exception $e){
	echo $e;
}


function main(){
	//テンプレートを指定
	$template = './template/index.html';
	$params["user_data"] = [];
	// $params['ID'];

	var_dump($_POST);

	$contents = common::html_output($template,$params);

	

	//出力
	echo $contents;
	
}
