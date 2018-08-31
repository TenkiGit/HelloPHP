<?php

include_once("./common/user_data.php");
include_once("./common/common.php");
include_once("./common/database_control.php");


try{
	main();
}catch(Exception $e){
	echo $e;
}

//emailを返す
function main(){
    if(isset($_POST['送信ボタン']))
{   
     if($_SERVER["REQUEST_METHOD"]== 'POST'){
        // var_dump($_POST);
        $flag = FALSE;
        $email ='';
        $user_id ='';
        $name = '';
        $user_data = 0;

        // $user_data = user_data::get_userdata();//全ユーザーデータの取得
        // <!-- ログインようの関数を作る -->
        // <!-- 値渡ししIDとパスの人数を返す -->   
        
        $user_data = common::get_olluser();
        $user_count = common::get_count_user($_POST['email'],$_POST['password']);
        var_dump($user_data);

        if($user_count !=1){
            header("Location:/login.php");//リダイレクト
            exit();
        }
        //全部参照しサーチ
        foreach($user_data as $data){
            if($data['email'] == $_POST['email'] && $data['password'] == $_POST['password']&&$data['status']==1)
            {
                $flag = TRUE;
                $user_id = $data['ID'];
                $name = $data['user_name'];
                $email = $data['email'];
            }
        }
        
        
        //Trueの場合
        // if($flag==TRUE){
        if($user_count==1){
            // echo '<h3>ログイン成功</h3>';
            // var_dump($flag); 
            setcookie('ID',$user_id,time()+(3600));//IDと変数(data)と有効時間(秒)
            setcookie('Name',$name,time()+(3600*24));
            setcookie('Email',$email,time()+(3600*24));
            // setcookie('count',$user_count,time()+(35));
        }


        header("Location:/");//リダイレクト
        exit();
    }
}else if(isset($_POST['新規登録ボタン'])){
    header("Location:/regist.php");
}

	//テンプレートを指定
	$template = './template/login.html';
    $contents = common::html_output($template,$params);
    

	//出力
    echo $contents;
   
    
}