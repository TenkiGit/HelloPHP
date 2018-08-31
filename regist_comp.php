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
	$template = './template/regist_comp.html';
     $params = [];
    
    $data=[];
    // var_dump($_GET);
    $data = common::comp_user($_GET['user_id'],$_GET['token']);
    var_dump($data);

	$contents = common::html_output($template,$params);

	

	//出力
	echo $contents;
	
}
