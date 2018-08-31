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
    $params['inp']=$_POST['inp_email'];
    $params['inp']=$_POST['inp_name'];
    $params['inp']=$_POST['inp_job'];

    var_dump($params);
    

    setcookie('Name',$_POST['name'],time()+(3600));
    setcookie('jpb',$_POST['job'],time()+(3600));
    setcookie('Email',$_POST['email'],time()+(3600));
    setcookie('password',$_POST['password'],time()+(3600));



	$contents = common::html_output($template,$params);

	

	//出力
    echo $contents;
    if(isset($_POST['登録ボタン'])){
        header("Location:/confirm.php");//リダイレクト
        exit();
    }
}
