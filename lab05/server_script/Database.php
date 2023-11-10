<?php
class Database
{
    private static $instance = NULL;
    private static $db_host = "localhost";
    private static $db_user = "root";
    private static $db_pass = "";
    private static $db_name = "progappwww";

    public static function getInstance()
    {
        if(self::$instance === NULL)
        {
            self::$instance = new mysqli(self::$db_host, self::$db_user, self::$db_pass, self::$db_name);
        }
        return self::$instance;
    }
    
}
?>