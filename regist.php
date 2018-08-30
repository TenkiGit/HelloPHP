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
    $email='';
    $pass='';
    
    $email = $_POST['email'];
    $pass = $_POST['password'];
    

    setcookie('Name',$_POST['name'],time()+(3600));
    setcookie('jpb',$_POST['job'],time()+(3600));
    setcookie('email',$_POST['email'],time()+(3600));
    setcookie('password',$_POST['password'],time()+(3600));



	$contents = common::html_output($template,$params);

	

	//出力
	echo $contents;
	
}
