<?php

include_once("./common/user_data.php");
include_once("./common/common.php");
// include_once("./login.php");

try{
	main();
}catch(Exception $e){
	echo $e;
}

function masking($secretStr){
	return str_repeat('*',strlen($secretStr));
}

function main(){
	//テンプレートを指定
	$template = './template/confirm.html';
	$params= [];
	
	
	
	$_POST['password']=masking($_POST['password']);//パスワードを全て**文字にする
	
	$params = $_POST;//クッキーをパラメータに代入
	$contents = common::html_output($template,$params);

	

	//出力
    echo $contents;
}
//inputtypehiddon

