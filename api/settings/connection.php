<?php
abstract class Connection {
    protected $db;
    protected $db_lp;
    
    protected function __construct(){
        $dsn=DB.":host=".DB_HOST.";dbname=".DB_NAME;
        try {
            $this->db = new PDO($dsn, DB_USER, DB_PASSWD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . DB_CHAR));
        }
        catch(Exception $e){
            // $error = "GET MESSAGE: " . $e->getMessage();
        }
    }
}