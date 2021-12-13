<?php

define(
    "CONFIG", 
    array(
        "HOST"  => "localhost",
        "USER_NAME"  => "root",
        "PASSWORD"  => "",
        "DB_NAME"  => "egraat"
    ),
    true
);

class DBConnection {

    private static $singleton;
    private $connection;
    
    private function __construct () {
        $con = new mysqli(CONFIG['HOST'],CONFIG['USER_NAME'],CONFIG['PASSWORD'],CONFIG['DB_NAME']);
        if($con->connect_error)
            die("Connection failed: " . $con->connect_error);
        // print "Connection Successful" ;
        // mysqli_query($con,'SET CHARACTER SET utf8') or die ('Can\'t charset in DataBase');
        // mysqli_query($con,"SET NAMES 'utf8'") or die ('Can\'t charset in DataBase');
        $con->set_charset("utf8");
        $this->connection = $con  ;
    }

    public static function getInstance() {
        if (!isset(self::$singleton)){
            self::$singleton = new DBConnection();
        }
        return self::$singleton;
    }

    public static function getConnection() : mysqli {
        return self::getInstance()->connection ;
    }
}

?>