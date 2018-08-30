<?php
session_start();
define( "DB_MASTER", 0 );
define( "DB_SLAVE" , 1 );

$GLOBALS["SiteConf"] = parse_ini_file ( $_SERVER['DOCUMENT_ROOT'] . "/config/site.conf" ) ;
$GLOBALS["SiteConf"]["DIR"]["TEMPLATE"]      = $_SERVER['DOCUMENT_ROOT'] . "/" . $GLOBALS["SiteConf"]["DIR"]["TEMPLATE"] ;
$GLOBALS["SiteConf"]["DIR"]["DOCUMENTROOT"]  = $_SERVER['DOCUMENT_ROOT'] . "/" . $GLOBALS["SiteConf"]["DIR"]["DOCUMENTROOT"] ;
$GLOBALS["SiteConf"]["DIR"]["CONFIG"]        = $_SERVER['DOCUMENT_ROOT'] . "/" . $GLOBALS["SiteConf"]["DIR"]["CONFIG"] ;
$GLOBALS["SiteConf"]["DIR"]["LIBLARY"]       = $_SERVER['DOCUMENT_ROOT'] . "/" . $GLOBALS["SiteConf"]["DIR"]["LIBLARY"] ;
$GLOBALS["SiteConf"]["DIR"]["LOG"]           = $_SERVER['DOCUMENT_ROOT'] . "/" . $GLOBALS["SiteConf"]["DIR"]["LOG"] ;

include_once ( $GLOBALS["SiteConf"]["DIR"]["LIBLARY"] . "/database_control.php"  );       // DB系共通

class common {
    function html_output($template,$params=array()){

   //htmlを取り込む
    ob_start();
    require $template;
    $contents = ob_get_clean();

    //出力内容を返す
    return $contents;

    }
    public static function get_olluser($inpEmail,$inpPass){
        $count=0;

        $conn   = database_control::getConnection() ;
                $sql  = "SELECT *  FROM user_data";
                //$sql .= " WHERE EMAIL        = :email";
                $param = array();
                //array_push ( $param , array('key'=>':email'        , 'value'=> メールアドレス          , 'type'=>PDO::PARAM_STR) );
                $stmt   = database_control::execute( $conn, $sql , $param );        // execute
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC );     // result set

                foreach($result as $data){
                    if ($data['email']== $inpEmail && $data['password']==$inpPass){
                        $count=$count+1;
                        var_dump($data);
                    }
                }

                
                return $count;
    }
}

