<?php

include_once("./common/user_data.php");
include_once("./common/common.php");


try{
	main();
}catch(Exception $e){
	echo $e;
}


function main(){
    if($_SERVER["REQUEST_METHOD"]== 'POST'){
        var_dump($_POST);
        exit();
    }
	//テンプレートを指定
	$template = './template/login.html';
	$contents = common::html_output($template,$params);

	

	//出力
    echo $contents;
   
    
}