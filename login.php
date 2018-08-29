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
        $email ='';
        $user_id ='';
        $name = '';

        $user_data = user_data::get_userdata();//全ユーザーデータの取得
        
        //全部参照しサーチ
        foreach($user_data as $data){
            if($data['email'] == $_POST['email'] && $data['password'] == $_POST['password'])
            {
                $flag = TRUE;
                $user_id = $data['ID'];
                $name = $data['user_name'];
                $email = $data['email'];
            }
        }
        
        //Trueの場合
        if($flag==TRUE){
            // echo '<h3>ログイン成功</h3>';
            var_dump($flag); 
            setcookie('ID',$user_id,time()+(10));//IDと変数(data)と有効時間
            setcookie('Name',$name,time()+(3600*24));
            setcookie('Email',$email,time()+(3600*24));
        }


        header("Location:/");//リダイレクト
        exit();
    }
	//テンプレートを指定
	$template = './template/login.html';
    $contents = common::html_output($template,$params);
    

	//出力
    echo $contents;
   
    
}