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
    // $params["user_data"] = [];
    
    $data=[];
    var_dump($_GET);


	$contents = common::html_output($template,$params);

	

	//出力
	echo $contents;
	
}