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
	$template = './template/regist_mail.html';
	$params = [];
	// $params['ID'];
    // var_dump($_POST);

    // mb_language("Japanese");
    // mb_internal_encoding("UTF-8");
    $mail_add = $_POST['inp_email'];

    mb_send_mail($mail_add,'test','testメールです');

	$contents = common::html_output($template,$params);

	

	//出力
	echo $contents;
	
}
