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
        // var_dump($_POST);
        $flag = FALSE;

        $user_data = user_data::get_userdata();//全ユーザーデータの取得
        
        foreach($user_data as $_POST){
            if($user_data['email'] == $_POST['email'] || $user_data['password'] == $_POST['password'])
            {
                $flag = TRUE;
            }
        }
        
        if($flag==TRUE){
            // each("<h3>ログイン成功</h3>");
            var_dump($flag);
        }else{
            var_dump($flag);
        }
        exit();
    }
	//テンプレートを指定
	$template = './template/login.html';
	$contents = common::html_output($template,$params);

	//出力
    echo $contents;
   
    
}