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
	$contents = common::html_output($template,$params);

	if($_COOKIE['ID']!=NULL && $_COOKIE['Name']!= NULL && $_COOKIE['Email'])
	{
		echo 'ようこそ';
	}

	//出力
	echo $contents;
}

//aタグでHTMLを作る
//login.phpとlogin.htmlを作成