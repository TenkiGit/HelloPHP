<?php

include_once("./common/user_data.php");
include_once("./common/common.php");


try{
	main();
}catch(Exception $e){
	echo $e;
}


function main(){
	//テンプレートを指定
	$template = './template/regist.html';
	$params["user_data"] = [];




	$contents = common::html_output($template,$params);

	

	//出力
	echo $contents;
	
}
