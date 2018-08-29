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
	$params['ID'];
	$params['user_data'] = user_data::get_userdata();
	
	$params = $_COOKIE;

	$contents = common::html_output($template,$params);

	

	//出力
	echo $contents;
	if($_COOKIE['ID']!=NULL && $_COOKIE['Name']!= NULL && $_COOKIE['Email'])
	{
		echo 'ようこそ';
		var_dump($params);
		
		
	}else if($_COOKIE['id']==NULL){
		echo '<a href=../login.php>ログインページへ移動</a>';
	}
}

//aタグでHTMLを作る
//login.phpとlogin.htmlを作成