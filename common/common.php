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
    public static function get_olluser(){
        $conn   = database_control::getConnection() ;
                $sql  = "SELECT *  FROM user_data";
                //$sql .= " WHERE EMAIL        = :email";
                $param = array();
                //array_push ( $param , array('key'=>':email'        , 'value'=> メールアドレス          , 'type'=>PDO::PARAM_STR) );
                $stmt   = database_control::execute( $conn, $sql , $param );        // execute
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC );     // result set

                return $result;
    }
    public static function get_count_user($Email,$Pass){
        if($Email==null||$Pass==null){
            return $count=0;
        }
        $count=0;
        $conn   = database_control::getConnection() ;
                $sql  = "SELECT *  FROM user_data";
                //$sql .= " WHERE EMAIL        = :email";
                $param = array();
                //array_push ( $param , array('key'=>':email'        , 'value'=> メールアドレス          , 'type'=>PDO::PARAM_STR) );
                $stmt   = database_control::execute( $conn, $sql , $param );        // execute
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC );     // result set

                foreach($result as $data){
                    if ($data['email']== $Email && $data['password']==$Pass){
                        $count=$count+1;
                        // var_dump($data);
                    }
                }

                
                return $count;
    }
    public static function get_user_token($token){
        $conn   = database_control::getConnection() ;
        $sql  = "SELECT *  FROM user_data";
        $sql .= " WHERE token        = :token";
        $param = array();
        array_push ( $param , array('key'=>':token'        , 'value'=> $token          , 'type'=>PDO::PARAM_STR) );
        $stmt   = database_control::execute( $conn, $sql , $param );        // execute
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC );     // result set

        return $result;
    }
    public static function create_user($add_data){
        $conn   = database_control::getConnection() ;
        $sql  = "INSERT INTO  user_data (user_name,job,email,password,token,status) VALUES(:user_name,:job,:email,:password,:token,:status)";
        // $sql .= " WHERE taken        = :token";
        $param = array();
        array_push ( $param , array('key'=>':user_name'        , 'value'=> $add_data['inp_name']          , 'type'=>PDO::PARAM_STR) );
        array_push ( $param , array('key'=>':job'        , 'value'=> $add_data['inp_job']       , 'type'=>PDO::PARAM_STR) );
        array_push ( $param , array('key'=>':email'        , 'value'=> $add_data['inp_email']          , 'type'=>PDO::PARAM_STR) );
        array_push ( $param , array('key'=>':password'        , 'value'=> $add_data['inp_pass']          , 'type'=>PDO::PARAM_STR) );
        array_push ( $param , array('key'=>':token'        , 'value'=> $add_data['token']          , 'type'=>PDO::PARAM_STR) );
        array_push ( $param , array('key'=>':status'        , 'value'=> 2                         , 'type'=>PDO::PARAM_STR) );
        $stmt   = database_control::execute( $conn, $sql , $param );        // execute
        
    }
    public static function comp_user($user_id,$token){
        $conn   = database_control::getConnection() ;
                $sql  = "SELECT *  FROM user_data";
                $sql .= " WHERE ID         = :user_id AND token=:token";
                $param = array();
                array_push ( $param , array('key'=>':ID'        , 'value'=> $user_id          , 'type'=>PDO::PARAM_STR) );
                array_push ( $param , array('key'=>':token'        , 'value'=> $token          , 'type'=>PDO::PARAM_STR) );
                $stmt   = database_control::execute( $conn, $sql , $param );        // execute
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC );     // result set

                return $result;
    }
}