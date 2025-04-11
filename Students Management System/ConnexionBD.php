<?php
class ConnexionBD
{
    public static $dbname="gestionetudiant";
    public static $user="ali";
    public static $host="localhost";
    public static $pwd='ali';
    public static $bdd=null;
    private function __construct() 
    {
        try
        {
            self::$bdd=new PDO( "mysql:host=".self::$host.
                                ";dbname=".self::$dbname.
                                ";charset=utf8",self::$user,self::$pwd,
                                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
        }
        catch(PDOException $e )
        {
            die("Erreur : ".$e->getMessage());
        }
    }

    
    public static function getInstance()
    {
        if (!self::$bdd) 
            new ConnexionBD();
        return (self::$bdd);
    }
}
?>