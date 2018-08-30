<?php
//---------------------------------------------------
// NAEM         : database_cntrol.php ( COMMON FILES )
// CREATE       : Affelhansa
// LAST UPDATE  : 2017..08.19
//---------------------------------------------------
class database_control {

    public static function getConnection( $db_kind=DB_MASTER , $auto_commit=1 ){

        if ( $db_kind ==DB_MASTER ) {
            $db_name = "DB_MASTER";
        } else {
            $db_name = "DB_SLAVE";
        }

        $server   = $GLOBALS["SiteConf"][$db_name]["SERVER"];    // 接続先DBサーバー
        $user     = $GLOBALS["SiteConf"][$db_name]["USER"];      // ユーザー
        $pass     = $GLOBALS["SiteConf"][$db_name]["PASSWORD"];  // パスワード
        $database = $GLOBALS["SiteConf"][$db_name]["NAME"];      // DB名称

        //-------------------
        //DBに接続
        //-------------------
        try {
            $pdo = new PDO("mysql:host=" . $server . "; dbname=".$database, $user, $pass  );
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }


        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        database_control::execute ($pdo,"SET AUTOCOMMIT=".$auto_commit.";");
        database_control::execute ($pdo,"SET NAMES utf8;");

        return $pdo;

    }

    //---------------------------------------------------
    // SQLを実行する
    //---------------------------------------------------
    public static function execute( $conn, $sql , $param = array() ) {

        // インジェクション対策 　メタコマンド除去
        //$sql = mysql_escape_string($sql);
        $sql = str_replace("¥C", "", $sql);
        $sql = str_replace("¥c", "", $sql);
        $sql = str_replace("\C", "", $sql);
        $sql = str_replace("\c", "", $sql);



        try {
                //-------------------
                //クエリのセット
                //-------------------
                $stmt = $conn->prepare( $sql );

                foreach ( $param as $pramLine) {
                    $stmt->bindParam( $pramLine["key"] , $pramLine["value"] , $pramLine["type"] );
                }
                //-------------------
                //クエリの実行
                //-------------------
                $ret = $stmt->execute();
                if (!$ret) {
                    //base::exception_handle ( "QUERY ERROR".$sql );
                    throw new Exception ("QUERY ERROR".$sql);
                }
            } catch (PDOException $e) {
                throw new Exception ($e->getMessage());
            }
        return $stmt;
    }



}
?>
